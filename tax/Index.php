<?php
/**
 *  Index.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2013 Annika Granlund <annika.granlund@futurable.fi>
 *      				   Jarmo Kortetjärvi <jarmo.kortetjarvi@futurable.fi>
 *
 *  License
 *
 *      This file is part of project Futural/tax.
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

require_once '../Conf/EnvironmentConfiguration.php';

/**
 * Index.php
 * 
 * @package   tax
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2013-01-08
 */

header('Content-type: text/html; charset=utf-8');
 
// Get include path from config file
$EnvConf = new EnvironmentConfiguration();
$includePath = $EnvConf->getIncludePath();

// Check that include path is valid
if(is_dir($includePath)){
	set_include_path($includePath);
}
else {
	die('ERROR: invalid include path.');
	exit;
}

require_once 'tax/UI/UIView.php';
require_once 'tax/UI/Header.php';
require_once 'tax/UI/Footer.php';
require_once 'tax/UI/Navigation.php';
require_once 'tax/UI/Content.php';
require_once 'tax/Model/User.php';
require_once 'CommonServices/DatabaseConnect.php';
require_once 'CommonServices/SessionManager.php';
require_once 'AuthComponent/AuthComponent.php';
require_once 'LocalizationComponent/LocalizationComponent.php';

SessionManager::sessionStart( 'FuturalTax' );
$authenticated = SessionManager::isAuthenticated();

// user navigates first time to page, go to login page
if ( ($authenticated === false) and (!isset($_POST[ 'login' ])) ) {
	$page = new UiView();
	$page->displayLoginPage();
} else if ( ($authenticated === false) and (isset($_POST[ 'login'])) ) { // User has sent login form
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
		// TODO: error message
	}
}

// if user has been authenticated
if ( $authenticated === true ) {
	if ( isset( $_GET[ 'page']) and $_GET[ 'page'] === 'Logout' ) {
		SessionManager::sessionEnd();
		$page = new UiView();
		$page->displayLoginPage();
	} 
	else {
		if( isset( $_GET[ 'page']) and $_GET[ 'page'] === 'SelectCompany' ){
			unset( $_SESSION['businessID'] );	
		} 
		
		// Set language to session
		if( isset( $_GET[ 'lang'] ) && $_GET[ 'lang' ] ){
			SessionManager::setVariables( array( "lang" => $_GET[ 'lang' ]) );	
		}
		
		// Set company to session
		if (isset($_POST[ 'chosenCompany' ]) and $_POST[ 'chosenCompany' ]) {
			SessionManager::setVariables( array( "businessID" => $_POST[ 'businessID' ]) );		
		}
		
		$userId = SessionManager::getVariable('id');
		// Create User object
		$user = User::createUserById($userId);
		
		// Set language
		if(isset($_SESSION['lang'])){
			$user->setLanguage( SessionManager::getVariable('lang') );
		}
		if ( isset($_SESSION[ 'businessID' ]) ) {
			$user->setCurrentCompany( SessionManager::getVariable( 'businessID' ) );
		}
		
		
		LocalizationComponent::setLocalization( $user->getLanguage() );
		$page = new UiView();
		$page->displayInHtml($user);
	}
} // no else
?>