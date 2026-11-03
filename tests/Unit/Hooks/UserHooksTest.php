<?php
/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1);

namespace OCA\GeoBlocker\Tests\Unit\Hooks;

use OC\User\LoginException;
use OC\User\Session;
use OCA\GeoBlocker\Hooks\UserHooks;
use OCP\IConfig;
use OCP\IDBConnection;
use OCP\IL10N;
use OCP\IRequest;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class UserHooksTest extends TestCase {
	private $callback;

	private function createHooks(array $app_values, $config, $request,
			$logger): UserHooks {
		$config->method('getAppValue')->willReturnCallback(
			function (string $app, string $key, string $default = '') use ($app_values) {
				return $app_values[$key] ?? $default;
			});
		$l = $this->createStub(IL10N::class);
		$l->method('t')->willReturnCallback(
			function (string $text, $params = []) {
				return vsprintf($text, (array)$params);
			});
		$session = $this->createMock(Session::class);
		$session->expects($this->once())->method('listen')->with('\OC\User',
			'preLogin', $this->isCallable())->willReturnCallback(
			function ($scope, $method, callable $callback) {
				$this->callback = $callback;
			});
		$hooks = new UserHooks($session, $logger, $request, $config, $l,
			$this->createStub(IDBConnection::class));
		$hooks->register();
		return $hooks;
	}

	public function testRegisterRegistersPreLoginCallback() {
		$config = $this->createStub(IConfig::class);
		$this->createHooks([], $config, $this->createStub(IRequest::class),
			$this->createStub(LoggerInterface::class));
		$this->assertIsCallable($this->callback);
	}

	public function testRemoteAddressIsUsedAndLocalAddressNotBlocked() {
		$config = $this->createMock(IConfig::class);
		$config->expects($this->never())->method('setAppValue');
		$request = $this->createMock(IRequest::class);
		$request->expects($this->once())->method('getRemoteAddress')->willReturn('127.0.0.1');
		$logger = $this->createMock(LoggerInterface::class);
		$logger->expects($this->never())->method('warning');
		$this->createHooks(['blockIpAddress' => '1', 'choosenCountries' => 'AA'],
			$config, $request, $logger);
		($this->callback)('admin');
	}

	public function testInvalidRemoteAddressIsLogged() {
		$config = $this->createStub(IConfig::class);
		$request = $this->createStub(IRequest::class);
		$request->method('getRemoteAddress')->willReturn('not-an-ip');
		$logger = $this->createMock(LoggerInterface::class);
		$logger->expects($this->once())->method('warning')->with(
			'The user "admin" attempt to login with an invalid IP address "not-an-ip".',
			['app' => 'geoblocker']);
		$this->createHooks(['logWithUserName' => '1', 'logWithIpAddress' => '1'],
			$config, $request, $logger);
		($this->callback)('admin');
	}

	public function testBlockedCountryThrowsLoginException() {
		$config = $this->createStub(IConfig::class);
		$request = $this->createStub(IRequest::class);
		$request->method('getRemoteAddress')->willReturn('8.8.8.8');
		$logger = $this->createMock(LoggerInterface::class);
		$logger->expects($this->once())->method('warning')->with(
			'The user "admin" attempt to login with IP address "8.8.8.8" from blocked country "AA". Login is blocked.',
			['app' => 'geoblocker']);
		$this->createHooks(
			['blockIpAddress' => '1', 'choosenCountries' => 'AA', 'logWithUserName' => '1',
				'logWithIpAddress' => '1', 'logWithCountryCode' => '1'],
			$config, $request, $logger);
		$this->expectException(LoginException::class);
		$this->expectExceptionMessage('Your attempt to login from country "AA" is blocked');
		($this->callback)('admin');
	}

	public function testCountryNotInListIsNotBlocked() {
		$config = $this->createStub(IConfig::class);
		$request = $this->createStub(IRequest::class);
		$request->method('getRemoteAddress')->willReturn('8.8.8.8');
		$logger = $this->createMock(LoggerInterface::class);
		$logger->expects($this->never())->method('warning');
		$this->createHooks(['blockIpAddress' => '1', 'choosenCountries' => 'DE'],
			$config, $request, $logger);
		($this->callback)('admin');
	}

	public function testFakeAddressIsUsedOnceForMatchingUser() {
		$config = $this->createMock(IConfig::class);
		$config->expects($this->once())->method('setAppValue')->with('geoblocker',
			'doFakeAddress', '0');
		$request = $this->createMock(IRequest::class);
		$request->expects($this->never())->method('getRemoteAddress');
		$logger = $this->createMock(LoggerInterface::class);
		$logger->expects($this->once())->method('warning')->with(
			$this->stringContains('IP address "9.9.9.9" from blocked country "AA". Login is blocked.'));
		$this->createHooks(
			['doFakeAddress' => '1', 'fakeAddressUser' => 'admin', 'fakeAddress' => '9.9.9.9',
				'blockIpAddress' => '1', 'choosenCountries' => 'AA', 'logWithIpAddress' => '1',
				'logWithCountryCode' => '1'],
			$config, $request, $logger);
		$this->expectException(LoginException::class);
		($this->callback)('admin');
	}

	public function testFakeAddressIgnoredForOtherUser() {
		$config = $this->createMock(IConfig::class);
		$config->expects($this->never())->method('setAppValue');
		$request = $this->createMock(IRequest::class);
		$request->expects($this->once())->method('getRemoteAddress')->willReturn('127.0.0.1');
		$logger = $this->createMock(LoggerInterface::class);
		$logger->expects($this->never())->method('warning');
		$this->createHooks(
			['doFakeAddress' => '1', 'fakeAddressUser' => 'other', 'fakeAddress' => '9.9.9.9',
				'blockIpAddress' => '1', 'choosenCountries' => 'AA'],
			$config, $request, $logger);
		($this->callback)('admin');
	}
}
