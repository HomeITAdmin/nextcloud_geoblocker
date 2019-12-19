<?php

namespace OCA\GeoBlocker\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\Settings\ISettings;
use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCP\ILogger;

class Admin implements ISettings {

	/** @var ILogger */
	private $logger;

	/** @var GeoBlockerConfig */
	private $config;
	public function __construct(GeoBlockerConfig $config, ILogger $logger) {
		$this->config = $config;
		$this->logger = $logger;
	}
	public function getForm() {
		$response = new TemplateResponse ( 'geoblocker', 'admin' );
		$response->setParams ( 
				[ 'logWithIpAddress' => $this->config->getLogWithIpAddress (),
						'logWithCountryCode' => $this->config->getLogWithCountryCode (),
						'logWithUserName' => $this->config->getLogWithUserName (),
						'countryList' => $this->config->getChoosenCountriesByString (),
						'chosenBlackWhiteList' => $this->config->getUseWhiteListing ()
				] );
		return $response;
	}
	public function getSection() {
		return 'geoblocker';
	}
	public function getPriority() {
		return 10;
	}
}
