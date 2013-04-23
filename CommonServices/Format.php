<?php
/**
 *  Format.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Jarmo Kortetjärvi <jarmo.kortetjarvi@futurable.fi>
 *
 *  License
 *
 *      This file is part of project Futural/CommonServices.
 *
 *		This program is free software: you can redistribute it and/or modify
 *		it under the terms of the GNU General Public License as published by
 * 		the Free Software Foundation, either version 3 of the License, or
 *		(at your option) any later version.
 *
 *		This program is distributed in the hope that it will be useful,
 *		but WITHOUT ANY WARRANTY; without even the implied warranty of
 *		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *		GNU General Public License for more details.
 *
 *		You should have received a copy of the GNU General Public License
 *		along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * For data formatting
 * 
 * @package   CommonServices
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-09-07
 */

require_once('DataValidator.php');

/**
 * Format for common string formatting
 * 
 * @package   CommonServices
 * @author    Jarmo Kortetjärvi
 * @copyright 2011 <jarmo@futurable.fi>
 * @license   GPL v2 or any later version
 * @version   2011-08-31
 */

class Format {
	
	public function __construct(){
		
	}
 
	/**
	 * Static function for formatting finnish business ID (y-tunnus)
	 * 
	 * @access 	public
	 * @param	int			$businessID				Business ID as integer ( 12345678 )
	 * @return 	string  	$businessIDFormatted	Business ID formatted as 1234567-8
	 */
	public static function formatBusinessID( $businessID ){
		if( DataValidator::isPositiveIntValid( $businessID, 8 ) ){
			
			$businessIDFormatted = substr($businessID, 0, 7)."-".substr($businessID, 7, 1);
			
			return $businessIDFormatted;
		}
		else return $businessID;
	}
	
	/**
	 * Static function for formatting numbers to two-decimal, point separated ( 1 -> 1.00, 0 -> 0.00 )
	 * @param 	numeric 	$number
	 * @param	int 		$decimals	Number of decimals, default 2
	 * @return	decimal 	$formatted	Return formatted decimal if given variable was valid, else return given variable
	 */
	public static function formatDecimal( $number, $decimals = false ){
		$formatted = null;
		
		if( $decimals && !DataValidator::isPositiveIntValid($decimals) ){
			$decimals = $decimals;
		}
		else $decimals = 2;
		
		if( DataValidator::isNumericValid($number)){
			$number = str_replace(',', '.', $number);
			$number = str_replace(' ', '', $number);
			$formatted = number_format( $number, $decimals, '.', ' ' );	
		}
		else $formatted = $number;
		
		return $formatted;
	}
	
	/**
	 * Static function for formatting finnish IBAN number
	 * @param 	string 		$IBAN
	 * @return	decimal 	$return	Return formatted IBAN if given variable was valid, else return given variable
	 */
	public static function formatIBAN( $IBAN ){
		$return = $IBAN;
		
		if( DataValidator::isIBANValid($IBAN) ){
			$formatted = null;
			
			for($i = 0; $i < strlen($IBAN) / 4; $i++ ){
				$formatted .= substr($IBAN, $i*4, 4);
				$formatted .= " ";
			}
			
			$return = $formatted;
		}
		
		return $return;	
	}
	
	/**
	 * Static function for formatting date in EURO format to ISO format.
	 * dd.mm.yyyy => yyyy-mm-dd
	 * 
	 * @access public
	 * @param  string $dateInEUROFormat (dd.mm.yyyy)
	 * @return string $dateInISOFormat  (yyyy-dd-mm), default return NULL
	 */
	public static function formatEURODateToISOFormat( $dateInEUROFormat ) {
		$dateInISOFormat = NULL;
		date_default_timezone_set('Europe/Helsinki');
		
		if ( DataValidator::isDateEUROSyntaxValid($dateInEUROFormat) === true ) {
			$dateInISOFormat = DateTime::createFromFormat('d.m.Y', $dateInEUROFormat);
			$dateInISOFormat = $dateInISOFormat->format('Y-m-d');
		}
		return $dateInISOFormat;
	}
	
	/**
	 * Static function for formatting date in ISO format to EURO format.
	 * yyyy-mm-dd => dd.mm.yyyy
	 * 
	 * @access public
	 * @param  string $dateInISOFormat  (yyyy-mm-dd)
	 * @return string $dateInEUROFormat (dd.mm.yyyy), default return NULL
	 */
	public static function formatISODateToEUROFormat( $dateInISOFormat ) {
		$dateInEUROFormat = NULL;
		date_default_timezone_set('Europe/Helsinki');
		
		if (DataValidator::isDateISOSyntaxValid( $dateInISOFormat )) {
			$dateInEUROFormat = new DateTime( $dateInISOFormat );
			$dateInEUROFormat = $dateInEUROFormat->format('d.m.Y');
		}
		
		return $dateInEUROFormat;
	}
}
?>