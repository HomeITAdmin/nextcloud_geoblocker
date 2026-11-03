<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\Db;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\Db\RIRServiceMapper;

class RIRServiceMapperTest extends TestCase {
	protected $db;
	private $rir_service_mapper;

	public function setUp(): void {
		parent::setUp();
		$this->db = $this->createStub('OCP\IDBConnection');
		$this->rir_service_mapper = new RIRServiceMapper($this->db);
	}
	
	public function testIsIpv6String2Int64Correct() {
		$ip = "::";
		$this->assertEquals(-9223372036854775808, RIRServiceMapper::ipv6String2Int64($ip));
		
		$ip = "0:0:0:0::";
		$this->assertEquals(-9223372036854775808, RIRServiceMapper::ipv6String2Int64($ip));
		
		$ip = "ffff:ffff:ffff:ffff::";
		$this->assertEquals(9223372036854775807, RIRServiceMapper::ipv6String2Int64($ip));
		
		$ip = "7fff:ffff:ffff:ffff::";
		$this->assertEquals(-1, RIRServiceMapper::ipv6String2Int64($ip));
		
		$ip = "8000:0:0:0::";
		$this->assertEquals(0, RIRServiceMapper::ipv6String2Int64($ip));
	}
	
	public function testIsIpv6String2Int64Correct2() {
		$ip = "1::";
		$ip2 = "0:0:0:1::";
		
		$this->assertNotEquals(RIRServiceMapper::ipv6String2Int64($ip2), RIRServiceMapper::ipv6String2Int64($ip));
		
		$ip = "ABCD:1234:4312:DBCA::";
		$ip2 = "ABCD:1234:4312:DBCA:FFFF:EEEE:1111:5555";
		
		$this->assertEquals(RIRServiceMapper::ipv6String2Int64($ip2), RIRServiceMapper::ipv6String2Int64($ip));

		$ip = "0:0:0:1::";
		$ip2 = "0:0:0:0001::";
		
		$this->assertEquals(RIRServiceMapper::ipv6String2Int64($ip2), RIRServiceMapper::ipv6String2Int64($ip));
	}

	public function testIsIpv4String2Int64Correct() {
		$this->assertEquals(0, RIRServiceMapper::ipv4String2Int64('0.0.0.0'));
		$this->assertEquals(16909060, RIRServiceMapper::ipv4String2Int64('1.2.3.4'));
		$this->assertEquals(4294967295, RIRServiceMapper::ipv4String2Int64('255.255.255.255'));
	}

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}
}
