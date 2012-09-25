<?php
require_once 'DataMapper.php';
require_once 'Model/BankAccount.php';
require_once 'Model/BankLoanAccount.php';

/**
 *  UserDataMapper.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Annika Granlund <annika.granlund@futurable.fi>
 *      			  2012 Jarmo Kortetjärvi <jarmo.kortetjarvi@futurable.fi>
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
 * UserDataMapper.php
 * Class for BankAccount object database queries.
 * 
 * @package   Data
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-06-21
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
						AND		kuka = '$userId' ";
	
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
	 * Get concrete business customer user data (company, bank accounts, loan accounts) and add data to BusinessCustomer.
	 * 
	 * @access  public
	 * @param   Customer    $user
	 */
	public function fillConcreteBusinessCustomerUserData( Customer $user ) {
		Debug::debug(get_class(), "fillConcreteBusinessCustomerUserData", "Start");
		$userId = $user->getId();
		
		$companyQuery = "	SELECT	kuka.yhtio
									, yhtio.nimi
									, yhtio.ytunnus
							FROM	kuka
							JOIN 	yhtio
							ON 		(kuka.yhtio = yhtio.yhtio)
							WHERE	extranet = ''
							AND 	kuka = '$userId'
							LIMIT 1";
		
		$companyResult = mysql_query($companyQuery);
		
		if ($companyResult) {
			Debug::debug(get_class(), "fillConcreteBusinessCustomerUserData", "CompanyQuery ($companyQuery) has result", 2);
			$row = mysql_fetch_assoc($companyResult);
			
			$user->setCompany($row[ 'yhtio' ]);
			$user->setCompanyName($row[ 'nimi' ]);
			$user->setCompanyBusinessID($row[ 'ytunnus' ]);
		}
		
		$this->getCustomerBankAccounts( $user );
		$this->getCustomerLoanAccounts( $user );
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
	
	/**
	 * Get customer's bank accounts information.
	 * Add bank account object to customer's bankAccounts array.
	 * 
	 * @access private
	 * @param  Customer $user
	 */
	private function getCustomerBankAccounts( Customer $user ) {
		Debug::debug(get_class(), "getCustomerBankAccounts", "Start");
		$company = $user->getCompany();
		
		// get bankAccount info, create BankAccount object and add it user's bankAccounts array
		$bankAccountQuery = "	SELECT		*
								FROM		BankAccount
								WHERE		accountOwner = '$company' ";
		
		$bankAccountResult = mysql_query($bankAccountQuery);
		
		if ($bankAccountResult) {
			Debug::debug(get_class(), "getCustomerBankAccounts", "BankAccountQuery ($bankAccountQuery) has result", 2);
			
			while ($row = mysql_fetch_assoc($bankAccountResult)) {
				Debug::debug(get_class(), "getCustomerBankAccounts", "While", 3);
				
				$accountOwner = $row[ 'accountOwner' ];
				$accountOwnerName = $row[ 'accountOwnerName' ];
				$IBAN = $row[ 'IBAN' ];
				$BIC = $row[ 'BIC' ];
				$interestRate = $row[ 'interestRate' ];
				$currency = $row[ 'currency' ];
				$accountName = $row[ 'accountName' ];
				$status = $row[ 'status' ];
				
				$account = new BankAccount( $IBAN );
				$account->setAccountOwner($accountOwner);
				$account->setAccountOwnerName($accountOwnerName);
				$account->setBIC($BIC);
				$account->setInterestRate($interestRate);
				$account->setCurrency($currency);
				$account->setAccountName($accountName);
				$account->setStatus($status);
				
				$user->addOneBankAccountToBankAccountsArray( $account );
				unset($account);
			}
		}
	}
	
	/**
	 * Get customer's loan accounts information.
	 * Add loan account object to customer's loanAccounts array.
	 * 
	 * @access private
	 * @param  Customer $user
	 */
	private function getCustomerLoanAccounts( Customer $user ) {
		Debug::debug(get_class(), "getCustomerLoanAccounts", "Start");
		$company = $user->getCompany();
		
		$loanAccountsQuery = "	SELECT	*
								FROM 	BankLoanAccount
								WHERE	accountOwner = '$company' ";
		
		$loanAccountResult = mysql_query($loanAccountsQuery);
		
		if ($loanAccountResult) {
			Debug::debug(get_class(), "getCustomerLoanAccounts", "LoanAccountsQuery ($loanAccountsQuery) has result", 2);
			
			while ($row = mysql_fetch_assoc($loanAccountResult)) {
				Debug::debug(get_class(), "getCustomerLoanAccounts", "While", 3);
				
				$IBAN = $row[ 'IBAN' ];
				$accountOwner = $row[ 'accountOwner' ];
				$accountName = $row[ 'accountName' ];
				$BIC = $row[ 'BIC' ];
				$interestRate = $row[ 'interestRate' ];
				$currency = $row[ 'currency' ];
				$status = $row[ 'status' ];
				
				$account = new BankLoanAccount( $IBAN );
				$account->setAccountOwner( $accountOwner );
				$account->setAccountName( $accountName );
				$account->setBIC( $BIC );
				$account->setInterestRate( $interestRate );
				$account->setCurrency( $currency );
				$account->setStatus( $status );
				
				$user->addOneBankLoanAccountToBankAccountsArray( $account );
			}
		}
	}
	
	/**
	 * Get customer's loan application information.
	 * Add loan application object to customer's loanApplications array.
	 * 
	 * @access private
	 * @param  Customer $user
	 */
	public function getCustomerLoanApplications( Customer $user ) {
		Debug::debug(get_class(), "getCustomerLoanApplications", "Start");
		$company = $user->getCompany();
		
		$loanApplicationQuery = "
			SELECT 	loanID
					, loanAmount
					, loanType
					, repayment
					, instalment
					, DATE_FORMAT(endDate, GET_FORMAT(DATE, 'EUR')) AS endDate
					, interestType
					, repaymentInterval
					, loanTerm
					, author
					, status
			FROM 	BankLoanInfo 
			WHERE 	loanApplicant = '$company'
			AND 	( status = 'open'
					OR status = 'granted' 
					OR status = 'denied')
			";
		$loanApplicationResult = mysql_query($loanApplicationQuery);
		
		if ($loanApplicationResult) {
			Debug::debug(get_class(), "getCustomerLoanApplications", "LoanApplicationQuery ($loanApplicationQuery) has result", 2);
			
			while ($row = mysql_fetch_assoc($loanApplicationResult)) {
				Debug::debug(get_class(), "getCustomerLoanApplications", "While", 3);
				
				$loanApplication = new BankLoanInfo();
				$loanApplication->fillObjectFromArray ( $loanApplication, $row );
				
				$user->addOneBankLoanApplicationToLoanApplicationsArray( $loanApplication );
				unset($loanApplication);
			}
		}
	}
	
	/**
	 * Check accounts type and return account object (or null).
	 * 
	 * @access public
	 * @param  string $account
	 * @return mixed  $type      Default null
	 *                           If account is BankAccount or BankLoanAccount, return object.
	 */
	public function checkAccountType( $account ) {
		Debug::debug(get_class(), "checkAccountType", "Start");
		$type = null;
		
		$account = mysql_real_escape_string($account);
		
		if (DataValidator::isIBANValid($account)) {
			$query = "	SELECT		IBAN 
						FROM		BankAccount 
						WHERE		IBAN = '$account' ";
			
			$result = mysql_query($query);
			
			if ($result and mysql_num_rows($result) > 0) {
				// is bankAccount
				$type = new BankAccount($account);
			} else {
				$query2 = "	SELECT	IBAN
							FROM	BankLoanAccount 
							WHERE	IBAN = '$account' ";
				
				$result2 = mysql_query($query2);
				
				if ($result2 and mysql_num_rows($result2) > 0) {
					// is loanAccount
					$type = new BankLoanAccount($account);
				}
			}
		}
		
		$t = get_class($type);
		Debug::debug(get_class(), "checkAccountType", "Return type $t");
		return $type;
	}
}

?>