<?php
/**
 *  BankAccount.php
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

require_once 'CommonServices/DataValidator.php';
require_once 'bank/Data/BankAccountDataMapper.php';

/**
 * BankAccount.php
 * Class for customer's bank account information
 * 
 * @package   Model
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-06-16
 */
class BankAccount {
	private $author;
	private $accountOwner;
	private $accountOwnerName;
	private $accountName;
	private $IBAN;
	private $BIC;
	private $interestRate;
	private $currency;
	private $status;
	private $transactions;
	public  $dataMapper;
	
	public function __construct( $IBAN ) {
		$this->IBAN = $IBAN;
		
		$this->dataMapper = new BankAccountDataMapper();
	}
	
	/**
	 * Get transactions by specific time range.
	 * 
	 * @access public
	 * @param  string $startDate
	 * @param  string $endDate
	 */
	public function getTransactionsByTimeRange( $startDate, $endDate ) {
		Debug::debug(get_class(), "getTransactionsByTimeRange", "Start");
		
		if (DataValidator::isDateISOSyntaxValid($startDate) and DataValidator::isDateISOSyntaxValid($endDate)) {
			Debug::debug(get_class(), "getTransactionsByTimeRange", "Dates are valid", 2);
			$this->dataMapper->fillBankTransactionsInSpecificTimeRange( $this, $startDate, $endDate);
		}
	}
	
	/**
	 * Get transactions that haven't been collected yet
	 * 
	 * @access public
	 * @param string	$type	Collect type. Options: 'AccountStatement', 'ReferenceMaterial'
	 */
	public function getUncollectedTransactions( $type ){
		Debug::debug(get_class(), "getUncollectedTransactions", "Start");
		
		if ($type == 'AccountStatement' or $type == 'ReferenceMaterial') {
			Debug::debug(get_class(), "getUncollectedTransactions", "Type is valid", 2);
			$this->dataMapper->fillUncollectedBankTransactions( $this, $type );
		}
	}
	
	public function getDuePayments() {
		Debug::debug(get_class(), "getDuePayments", "Start");
		$this->dataMapper->fillBankAccountsDuePayments( $this );
	}
	
	/**
	 * Get bank account saldo in specific date.
	 * Calculates saldo from accounts transactions until given date.
	 * 
	 * @access public
	 * @param  string $date        yyyy-mm-dd
	 * @return mixed  $saldo       default = NULL
	 *                             if saldo is possible to count (from db), return float
	 */
	public function getBankAccountSaldoByDate( $date) {
		Debug::debug(get_class(), "getBankAccountSaldoByDate", "Start");
		$saldo = NULL;
		
		if (DataValidator::isDateISOSyntaxValid($date)) {
			Debug::debug(get_class(), "getBankAccountSaldoByDate", "Parameters are valid", 2);
			
			$saldo = $this->dataMapper->getBankAccountSaldoByDate( $this->IBAN, $date );
		}
		
		return $saldo;
	}
	
	public function setAccountOwner( $owner ){
		if (DataValidator::isStringValid($owner)) {
			$this->accountOwner = $owner;
		}
	}
	
	public function getAccountOwner() {
		if (isset($this->accountOwner)) {
			return $this->accountOwner;
		}
	}
	
	public function setAccountOwnerName( $owner ){
		if (DataValidator::isStringValid($owner)) {
			$this->accountOwnerName = $owner;
		}
	}
	
	public function getAccountOwnerName() {
		if (isset($this->accountOwnerName)) {
			return $this->accountOwnerName;
		}
	}
	
	public function setAccountName( $name ){
		if (DataValidator::isStringValid($name)) {
			$this->accountName = $name;
		}
	}
	
	public function getAccountName() {
		if (isset($this->accountName)) {
			return $this->accountName;
		}
	}
	
	public function setIBAN ( $iban ) {
		if (DataValidator::isIBANValid( $iban )) {
			$this->IBAN = $iban;
		}
	}
	
	public function getIBAN() {
		if (isset($this->IBAN)) {
			return $this->IBAN;
		}
	}
	
	public function setBIC( $BIC ){
		if (DataValidator::isFinnishBICValid($BIC)) {
			$this->BIC = $BIC;
		}
	}
	
	public function getBIC() {
		if (isset($this->BIC)) {
			return $this->BIC;
		}
	}
	
	public function setInterestRate( $rate ) {
		if (DataValidator::isDecimalValid($rate)) {
			$this->interestRate = $rate;
		}
	}
	
	public function getInterestRate() {
		if (isset($this->interestRate)) {
			return $this->interestRate;
		}
	}
	
	public function setCurrency( $currency ) {
		if (DataValidator::isStringValid($currency, 3)) {
			$this->currency = $currency;
		}
	}
	
	public function getCurrency() {
		if (isset($this->currency)) {
			return $this->currency;
		}
	}
	
	public function setStatus( $status ) {
		if (is_string($status)) {
			$this->status = $status;
		}
	}
	
	public function getStatus() {
		if (isset($this->status)) {
			return $this->status;
		}
	}
	
	public function setAuthor( $author ) {
		if (is_string($author)) {
			$this->author = $author;
		}
	}
	public function getAuthor() {
		if (isset($this->author)) {
			return $this->author;
		}
	}
	
	public function setOneBankTransactionToTransactions(BankTransaction $trans) {
		$this->transactions[] = $trans;
	}
	
	public function setTransactions(){
		// TODO: set transactions by force
		return false;
	}
	public function getTransactions() {
		if (isset($this->transactions)) {
			return $this->transactions;
		}
	}

	public function getObjectVariables(){
		return get_object_vars($this);
	}
	
	public function toString() {
		print "<p>BankAccount<br/>
				Account owner: $this->accountOwner <br/>
				Account owner name: $this->accountOwnerName <br/>
				Account Name: $this->accountName <br/>
				IBAN: $this->IBAN <br/>
				BIC: $this->BIC <br/>
				Interest rate: $this->interestRate <br/>
				Currency: $this->currency <br/>
				Status: $this->status <br/>
				Transactions: </p>
				<pre>";
		print_r($this->transactions);
		print "</pre>";
	}
}
?>