<?php
/**
 *  Index.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Annika Granlund <annika.granlund@futurable.fi>
 *
 *  License
 *
 *      This file is part of project Futural/bank.
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
 * BankLoanContent
 * Class for bank loan content (all active loans and their information)
 *
 * @package   UI
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-22
 */
header('Content-type: text/html; charset=utf-8');
 
#error_reporting(E_ALL);
#ini_set("display_errors", 1);

// Get include path from config file
$handle = file_get_contents("../Conf/conf-environment.xml", true);
$xml = new SimpleXMLElement($handle);
$includePath = $xml->includePath;

// Check that include path is valid
if(is_dir($includePath)){
	set_include_path($includePath);
}
else {
	die('ERROR: invalid include path.');
	exit;
}

require_once 'bank/UI/UiView.php';
require_once 'bank/UI/Header.php';
require_once 'bank/UI/Footer.php';
require_once 'bank/UI/Navigation.php';
require_once 'bank/UI/Content.php';
require_once 'CommonServices/DatabaseConnect.php';
require_once 'AuthComponent/AuthComponent.php';
require_once 'CommonServices/SessionManager.php';
require_once 'CommonServices/Format.php';
require_once 'LocalizationComponent/LocalizationComponent.php';
require_once 'bank/Model/BusinessCustomer.php';
require_once 'bank/Model/Admin.php';

SessionManager::sessionStart( 'FuturalBank' );
$authenticated = SessionManager::isAuthenticated();

// user navigates first time to page, go to login page
if ( ($authenticated === false) and (!isset($_POST[ 'login' ])) ) {
	$page = new UiView();
	$page->displayLoginPage();
} else if ( ($authenticated === false) and (isset($_POST[ 'login'])) ) { // user has sent login form
	$authenticated = AuthComponent::isUserValidByArray( $_POST );
	
	if ( $authenticated === true ) { 
		// user valid
		$userId = $_POST[ 'username' ];
	
		$sessionArray = array( 'authenticated' => 'true', 'id' => $userId );
		SessionManager::setVariables( $sessionArray );
	} else { 
		// user not valid
		$page = new UiView();
		$page->displayLoginPage();
	}
}

// if user has been authenticated
if ( $authenticated === true ) {
	if ( isset( $_GET[ 'page']) and $_GET[ 'page'] === 'Logout' ) {
		SessionManager::sessionEnd();
		$page = new UiView();
		$page->displayLoginPage();
	} else {
		if( isset( $_GET[ 'lang'] ) && $_GET[ 'lang' ] ){
			SessionManager::setVariables( array( "lang" => $_GET[ 'lang' ]) );	
		}
		
		$userId = SessionManager::getVariable('id');
		// Create User object
		$user = User::createUserById($userId);
		// Set language
		if(isset($_SESSION['lang'])){
			$user->setLanguage( SessionManager::getVariable('lang') );
		}
		
		LocalizationComponent::setLocalization( $user->getLanguage() );
		$page = new UiView();
		$page->displayInHtml($user);
	}
} // no else
?>