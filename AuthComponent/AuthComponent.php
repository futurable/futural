<?php
/**
 *  AuthComponent.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Annika Granlund <annika.granlund@futurable.fi>
 *
 *  License
 *
 *      This file is part of project Futural/AuthComponent.
 *
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
 * @package AuthComponent
 *
 */

/**
 * AuthComponent for making user authentication and deciding access level.
 * 
 * @package   AuthComponent
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-05-28
 */
class AuthComponent {
	
	/**
	 * Check if user is valid by parameter array.
	 * Parameter array has to have username and password values.
	 * 
	 * @access  public
	 * @param   array   $array
	 * @return  boolean $isUserValid
	 */
	public static function isUserValidByArray ( $array ) {
		Debug::debug(get_class(), "isUserValidByArray", "Start");
		$isUserValid = false;
		
		if (is_array( $array )) {
			Debug::debug(get_class(), "isUserValidByArray", "Parameter array is array", 2);
			
			if (isset($array[ 'username' ]) and isset($array[ 'password' ])) {
				Debug::debug(get_class(), "isUserValidByArray", "Array has values username and password", 3);
				$userId = $array[ 'username' ];
				$password = $array[ 'password' ];
				
				// check role
				$role = self::getRoleByIdAndPassword($userId, $password);
				
				if ( is_string( $role) ) {
					Debug::debug(get_class(), "isUserValidByArray", "Role is string", 4);
					$isUserValid = true;
				} // no else
			} // no else
		} // no else
		
		Debug::debug(get_class(), "isUserValidByArray", "Return isUserValid = $isUserValid");
		return $isUserValid;
	}
	
	/**
	 * Check user's id and password from DB. If authentication is succesfull, return user's role.
	 * If authentication is not succesfull, return false.
	 * 
	 * If user's id is 10 characters or shorter, make query to the Pupesoft.kuka table (business customer, admin, instructor).
	 * If user's id is 11 characters or longer, make query to the Pupesoft.user table (private customer, admin).
	 * 
	 * @access public
	 * @param  string  $userId    user's id
	 * @param  string  $password  user's password
	 * @return mixed   $role      if authentication is succesfull, return user's role (string)
	 *                            if authentication is not succesfull, return false
	 */
	public static function getRoleByIdAndPassword( $userId, $password ) {
		Debug::debug(get_class(), "getRoleByIdAndPassword", "Start");
		$role = false;
		
		if ( is_string($userId) and is_string($password) ) {
			Debug::debug(get_class(), "getRoleByIdAndPassword", "Parameters correct", 2);
			
			$dbConnect = new DatabaseConnect();
			
			// check user input
			$userIdChecked = mysql_real_escape_string($userId);
			$passwordChecked = mysql_real_escape_string($password);
			
			if ($userIdChecked !== false and $passwordChecked !== false) {
				Debug::debug(get_class(), "getRoleByIdAndPassword", "Parameters checked", 3);
				
				// if user is private customer (authentication from pupesoft.user table)
				if ( strlen($userId) > 10 ) {
					Debug::debug(get_class(), "getRoleByIdAndPassword", "userId $userIdChecked > 10", 4);
					$role = self::getPrivateUserRole($userIdChecked, $passwordChecked, $dbConnect);
					
				} else {
					Debug::debug(get_class(), "getRoleByIdAndPassword", "userId $userIdChecked <= 10", 4);
					$role = self::getPupesoftUserRole($userIdChecked, $passwordChecked, $dbConnect);
					
				}
			} // no else
		} // no else
		
		Debug::debug(get_class(), "getRoleByIdAndPassword", "Return role = $role");
		return $role;
	}
	
	/**
	 * Makes private user's authentication from table pupesoft.user.
	 * 
	 * @access private
	 * @param  string $userId
	 * @param  string $password
	 * @param  DatabaseConnect $dbConnect
	 * @return mixed  $role    if authentication is succesfull, return role (string)
	 *                         if authentication is not succesfull, return false
	 */
	private static function getPrivateUserRole( $userId, $password, DatabaseConnect $dbConnect ) {
		$role = false;
		
		// TODO: get role from user table
		$query = "	";
		
		return $role;
	}
	
	/**
	 * Get Pupesoft user's role from database.
	 * 
	 * @access private
	 * @param  string $userId
	 * @param  string $password
	 * @param  DatabaseConnect $dbConnect
	 * @return mixed  $role    if authentication is succesfull, return role (string)
	 *                         if authentication is not succesfull, return false
	 */
	private static function getPupesoftUserRole( $userId, $password, DatabaseConnect $dbConnect ) {
		Debug::debug(get_class(), "getPupesoftUserRole", "Start");
		
		$role = false;
		
		if ( is_string($userId) and is_string($password) ) {
			Debug::debug(get_class(), "getPupesoftUserRole", "Parameters correct", 2);
			
			$authenticated = self::authenticatePupesoftUser( $userId, $password, $dbConnect );
			
			if ( $authenticated === true ) {
				Debug::debug(get_class(), "getPupesoftUserRole", "Authenticated = $authenticated", 3);
				$query = "	SELECT 	profiilit 
							FROM 	kuka 
							WHERE	extranet = ''
							AND		kuka = '$userId' 
							LIMIT 	1 ";
				
				Debug::debug(get_class(), "getPupesoftUserRole", "Query = $query", 3);
				
				$result = mysql_query($query);
				
				if ( $result ) {
					Debug::debug(get_class(), "getPupesoftUserRole", "Result = $result", 4);
					
					$row = mysql_fetch_assoc($result);
					$roleFromDb = $row[ 'profiilit' ];
					
					// check that user role is correct
					$role = AuthComponent::checkUserRole($roleFromDb);
				} else {
					Debug::debug(get_class(), "getPupesoftUserRole", "Result is more than 1 row.", 4);
				}
			} // no else
		} // no else
		
		Debug::debug(get_class(), "getPupesoftUserRole", "Return role = $role");
		return $role;
	}
	
	/**
	 * Makes Pupesoft user's authentication from table pupesoft.kuka.
	 * 
	 * @access private
	 * @param  string $userId
	 * @param  string $password
	 * @param  DatabaseConnect $dbConnect
	 * @return boolean $authenticated
	 */
	private static function authenticatePupesoftUser( $userId, $password, DatabaseConnect $dbConnect ) {
		Debug::debug(get_class(), "authenticatePupesoftUser", "Start");
		
		$authenticated = false;

		if ( is_string($userId) and is_string($password) ) {
			Debug::debug(get_class(), "authenticatePupesoftUser", "Parameters correct", 2);
			
			$query = "	SELECT	salasana
						FROM	kuka
						WHERE	extranet = ''
						AND		kuka = '$userId' 
						LIMIT	1 ";
			
			Debug::debug(get_class(), "authenticatePupesoftUser", "Query = $query", 2);
			
			$result = mysql_query($query);
			
			if ( $result ) {
				Debug::debug(get_class(), "authenticatePupesoftUser", "Result = $result", 3);
				
				$row = mysql_fetch_assoc($result);
				$dbPassword = $row[ 'salasana' ];
				
				if ( md5($password) === $dbPassword ) {
					Debug::debug(get_class(), "authenticatePupesoftUser", "", 4);
					
					$authenticated = true;
				} // no else
			} else {
				Debug::debug(get_class(), "authenticatePupesoftUser", "Result is more than 1 row.", 3);
			}
		} // no else
		
		Debug::debug(get_class(), "authenticatePupesoftUser", "Return authenticate = $authenticated");
		return $authenticated;
	}
	
	/**
	 * Check that user role is correct (Admin profil/opiskelija/ohjaaja).
	 * 
	 * If user role is correct, return user role.
	 * If user role is not correct, return false.
	 * 
	 * @access private
	 * @param string $userRole
	 * @return mixed $role
	 */
	private static function checkUserRole( $userRole ) {
		Debug::debug(get_class(), "checkUserRole", "Start");
		$role = false;
		
		if ( !empty($userRole) and is_string( $userRole ) ) {
			Debug::debug(get_class(), "checkUserRole", "userRole is string", 2);
			
			if ( trim($userRole) === 'Admin profil' or trim($userRole) === 'opiskelija' or trim($userRole) === 'ohjaaja' ) {
				Debug::debug(get_class(), "checkUserRole", "userRole is correct", 3);
				$role = $userRole;
			}
		}
		
		Debug::debug(get_class(), "checkUserRole", "Return role = $role");
		return $role;
	}
	
}
?>