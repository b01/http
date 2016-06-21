<?php namespace Kshabazz\Http\Tests;

use
	\Kshabazz\Http\Header;

/**
 * Class HeaderTests
 *
 * @package \Kshabazz\Http\Tests
 * @coversDefaultClass \Kshabazz\Http\Header
 */
class HeaderTest extends \PHPUnit_Framework_TestCase
{
	/** @var \Kshabazz\Http\Header */
	private $headerTrait;

	public function setUp()
	{
		$this->headerTrait = $this->getMockForTrait( Header::class );
	}

	/**
	 * @covers ::addHeader
	 * @covers ::getHeader
	 * @covers ::getMappedName
	 */
	public function testAddingHeader()
	{
		$this->headerTrait->addHeader( 'Test', '1234' );
		$actual = $this->headerTrait->getHeader( 'Test' );

		$this->assertEquals( '1234', $actual[0] );
	}

	/**
	 * @covers ::addHeader
	 * @covers ::getHeader
	 * @covers ::getMappedName
	 */
	public function testAddingHeaderMultiLineHeader()
	{
		$this->headerTrait->addHeader( 'Test', '1234' );
		$this->headerTrait->addHeader( 'Test', '5678' );
		$actual = $this->headerTrait->getHeader( 'Test' );

		$this->assertEquals( '1234', $actual[0] );
		$this->assertEquals( '5678', $actual[1] );
	}

	/**
	 * @covers ::addHeader
	 * @covers ::getHeaderLine
	 * @covers ::getMappedName
	 */
	public function testAddingHeaderMultiLineHeaderAsString()
	{
		$this->headerTrait->addHeader( 'Test', '1234' );
		$this->headerTrait->addHeader( 'Test', '5678' );
		$actual = $this->headerTrait->getHeaderLine( 'Test' );

		$this->assertEquals( '1234,5678', $actual );
	}

	/**
	 * @covers ::addHeader
	 * @covers ::getHeaderLine
	 * @covers ::getMappedName
	 */
	public function testCanSetWithMixedCaseAndGetWithAllCaps()
	{
		$this->headerTrait->addHeader( 'TeSt', '1234' );
		$this->headerTrait->addHeader( 'TEST', '5678' );
		$actual = $this->headerTrait->getHeaderLine( 'Test' );

		$this->assertEquals( '1234,5678', $actual );
	}

	/**
	 * @covers ::addHeader
	 * @covers ::getHeaderLine
	 * @covers ::getMappedName
	 */
	public function testCaseDoesNotMatterWhenSettingOrGettingAHeader()
	{
		$this->headerTrait->addHeader( 'test', '1234' );
		$this->headerTrait->addHeader( 'TEST', '5678' );
		$actual = $this->headerTrait->getHeaderLine( 'Test' );

		$this->assertEquals( '1234,5678', $actual );
	}
}
?>