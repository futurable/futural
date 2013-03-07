<?php

/**
 *  CommonFunctions.php
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
 * CommonFunctions for general functions
 * 
 * @package   CommonServices
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-09-07
 */

Class CommonFunctions{
	/**
	 * Static function for getting current url
	 * 
	 * @access 	public
	 * @param	bool	$getCommandString 	Get URL command string, default false
	 * @return 	mixed  	$currentPageURL		Current page URL
	 */
	public static function getCurrentPageURL($getCommandString = false) {
		$currentPageURL = 'http';
		if (isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] == "on"){
			$currentPageURL .= "s";
		}
		$currentPageURL .= "://";
		
		if($getCommandString === true){ 
			$pageName = $_SERVER["REQUEST_URI"];
		}
		else{
			$pageName = $_SERVER['PHP_SELF'];
		}
		
		if ($_SERVER["SERVER_PORT"] != "80") {
			$currentPageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$pageName;
		} 
		else {
			$currentPageURL .= $_SERVER["SERVER_NAME"].$pageName;
		}
		return $currentPageURL;
	}
	
	/**
	 * Static function for getting current command string
	 * 
	 * @access 	public
	 * @return 	string  	$commandString	Current page command string
	 */
	public static function getCommandString(){
		// Get-array to string
		$commandString = null;
		
		foreach($_GET as $key => $value){
			if($key!='lang'){
				$commandString .= "$key=$value&amp;";
			}
		}
		
		return $commandString;
	}
	
	/**
	 * Static function for calculating the verification number for reference number
	 * 
	 * @access 	public
	 * @param	number	$number					Number from which the verification number is calculated
	 * @return 	int  	$verificationNumber		Calculated verification number
	 */
	public static function getReferenceNumberVerificationNumber($number) {
		$number = strval($number);
	  	$weight = array(7, 3, 1);
	  	$sum = 0;
	  	
	  	for( $i = strlen($number)-1, $j=0; $i>=0; $i--,$j++){
	    	$sum += (int) $number[$i] * (int) $weight[$j%3];
	  	}
	  	
	  	$verificationNumber = (10-($sum%10))%10;
	  	return $verificationNumber;
	}
	
	/**
	 * Static function for calculating time between two dates
	 * 
	 * @access 	public
	 * @param 	string	$startDate			start date in ISO format (yyyy-mm-dd)
	 * @param 	string	$endDate			end date in ISO format (yyyy-mm-dd)
	 * @return 	int		$daysBetweenDates	 The amount of days between dates (ie. between yesterday and today is one day)
	 */
	public static function getTimeBetweenTwoDates($startDate, $endDate){
		date_default_timezone_set('Europe/Helsinki');
		$daysBetweenDates = null;
		
		if ( DataValidator::isDateISOSyntaxValid($startDate) === true && DataValidator::isDateISOSyntaxValid($endDate) === true){
			$startTime = strtotime($startDate);
			$endTime = strtotime($endDate);
			$time =  $endTime - $startTime;
			
			$daysBetweenDates = round( $time / 86400 );
		}
		
		return $daysBetweenDates;
	}
	
	/**
	 * Static function for setting include path
	 * 
	 * @access public
	 * @return bool		$success	true on success, else false
	 */
	public static function setIncludePath() {
		$success = false;
		
		// Get include path from config file
		$handle = file_get_contents("../Conf/conf-environment.xml", true);
		$xml = new SimpleXMLElement($handle);
		$includePath = $xml->includePath;
		
		// Check that include path is valid
		if(is_dir($includePath)){
			set_include_path($includePath);
			$success = true;
		}
		else {
			$success = false;
		}
		
		return $success;
	}
	
	/**
	 * Get disclaimer div which contain useful information for user.
	 * Useful information: what is this environment, who offres it and give feedback sections.
	 * 
	 * @access  public (static)
	 * @return  string  $content   disclaimer div in html
	 */
	public static function getDisclaimerDiv() {
		$content = "<div class='disclaimer'>\n
						<p>
							This is <a href='http://futurable.fi/index.php/en/tuotteet-ja-palvelut/oppimisymparistot' rel='external'>Futural</a> - virtual learning environment 
							by <a href='http://futurable.fi/index.php/en/' rel='external'>Futurable</a>.
							<a href='#'>Give feedback</a>.
						</p>
					</div>\n";
		
		return $content;
	}
        
        /**
         * Get footer with link to account creation
         * 
         * @access public (static)
         * @return string $content  account creation div in html
         */
        public static function getStartupDiv() {
            $content = "<div class='disclaimer startup'>\n
                            <p>Need a company? Go to the <a href='startup/'>startup page</a> to create one.</p>\n
                        </div>\n";
            
            return $content;
        }
	
	/**
	 * 
	 * Trim given number value to php-numeric decimal
	 * @param 	string 	$value
	 * @return 	decimal	$decimal
	 */
	public static function trimToDecimal($value){
		$decimal = 	str_replace(" ", "", $value);
		$decimal =	str_replace(",", ".", $decimal);
		
		return $decimal;
	}
	
	/**
	 * Function for getting current date as UTC formatted date or to format given ISO date
	 * @param string 	$date		ISO formatted date (optional), default false
	 * @return string 	$UTCdate 	UTC-formatted date (Y-m-d\TH:i:sP)
	 */
	public static function getUTCFormattedDate($date = false){
		$UTCdate = false;

		if($date == false){
			$UTCdate = date('Y-m-d\TH:i:sP');
		}
		elseif( DataValidator::isDateISOSyntaxValid($date) || DataValidator::isDateTimeISOSyntaxValid($date) ){
			$UTCdate = date('Y-m-d\TH:i:sP', strtotime($date));
		}
		else $UTCdate = false;
		
		return $UTCdate;
	}
}
?>