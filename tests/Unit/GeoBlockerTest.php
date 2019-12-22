<?php

namespace OCA\Geoblocker\Tests\Unit\GeoBlocker;

// use PHPUnit_Framework_TestCase;
use PHPUnit\Framework\TestCase;

// use OCP\AppFramework\Http;
// use OCP\AppFramework\Http\DataResponse;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;

// class GeoBlockerTest extends PHPUnit_Framework_TestCase {
class GeoBlockerTest extends TestCase {
	protected $user;
	protected $ip_address;
	protected $logger;
	protected $config;
	protected $l;
	protected $geo_blocker;
	public function setUp(): void {
		$this->user = 'admin';
		$this->ip_address = '2a02:2e0:3fe:1001:302::';
		$this->logger = $this->getMockBuilder ( 'OCP\ILogger' )->getMock ();
		$tmp_config = $this->getMockBuilder ( 'OCP\IConfig' )->getMock ();
		$this->config = $this->getMockBuilder ( 
				'OCA\GeoBlocker\Config\GeoBlockerConfig' )->setConstructorArgs ( 
				[ $tmp_config
				] )->getMock ();
		$this->l = $this->getMockBuilder ( 'OCP\IL10N' )->getMock ();
		$this->geo_blocker = new GeoBlocker ( $this->user, $this->ip_address,
				$this->logger, $this->config, $this->l );
	}
	public function testIsCountryBlocked() {
		$log_string = 'The user "admin" logged in with IP address "2a02:2e0:3fe:1001:302::" from blocked country "DE".';

		$this->config->expects ( $this->once () )->method ( 
				'getLogWithUserName' )->will ( $this->returnValue ( TRUE ) );
		$this->config->expects ( $this->once () )->method ( 
				'getLogWithCountryCode' )->will ( $this->returnValue ( TRUE ) );
		$this->config->expects ( $this->once () )->method ( 
				'getLogWithIpAddress' )->will ( $this->returnValue ( TRUE ) );
		$this->config->expects ( $this->once () )->method ( 
				'isCountryCodeInListOfChoosenCountries' )->with ( 
				$this->equalTo ( 'DE' ) )->will ( $this->returnValue ( TRUE ) );
		$this->config->expects ( $this->once () )->method ( 
				'getUseWhiteListing' )->with ()->will ( 
				$this->returnValue ( FALSE ) );
		$this->l->expects ( $this->once () )->method ( 't' )->will ( 
				$this->returnCallback ( array ($this,'defaultTranslate'
				) ) );
		$this->logger->expects ( $this->once () )->method ( 'warning' )->with ( 
				$this->equalTo ( $log_string ),
				$this->equalTo ( array ('app' => 'geoblocker'
				) ) );
		$this->geo_blocker->check ();
	}
	public function defaultTranslate() {
		$args = func_get_args ();
		$sprintf_args = array_merge ( array ($args [0]
		), $args [1] );
		return call_user_func_array ( 'sprintf', $sprintf_args );
	}
}