<?php
/**
 *  DataValidator.php
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
 * Data validator for data validation
 * 
 * @package   CommonServices
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-09-07
 */

class DataValidator{
	
	public function __construct() {
		
	}
	
	/**
	 * Static function for validating an integer value
	 * 
	 * @access 	public
	 * @param 	int 	$value		Integer to be validated
	 * @param 	int 	$length		Number of characters, default false
	 * @return 	bool	$valid		Returns true on success, false on error
	 */
	public static function isIntValid($value, $length = false){
		$isValid = false;
		
		// No length defined
		if( $length == false ){
			$pattern = "/^[-]?[0-9]+$/";
		}
		// Length is defined
		else{
			$pattern = "/^[-]?[0-9]{".$length."}$/";
		}
		
		// Value is valid
		if( preg_match( $pattern , $value) ) $isValid = true;
		
		return $isValid;
	}
	/**
	 * Static function for validating a positive integer value
	 * 
	 * @access 	public
	 * @param 	int 	$value		Integer to be validated
	 * @param 	int 	$length		Number of characters, default false
	 * @return 	bool	$valid		Returns true on success, false on error
	 */
	public static function isPositiveIntValid($value, $length = false){
		$isValid = false;
		if($value >= 0){
			if(self::isIntValid($value, $length)){
				$isValid = true;
			}
			else $isValid = false;
		}
		else $isValid = false;
		
		return $isValid;
	}

	/**
	 * Static function for validating a decimal value
	 * 
	 * @access 	public
	 * @param 	float 	$value		Decimal to be validated
	 * @param 	int 	$length		Decimal number length. Only numbers are noted, comma(,), period(.) sign bit (-) and  are ignored, default false
	 * @param 	int 	$decimals	Number of decimals, default false
	 * @param 	string 	$delimiter	Decimal delimiter, default '.' (period) AND ',' (comma). Only accepts one (1) character delimiter
	 * @return 	bool	$isValid	Returns true on success, false on error
	 */
	public static function isDecimalValid($value, $length = false, $decimals = false, $delimiter = false){
		$isValid = false;
		
		// Default delimiters
		if($delimiter == false) $delimiter = ',.';
		// Delimiter is malformed
		elseif(strlen($delimiter) != 1) return false;
		
		// Length is defined
		if($length != false){
			// Strip delimiter from value
			$intValue = preg_replace("/[-]?[^0-9]+/", '', $value);
			// Check length
			if( strlen($intValue) != $length ) return false;
		}
		
		// Number of decimals is defined
		if($decimals != false){
			// Strip all but characters after delimiter
			$decValue = preg_replace("/^.+[".$delimiter."]/", '', $value);
			// Check number of decimals
			if( strlen($decValue) != $decimals ) return false;
		}
		
		// Check decimal format validity
		$pattern = "/^[-]?[0-9]+[".$delimiter."][0-9]+$/";
		
		// Value is valid
		if( preg_match( $pattern , $value) ) $isValid = true;
		
		return $isValid;
	}
	
	/**
	 * Static function for validating a positive decimal value
	 * 
	 * @access 	public
	 * @param 	float 	$value		Decimal to be validated
	 * @param 	int 	$length		Decimal number length. Only numbers are noted, comma(,), period(.) sign bit (-) and  are ignored, default false
	 * @param 	int 	$decimals	Number of decimals, default false
	 * @param 	string 	$delimiter	Decimal delimiter, default '.' (period) AND ',' (comma). Only accepts one (1) character delimiter
	 * @return 	bool	$isValid	Returns true on success, false on error
	 */
	public static function isPositiveDecimalValid($value, $length = false, $decimals = false, $delimiter = false){
		$isValid = false;
		
		if($value >= 0){
			if(self::isDecimalValid($value, $length, $decimals, $delimiter)){
				$isValid = true;
			}
			else $isValid = false;
		}
		else $isValid = false;
		
		return $isValid;
	}
	
	/**
	 * Static function to validate numeric values
	 * 
	 * @access public
	 * @param  decimal	$value
	 * @return bool		$isValid
	 */
	public static function isNumericValid( $value ){
		$isValid = false;
		
		if( self::isIntValid($value) || self::isDecimalValid($value) ){
			$isValid = true;
		}
		else $isValid = false;
		
		return $isValid;
	}
	
	/**
	 * Static function to validate positive numeric values
	 * 
	 * @access public
	 * @param  decimal	$value
	 * @return bool		$isValid
	 */
	public static function isPositiveNumericValid( $value ){
		$isValid = false;
		
		if( self::isPositiveIntValid($value) || self::isPositiveDecimalValid($value) ){
			$isValid = true;
		}
		else $isValid = false;
		
		return $isValid;
	}
	
	/**
	 * Static function for validating string
	 * 
	 * @access 	public
	 * @param 	string 	$value		String to be validated
	 * @param 	int 	$length		Length of string, default false
	 * @return 	bool	$isValid	Returns true on success, false on error
	 */
	public static function isStringValid($value, $length = false){
		$isValid = false;
		
		// Value is string
		if(is_string($value)){
			// Check length
			if($length){
				if( strlen($value) == $length ){
					$isValid = true;
				}
			}
			else $isValid = true;
		}
		
		return $isValid;
	}

	/**
	 * Static function for validating an email
	 * 
	 * @access 	public
	 * @param 	float 	$value		Email to be validated
	 * @return 	bool	$isValid	Returns true on success, false on error
	 */
	public static function isEmailValid($value){
		$isValid = false;
		
		if(filter_var($value, FILTER_VALIDATE_EMAIL)) $isValid = true;
		
		return $isValid;
	}
	
	/**
	 * Static function for validating an IBAN account number
	 * 
	 * @access 	public
	 * @param 	float 	$value		IBAN to be validated
	 * @return 	bool	$isValid	Returns true on success, false on error
	 */
	public static function isIBANValid($value){
		require_once 'IBANComponent/IBANComponent.php';
		$isValid = false;
		
		if(IBANComponent::verify_iban($value) == true) $isValid = true;
		
		return $isValid;
	}
	
	/**
	 * Static function for validating a BIC-code
	 * 
	 * @access 	public
	 * @param 	string 	$BIC		BIC-code to be validated
	 * @return 	bool	$valid		Returns true on success, false on error
	 */
	public static function isBICValid($BIC){
		$isValid = false;
		
		$isValid = DataValidator::isFinnishBICValid($BIC);
		
		return $isValid;
	}
	
	public static function isFinnishBICValid($BIC){
		$isValid = false;
		
		// Check BIC format validity
		$pattern = "/^[A-Z0-9]{8}$/";
		
		// Value is valid
		if( preg_match( $pattern , $BIC) ) $isValid = true;
		
		return $isValid;
	}
	
	/**
	 * Static function for validating a reference number
	 * 
	 * @access 	public
	 * @param 	int 	$value		Reference number to be validated
	 * @return 	bool	$isValid	Returns true on success, false on error
	 */
	public static function isReferenceNumberValid( $value ) {
		require_once 'CommonFunctions.php';
		$isValid = false;
		
		// Archive number without verificaton number
		$cleanNumber = substr($value, 0, -1);
		
		// Verification numbers
		$verificationNumber = substr($value, -1);
		$verificationValue = CommonFunctions::getReferenceNumberVerificationNumber($cleanNumber);
		
		if($verificationNumber == $verificationValue) $isValid = true;
		
		return $isValid;
	}
	
	/**
	 * Static function for validating archive number
	 * 
	 * @access 	public
	 * @param 	int 	$value		Archive number to be validated
	 * @return 	bool	$isValid	Returns true on success, false on error
	 */
	public static function isArchiveNumberValid( $value ) {
		$isValid = false;
		
		$pattern = "/^[O][I][V][A][B][a-zA-Z0-9]{13}$/";
		
		if( preg_match( $pattern , $value) ) $isValid = true;
		
		return $isValid;
	}
	
	/**
	 * Static function for validating a date in euro format (dd.mm.yyyy)
	 * 
	 * @access 	public
	 * @param 	float 	$date			Date to be validated
	 * @return 	bool	$isValid		Returns true on success, false on error
	 */
	public static function isDateEUROSyntaxValid ( $date ){
		$isValid = false;
		
		// Check the format validity
		$pattern = "/^[0-9]{2}[.][0-9]{2}[.][0-9]{4}$/";
		if( preg_match( $pattern , $date) ){
			// Check the date validity
			$day = substr($date, 0, 2);
			$month = substr($date, 3, 2);
			$year = substr($date, 6, 4);
			
			if(checkdate($month, $day, $year) === true){
				$isValid = true;
			}
		}
		
		return $isValid;
	}
	
	/**
	 * Static function for validating a date in ISO format (yyyy-mm-dd)
	 * 
	 * @access 	public
	 * @param 	float 	$date			Date to be validated
	 * @return 	bool	$isValid		Returns true on success, false on error
	 */
	public static function isDateISOSyntaxValid( $date ){
		$isValid = false;
		
		// Check the format validity
		$pattern = "/^[0-9]{4}[-][0-9]{2}[-][0-9]{2}$/";
		if( preg_match( $pattern , $date) ){
			// Check the date validity
			$year = substr($date, 0, 4);
			$month = substr($date, 5, 2);
			$day = substr($date, 8, 2);
			
			if(checkdate($month, $day, $year) === true) $isValid = true;
			else $isValid = false;
		}
		
		return $isValid;
	}
	
	/**
	 * Static function to validate ISO-formatted time (hh:ii:ss)
	 * @param 	string 	$time		Time to be validated
	 * @return 	bool 	$isValid	Returns true on success, false on error
	 */
	public static function isTimeISOSyntaxValid($time){
		$isValid = false;
		// Check format validity
		$pattern = "/^[0-9]{2}[:][0-9]{2}[:][0-9]{2}$/";
	
		// Check the time validity
		if( preg_match( $pattern , $time) ){
			$hours 		= substr($time, 0, 2);
			$minutes 	= substr($time, 3, 2);
			$seconds 	= substr($time, 6, 2);
			
			// Check hours, minutes and seconds (yes, the int-validation is a little redundant)
			if( self::isPositiveIntValid($hours) && $hours>=0 && $hours<=23 ) $hoursValid = true;
			else $hoursValid = false;
			
			if( self::isPositiveIntValid($minutes) && $minutes>=0 && $minutes<=60 ) $minutesValid = true;
			else $minutesValid = false;
			
			if( self::isPositiveIntValid($seconds) && $seconds>=0 && $seconds<=60 ) $secondsValid = true;
			else $secondsValid = false;
			
			if( $hoursValid === true && $minutesValid === true && $secondsValid === true) $isValid = true;
			else $isValid = false;
		}
		else $isValid = false;
		
		return $isValid;
	}
	
	/**
	 * Static function for validating a datetime in ISO format (yyyy-mm-dd hh:ii:ss)
	 * @param 	string 	$datetime	Datetime to be validated
	 * @return 	bool 	$isValid	Returns true on success, false on error
	 */
	public static function isDateTimeISOSyntaxValid( $datetime ){
		$isValid = false;
	
		$date = substr($datetime, 0, 11);
		$time = substr($datetime, 11);
		
		if( self::isDateISOSyntaxValid($date) || self::isTimeISOSyntaxValid($time) ) $isValid = true;
		else $isValid = false;
	
		return $isValid;
	}
	
	/**
	 * Static function for checking that a date isn't in the future
	 * Accepts ISO-formattd and EURO-formatted dates
	 * 
	 * @access 	public
	 * @param 	string 	$date			Date to be checked
	 * @return 	bool	$isValid		Returns true on success, false on error
	 */
	public static function isDateNotInFuture( $date ){
		$isValid = false;
		
		// Check date format
		if( self::isDateISOSyntaxValid($date) || self::isDateEUROSyntaxValid($date) ){
			// Check that date is not in future
			$datestamp = strtotime($date);
			$timestamp = strtotime(date('Y-m-d'));
			
			if( $datestamp > $timestamp ){
				$isValid = false;
			}
			else $isValid = true;
		}
		
		return $isValid;
	}
	
	/**
	 * Static function for checking that a date isn't in the past
	 * Accepts ISO-formattd and EURO-formatted dates
	 * 
	 * @access 	public
	 * @param 	string 	$date			Date to be checked
	 * @return 	bool	$isValid		Returns true on success, false on error
	 */
	public static function isDateNotInPast( $date ){
		$isValid = false;
		
		// Check date format
		if( self::isDateISOSyntaxValid($date) || self::isDateEUROSyntaxValid($date) ){
			// Check that date is not in future
			$datestamp = strtotime($date);
			$timestamp = strtotime(date('Y-m-d'));
			
			if( $datestamp < $timestamp ){
				$isValid = false;
			}
			else $isValid = true;
		}
		
		return $isValid;
	}
	
	/**
	 * Static function for checking that start date is before end date
	 * Accepts ISO-formattd and EURO-formatted dates
	 * 
	 * @access 	public
	 * @param 	string 	$startDate		Start date
	 * @param 	string 	$startDate		End date
	 * @return 	bool	$isValid		Returns true on success, false on error
	 */
	public static function isStartDateBeforeEndDate( $startDate, $endDate ){
		$isValid = false;
		
		// Check date formats
		if( ( self::isDateISOSyntaxValid($startDate) || self::isDateEUROSyntaxValid($startDate) ) ||
			( self::isDateISOSyntaxValid($endDate) || self::isDateEUROSyntaxValid($endDate) ) ){
			$startStamp = strtotime($startDate);
			$endStamp = strtotime($endDate);
			
			if( $startStamp > $endStamp){
				$isValid = false;
			}
			else $isValid = true;
		}
		
		return $isValid;
	}
	
	/**
	 * Static function for checking finnish VAT-number (y-tunnus)
	 * 
	 * @access 	public
	 * @param 	string 	$startDate		$businessID
	 * @return 	bool	$isValid		Returns true on success, false on error
	 */
	public static function isBusinessIDValid($businessID) {
   		$isValid = false;
		
		if( strlen($businessID) == 8){
		   $num = substr($businessID, 0, 7);
		   $checksum = substr($businessID, 7, 1);
		   
		   $mp = array(7,9,10,5,8,4,2);
		   
		   $sum = 0;
		   for($i=0;$i<7;$i++) {
		      $sum += (int)(substr($num,$i,1) * $mp[$i]);
		   }
		   
		   $check = $sum % 11;   
		   if(!$check && !$checksum) $isValid = true;
		   elseif($check > 1 && (11 - $check) == $checksum) $isValid = true;
	
		}
		else $isValid = false;
   
   		return $isValid;
	}
	
	/**
	 * Static function to validate Oivapankki archive ID
	 * 
	 * @access public
	 * @param  string	$value
	 * @return bool		$isValid
	 */
	public static function isArchiveIDValid( $value ){
		$isValid = false;
		
		if( is_string($value) && strlen($value) == 18 && substr($value,0,5) == 'OIVAB' ){
			$isValid = true;
		}
		else $isValid = false;
		
		return $isValid;
	}
}
?>