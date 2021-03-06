<?php
/**
* @package		EasySocial
* @copyright	Copyright (C) 2010 - 2012 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasySocial is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );

/**
 * Helper file for address.
 *
 * @since	1.0
 * @author	Mark Lee <mark@stackideas.com>
 */
class SocialFieldsUserAddressHelper
{
	/**
	 * Retrieves a list of countries from the manifest file.
	 *
	 * @since	1.0
	 * @access	public
	 * @return 	Array	 An array of countries.
	 *
	 * @author	Mark Lee <mark@stackideas.com>
	 */
	public static function getCountries( $sort = 'name', $display = 'name' )
	{
		$file 		= Foundry::resolve( 'fields:/user/address/countries.json');
		$contents 	= JFile::read( $file );

		$json 		= Foundry::json();
		$countries 		= (array) $json->decode( $contents );

		if( $sort === 'code' )
		{
			ksort( $countries );
		}

		if( $sort === 'name' )
		{
			asort( $countries );
		}

		$data = new stdClass();

		foreach( $countries as $key => $value )
		{
			if( $display === 'code' )
			{
				$data->$key = $key;
			}

			if( $display === 'name' )
			{
				$data->$key = $value;
			}
		}

		return $data;
	}

	/**
	 * Gets the country title given the code.
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public static function getCountryName( $code )
	{
		$countries = self::getCountries();

		$value 		= '';
		if( isset( $countries->$code ) )
		{
			$value 	= $countries->$code;
		}

		return $value;
	}

}
