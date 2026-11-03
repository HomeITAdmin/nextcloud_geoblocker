<?php
/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\Settings;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\Settings\Admin;
use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IRequest;
use OCP\IUser;
use OCP\IUserSession;
use Psr\Log\LoggerInterface;
use OCP\IL10N;
use OCP\IDBConnection;

class AdminTest extends TestCase {
	private $config;
	private $request;
	private $user_session;
	private $admin;

	public function setUp(): void {
		parent::setUp();
		$this->config = $this->createStub(GeoBlockerConfig::class);
		$this->config->method('getLogWithIpAddress')->willReturn(true);
		$this->config->method('getLogWithCountryCode')->willReturn(false);
		$this->config->method('getLogWithUserName')->willReturn(true);
		$this->config->method('getChoosenCountriesByString')->willReturn('AE, AF,');
		$this->config->method('getUseWhiteListing')->willReturn(true);
		$this->config->method('getDoFakeAddress')->willReturn(false);
		$this->config->method('getFakeAddress')->willReturn('127.0.0.1');
		$this->config->method('getChosenService')->willReturn('3');
		$this->config->method('getDelayIpAddress')->willReturn(true);
		$this->config->method('getBlockIpAddress')->willReturn(false);
		$this->config->method('getBlockIpAddressBefore')->willReturn(false);

		$user = $this->createStub(IUser::class);
		$user->method('getUID')->willReturn('admin');
		$this->user_session = $this->createStub(IUserSession::class);
		$this->user_session->method('getUser')->willReturn($user);

		$this->request = $this->createStub(IRequest::class);
		$this->request->method('getRemoteAddress')->willReturn('10.0.0.1');

		$this->admin = $this->buildAdmin($this->config);
	}

	private function buildAdmin(GeoBlockerConfig $config): Admin {
		return new Admin($config,
				$this->createStub(LoggerInterface::class), $this->request,
				$this->user_session, $this->createStub(IL10N::class),
				$this->createStub(IDBConnection::class));
	}

	public function testIsGetSectionValid() {
		$this->assertEquals('geoblocker', $this->admin->getSection());
	}

	public function testIsGetPriorityValid() {
		$this->assertEquals(10, $this->admin->getPriority());
	}

	public function testIsGetFormTemplateValid() {
		$response = $this->admin->getForm();
		$this->assertInstanceOf(TemplateResponse::class, $response);
		$this->assertEquals('geoblocker', $response->getApp());
		$this->assertEquals('admin', $response->getTemplateName());
	}

	public function testIsGetFormParamsValid() {
		$params = $this->admin->getForm()->getParams();
		$expected = [
			'logWithIpAddress' => true,
			'logWithCountryCode' => false,
			'logWithUserName' => true,
			'countryList' => 'AE, AF,',
			'chosenBlackWhiteList' => true,
			'ipAddress' => '10.0.0.1',
			'doFakeAddress' => false,
			'userID' => 'admin',
			'fakeAddress' => '127.0.0.1',
			'chosenService' => '3',
			'delayIpAddress' => true,
			'blockIpAddress' => false,
		];
		foreach ($expected as $key => $value) {
			$this->assertArrayHasKey($key, $params);
			$this->assertSame($value, $params[$key], $key);
		}
		$this->assertInstanceOf(LocalizationServiceFactory::class,
				$params['localizationServiceFactory']);
		$this->assertCount(count($expected) + 1, $params);
	}

	public function testIsGetFormBlockIpAddressTrueValid() {
		$config = $this->createStub(GeoBlockerConfig::class);
		$config->method('getBlockIpAddress')->willReturn(true);
		$config->method('getBlockIpAddressBefore')->willReturn(false);
		$params = $this->buildAdmin($config)->getForm()->getParams();
		$this->assertTrue($params['blockIpAddress']);
	}

	public function testIsGetFormBlockIpAddressBeforeTrueValid() {
		$config = $this->createStub(GeoBlockerConfig::class);
		$config->method('getBlockIpAddress')->willReturn(false);
		$config->method('getBlockIpAddressBefore')->willReturn(true);
		$params = $this->buildAdmin($config)->getForm()->getParams();
		$this->assertTrue($params['blockIpAddress']);
	}

	public function testIsGetFormBlockIpAddressBothTrueValid() {
		$config = $this->createStub(GeoBlockerConfig::class);
		$config->method('getBlockIpAddress')->willReturn(true);
		$config->method('getBlockIpAddressBefore')->willReturn(true);
		$params = $this->buildAdmin($config)->getForm()->getParams();
		$this->assertTrue($params['blockIpAddress']);
	}

	public function testIsGetFormBlockIpAddressBothFalseValid() {
		$config = $this->createStub(GeoBlockerConfig::class);
		$config->method('getBlockIpAddress')->willReturn(false);
		$config->method('getBlockIpAddressBefore')->willReturn(false);
		$params = $this->buildAdmin($config)->getForm()->getParams();
		$this->assertFalse($params['blockIpAddress']);
	}
}
