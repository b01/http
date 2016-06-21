<?php namespace Kshabazz\Http\Tests;

use Kshabazz\Http\Request;
use Psr\Http\Message\RequestInterface;

/**
 * Class RequestTest
 *
 * @package \Kshabazz\Http\Tests
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{

	}

	public function testHostHeader()
	{
		$this->getMockBuilder( RequestInterface::class )
			->getMock();
		$request = new Request();
		$actual = $request->getHeaderLine( 'Host' );
		$this->assertEquals( '', $actual );
	}
}
?>