<?php
/**
 *  SessionManager.php
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
 * For session management
 * 
 * @package   CommonServices
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-09-07
 */

require_once 'Crypt.php';
require_once 'CommonFunctions.php';

/**
 * SessionManager is responsible of modifying session variables
 * 
 * @package   CommonServices
 * @author    Jarmo Kortetjärvi
 * @copyright 2011 <jarmo@futurable.fi>
 * @license   GPL v2 or any later version
 * @version   2011-09-21
 */
Class SessionManager {

	public function __construct(){
	}
	
	/**
	 * Static function for starting session
	 * 
	 * @access 	public
	 * @param 	string	$sessionName		Session namee
	 * @return	bool	true on success;
	 */
	public static function sessionStart( $sessionName ){
		ini_set('session.gc-maxlifetime', 7200);
		session_set_cookie_params(3200);
		session_name($sessionName);
		session_start();
		
		// Regenerate session ID every 5 minutes
		if(!isset($_SESSION['CREATED'])){
			self::setVariables( array( 'CREATED' => time() ) );
		}
		else if (time() - $_SESSION['CREATED'] > 300 ) {
		    session_regenerate_id(true);
		    $_SESSION['CREATED'] = time(); 
		}
		
		// Destroy session if idle for over 15 minutes
		if( isset($_SESSION['REFRESHED']) && ( time() - $_SESSION['REFRESHED'] > 900 ) ) {
		    session_destroy();
		    session_unset();
		    
		    $currentPageURL = CommonFunctions::getCurrentPageURL();
		    header("Location: $currentPageURL?timeout=1");
		}
		$_SESSION['REFRESHED'] = time();
		
	}
	
	/**
	 * Static function for setting session variables
	 * 
	 * @access 	public
	 * @param 	array	$variables			Variables to be inserted into session. Array keys can't start with number
	 * @param	bool	$encrypt			If variables should be encrypted, default true
	 * @return	bool	true on success;
	 */
	public static function setVariables( $variables, $encrypt = true ) 
	{
		// Check the given array
		if(!is_array($variables)) return false;
		
		// Insert variables into session
		foreach($variables AS $varName => $varValue){
			// Check if variable is integer
			if(is_numeric($varName)) return false;
			
			// Encrypt variables
			if($encrypt===true){
				// Check if
				$varValue = Crypt::encrypt($varValue);
			}
			$_SESSION[$varName] = $varValue;
		}
		return true;

	}
	
	/**
	 * Static function to get encrypted session data as plain text
	 * 
	 * @access 	public
	 * @param 	string 	$varName		Session variable name
	 * @param	bool	$encrypt		If variables should be encrypted, default true
	 * @return	mixed	$returnValue	Decrypted string
	 */
	public static function getVariable($varName){
		if(isset($_SESSION[$varName])){
			$returnValue = Crypt::decrypt($_SESSION[$varName]);
			return $returnValue;
		}
		else return false;
	}
	
	/**
	 * Check if session has authenticated and return its BOOLEAN value.
	 * 
	 * @access  public
	 * @return  boolean $isAuthenticated
	 */
	public static function isAuthenticated() {
		Debug::debug(get_class(), "isAuthenticated", "Start");
		$isAuthenticated = false;
		
		if (isset($_SESSION[ 'authenticated'])) {
			Debug::debug(get_class(), "isAuthenticated", "SESSION has authenticated variable", 2);
			$auth = Crypt::decrypt($_SESSION[ 'authenticated']);
			
			if ( $auth === 'true' ) {
				Debug::debug(get_class(), "isAuthenticated", "SESSION authenticated has value true (in string)", 2);
				$isAuthenticated = true;
			}
		}
		
		Debug::debug(get_class(), "isAuthenticated", "Return isAuthenticated = $isAuthenticated");
		return $isAuthenticated;
	}
	
	/**
	 * Static function to destroy session
	 * 
	 * @access 	public
	 */
	public static function sessionEnd(){
		session_destroy();
		session_unset();
		$currentPageURL = CommonFunctions::getCurrentPageURL();
		header("Location: $currentPageURL");
	}
	
}

?>