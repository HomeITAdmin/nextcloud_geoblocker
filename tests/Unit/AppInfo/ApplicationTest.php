<?php
/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\AppInfo;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\AppInfo\Application;
use OCA\GeoBlocker\Hooks\UserHooks;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use Psr\Container\ContainerInterface;

class ApplicationTest extends TestCase {
	private $application;

	public function setUp(): void {
		parent::setUp();
		$this->application = new Application();
	}

	public function testIsConstructorValid() {
		$this->assertInstanceOf(App::class, $this->application);
		$this->assertEquals('geoblocker',
				$this->application->getContainer()->get('appName'));
	}

	public function testIsRegisterValid() {
		$context = $this->createStub(IRegistrationContext::class);
		$this->assertNull($this->application->register($context));
	}

	public function testIsBootRegistersUserHooksValid() {
		$hooks = $this->createMock(UserHooks::class);
		$hooks->expects($this->once())->method('register');

		$container = $this->createStub(ContainerInterface::class);
		$container->method('get')->willReturnCallback(
				fn (string $id) => $id === UserHooks::class ? $hooks : null);

		$context = $this->createStub(IBootContext::class);
		$context->method('getAppContainer')->willReturn($container);

		$this->assertNull($this->application->boot($context));
	}
}
