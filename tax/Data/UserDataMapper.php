<?php
/**
 *  UserDataMapper.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Annika Granlund <annika.granlund@futurable.fi>
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

require_once 'DataMapper.php';

/**
 * UserDataMapper.php
 * Class for BankAccount object database queries.
 * 
 * @package   Data
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-17
 */
class UserDataMapper extends DataMapper {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Save User to database.
	 * @see DataMapper::doSave()
	 * 
	 * @access  protected
	 * @param   User       $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doSave( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof User ) {
			Debug::debug(get_class(), "doSave", "Parameter object is instance of User", 2);
			print "doSave user";
		}
		
		Debug::debug(get_class(), "doSave", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Update User in database.
	 * @see DataMapper::doUpdate()
	 * 
	 * @access  protected
	 * @param   User       $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doUpdate( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof User ) {
			Debug::debug(get_class(), "doUpdate", "Parameter object is instance of User", 2);
			print "doUpdate user";
		}

		Debug::debug(get_class(), "doUpdate", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Delete User from database.
	 * @see DataMapper::doDelete()
	 * 
	 * @access  protected
	 * @param   User       $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doDelete( $object ) {
		Debug::debug(get_class(), "doDelete", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof User ) {
			Debug::debug(get_class(), "doDelete", "Parameter object is instance of User", 2);
			// poista olio, jos poisto onnistuu successful = true
			print "doDelete user";
		}
		
		Debug::debug(get_class(), "doDelete", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Get user role from DB.
	 * Check first if user is pupesoft user or private user.
	 * 
	 * @access  public
	 * @param   string $userId
	 * @return  string $role
	 */
	public function getUserRoleById ( $userId ) {
		Debug::debug(get_class(), "getUserRoleById", "Start");
		$role = false;
		
		// if user is private customer (authentication from pupesoft.user table)
		if ( strlen($userId) > 10 ) {
			Debug::debug(get_class(), "getUserRoleById", "userId $userId > 10", 2);
			$role = $this->getPrivateUserRoleById($userId);
			
		} else {
			Debug::debug(get_class(), "getUserRoleById", "userId $userId <= 10", 2);
			$role = $this->getPupesoftUserRoleById($userId);
			
		}
		
		Debug::debug(get_class(), "getUserRoleById", "Return role = $role");
		return $role;
	}
	
	/**
	 * Get private user's role from user table.
	 * 
	 * @access  private
	 * @param   string $userId
	 * @return  string $role
	 */
	private function getPrivateUserRoleById ( $userId ) {
		// TODO: hae User-kannasta tiedot
	}
	
	/**
	 * Get pupesoft user's role from user table.
	 * 
	 * @access  private
	 * @param   string $userId
	 * @return  string $role
	 */
	private function getPupesoftUserRoleById ( $userId ) {
		Debug::debug(get_class(), "getPupesoftUserRoleById", "Start");
		$role = false;
		
		$query = "	SELECT 	profiilit 
					FROM 	kuka 
					WHERE 	extranet = ''
					AND		kuka = '$userId' 
					LIMIT 	1 ";
		
		$result = mysql_query($query);
		
		if ($result) {
			Debug::debug(get_class(), "getPupesoftUserRoleById", "Query ($query) has result", 2);
			
			$row = mysql_fetch_assoc($result);
			$roleFromDb = $row[ 'profiilit' ];
			
			// check that user role is correct
			$roleValid = $this->checkIfUserRoleIsValid($roleFromDb);
			
			if ($roleValid === true) {
				Debug::debug(get_class(), "getPupesoftUserRoleById", "Role ($roleFromDb) is valid", 3);
				$role = trim($roleFromDb);
			}
		}
		Debug::debug(get_class(), "getPupesoftUserRoleById", "Return role $role");
		return $role;
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
	private function checkIfUserRoleIsValid( $userRole ) {
		Debug::debug(get_class(), "checkIfUserRoleIsValid", "Start");
		$roleValid = false;
		
		if ( !empty($userRole) and is_string( $userRole ) ) {
			Debug::debug(get_class(), "checkIfUserRoleIsValid", "userRole is string", 2);
			
			if ( trim($userRole) === 'Admin profil' or trim($userRole) === 'opiskelija' or trim($userRole) === 'ohjaaja' ) {
				Debug::debug(get_class(), "checkIfUserRoleIsValid", "userRole is correct", 3);
				$roleValid = true;
			}
		}
		
		Debug::debug(get_class(), "checkIfUserRoleIsValid", "Return roleValid = $roleValid");
		return $roleValid;
	}
	
	/**
	 * Get abstract user's data (language, name and profil) from DB.
	 * Check first if user is pupesoft user or private user.
	 * 
	 * @access  public
	 * @param   User    $user
	 */
	public function fillAbstractUserData( User $user ) {
		Debug::debug(get_class(), "fillAbstractUserData", "Start");
		$userId = $user->getId();
		
		// if user is private customer (get data from pupesoft.user table)
		if ( strlen($userId) > 10 ) {
			Debug::debug(get_class(), "fillAbstractUserData", "userId $userId > 10", 2);
			// TODO: hae tiedot user taulusta
			
		} else {
			Debug::debug(get_class(), "fillAbstractUserData", "userId $userId <= 10", 2);
			$query = " SELECT	kieli
								, nimi
								, profiilit
						FROM	kuka
						WHERE	extranet = ''
						AND 	kuka = '$userId' ";
	
			$result = mysql_query($query);
			
			if ($result) {
				Debug::debug(get_class(), "fillAbstractUserData", "Query ($query) has result", 3);
				$row = mysql_fetch_assoc($result);
				
				$user->setName( $row[ 'nimi' ]);
				$user->setLanguage( $row['kieli'] );
				$user->setRole( $row['profiilit'] );
			}
		}
	}
	
	/**
	 * Get concrete business customer user data and add data to BusinessCustomer.
	 * 
	 * @access  public
	 * @param   Customer    $user
	 */
	public function fillConcreteBusinessCustomerUserData( Customer $user ) {
		Debug::debug(get_class(), "fillConcreteBusinessCustomerUserData", "Start");
		$userId = $user->getId();
		
		$companyQuery = "	SELECT	yhtio.ytunnus 
									, yhtio.nimi 
							FROM	yhtio 
							JOIN	kuka 
							ON 		yhtio.yhtio = kuka.yhtio 
							WHERE	kuka.extranet = ''
							and		kuka.kuka = '$userId' ";
		
		$companyResult = mysql_query($companyQuery);
		
		if ($companyResult) {
			Debug::debug(get_class(), "fillConcreteBusinessCustomerUserData", "CompanyQuery ($companyQuery) has result", 2);
			$numRows = mysql_num_rows($companyResult);
			
			if ($numRows > 0) {
				Debug::debug(get_class(), "fillConcreteBusinessCustomerUserData", "Num rows > 0", 3);
				
				while($row = mysql_fetch_assoc($companyResult)) {
					Debug::debug(get_class(), "fillConcreteBusinessCustomerUserData", "While", 4);
					$businessID = $row[ 'ytunnus' ];
					$companyName = $row[ 'nimi' ];
					
					$user->setOneCompanyToCompaniesArray( $businessID, $companyName );
				}
			}
			
		}
	}
	
	/**
	 * Get concrete private customer user data (company, bank accounts, loan accounts) and add data to PrivateCustomer.
	 * 
	 * @access  public
	 * @param   Customer    $user
	 */
	public function fillConcretePrivateCustomerUserData( Customer $user ) {
		Debug::debug(get_class(), "fillConcretePrivateCustomerUserData", "Start");
		// TODO: hae private käyttäjän yhtio user-taulusta
		
		$this->getCustomerBankAccounts( $user );
	}
}

?>