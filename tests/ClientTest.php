<?php namespace Kshabazz\Tests;

use
	\Kshabazz\Http\Client;

/**
 * Class RequestTest
 *
 * @package \Kshabazz\Http\Tests
 * @coversDefaultClass \Kshabazz\Http\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
	private
		/** @var \Kshabazz\Http\Client */
		$client,
		/** @var string */
		$url;

	public function setUp()
	{
		$this->url = 'http://www.example.com';
		$this->client = new Client();
	}

	public function tearDown()
	{
		unset(
			$this->client,
			$this->url
		);
	}

	public function testInitializeAnHttpClient()
	{
		$this->assertInstanceOf( '\\Kshabazz\\Http\\Client', $this->client );
	}
}
?>