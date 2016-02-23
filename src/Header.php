<?php namespace Kshabazz\Http;


trait Header
{
	private
		$headers = [],

		/**
		 * Because the spec says that it should be allowed to set/get a header, but not worry about case, a
		 * lower-case map is used manage them
		 *
		 * @var array
		 */
		$headerMap = [];

	/**
	 * Keep in mind, how you spell the header the first time, is how it will be sent.
	 *
	 * @param string $pName
	 * @param string $pValue
	 */
	function addHeader( $pName, $pValue )
	{
		$name = $this->getMappedName( $pName );

		// Headers can have multiple values, store as an array for joining or getting an exact line at any time.
		$this->headers[ $name ][] = $pValue;
	}

	/**
	 * @param string $pName
	 * @return array
	 */
	public function getHeader( $pName )
	{
		$name = $this->getMappedName( $pName );

		if ( empty($name) )
		{
			$value = '';
		}
		else
		{
			$value = $this->headers[ $name ];
		}

		return $value;
	}

	/**
	 * @param string $pName
	 * @return string
	 */
	public function getHeaderLine( $pName )
	{
		$name = $this->getMappedName( $pName );

		if ( empty($name) )
		{
			$value = '';
		}
		else
		{
			$value = \join( ',', $this->headers[$name] );
		}

		return $value;
	}

	/**
	 * @param $pName
	 * @return string
	 */
	private function getMappedName( $pName )
	{
		$name = $pName;
		$mapping = \strtolower( $pName );

		// The first time a header is set, store that value in a map since names are case insensitive; making it
		// possible to be found and then append, remove, or updated it appropriately.
		if ( !\array_key_exists( $mapping, $this->headerMap ) )
		{
			$this->headerMap[ $mapping ] = $pName;
		}
		else // Otherwise, make sure any additional values are appended to the same header name.
		{
			$name = $this->headerMap[ $mapping ];
		}

		return $name;
	}
}
?>