<?php namespace Kshabazz\Http;


trait Header
{
	private
		$headers,
		/** @var array All keys are lower-case version of the actual header keys.*/
		$headerMap;

	/**
	 * Keep in mind, how you spell the header the first time, is how it will be sent.
	 *
	 * @param $pName
	 * @param $pValue
	 */
	function addHeader($pName, $pValue)
	{
		// Headers can have multiple values, store as an array for joining or getting an exact line at any time.
		$this->headers[ $pName ][] = $pValue;

		// Always mapping the header name to lowercase make it simpler to manage.
		$name = \strtolower( $pName );

		// Only store a header name in the map once since names are case insensitive; making it possible to be found and
		// then updated/removed appropriately.
		if ( !\array_key_exists($name, $this->headerMap) )
		{
			$this->headerMap[ $name ] = $pName;
		}
	}
}
?>