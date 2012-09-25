<?php
/**
 *  Customer.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Annika Granlund <annika.granlund@futurable.fi>
 *
 *  License
 *
 *      This file is part of project Futural/AuthComponent.
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
 *
 */

require_once 'User.php';

/**
 * Customer.php
 * Class for customer
 * 
 * @package   Model
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-06-14
 */
abstract class Customer extends User {
	protected $bankAccounts;
	protected $bankLoanAccounts;
	protected $loanApplications;
	
	public function __construct($id) {
		parent::__construct($id);
	}
	
	protected function fillConcreteUserData() {
		
	}
	
	/**
	 * Add one bank account object to bankAccounts array.
	 * 
	 * @access public
	 * @param  BankAccount $account
	 */
	public function addOneBankAccountToBankAccountsArray( BankAccount $account ) {
		$this->bankAccounts[] = $account;
	}
	
	public function getOneBankAccountByIBAN( $IBAN ) {
		Debug::debug(get_class(), "getOneBankAccountByIBAN", "Start");
		
		if (isset($this->bankAccounts)) {
			Debug::debug(get_class(), "getOneBankAccountByIBAN", "BankAccounts is set", 2);
			
			foreach ( $this->bankAccounts as $key => $object ) {
				Debug::debug(get_class(), "getOneBankAccountByIBAN", "Foreach", 3);
				
				if ( strcmp(trim($object->getIBAN()), $IBAN) === 0 ) {
					Debug::debug(get_class(), "getOneBankAccountByIBAN", "Object found", 4);
					
					return $object;
				}
			}
		} 
	}
	
	/**
	 * Add one bank account object to bankAccounts array.
	 * 
	 * @access public
	 * @param  BankAccount $account
	 */
	public function addOneBankLoanAccountToBankAccountsArray( BankLoanAccount $account ) {
		$this->bankLoanAccounts[] = $account;
	}
	
	/**
	 * Get bank account arrays account numbers.
	 * Return numbers in array.
	 * 
	 * @access  public
	 * @return  array   $accountNumbers
	 */
	public function getActiveBankAccountNumbers() {
		$accountNumbers = array();
		if (!empty($this->bankAccounts)) {
			foreach ( $this->bankAccounts as $key => $object ) {
				if ($object->getStatus() === 'enabled') {
					$accountNumbers[] = $object->getIBAN();
				}
			}
		}
		return $accountNumbers;
	}
	
	/**
	 * Get loan account arrays account numbers.
	 * Return numbers in array.
	 * 
	 * @access  public
	 * @return  array   $accountNumbers
	 */
	public function getActiveBankLoanAccountNumbers() {
		$accountNumbers = array();
		if (!empty($this->bankLoanAccounts)) {
			foreach ( $this->bankLoanAccounts as $key => $object ) {
				if ($object->getStatus() === 'enabled') {
					$accountNumbers[] = $object->getIBAN();
				}
			}
		}
		return $accountNumbers;
	}
	
	public function getActiveBankAccounts() {
		if (isset($this->bankAccounts)) {
			return $this->bankAccounts;
		}
	}
	
	public function getActiveBankLoanAccounts() {
		if (isset($this->bankLoanAccounts)) {
			return $this->bankLoanAccounts;
		}
	}
	
	/**
	 * Add one loan application object to loanApplications array.
	 * 
	 * @access public
	 * @param  LoanApplication $loanApplication
	 */
	public function addOneBankLoanApplicationToLoanApplicationsArray( BankLoanInfo $loanApplication ) {
		$this->loanApplications[] = $loanApplication;
	}
	
	public function getLoanApplications() {
		if (isset($this->loanApplications)) {
			return $this->loanApplications;
		}
	}
	
	//protected abstract function doCreateUserById( $id );
}
?>