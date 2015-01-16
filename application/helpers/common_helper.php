<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('currency_to_number'))
{
	function currency_to_number($str = '')
	{
		return trim( preg_replace("/[^0-9\.]/", "", $str) );
	}
}