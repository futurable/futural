<?php
/**
 *  BankLoanAccount.php
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

require_once 'CommonServices/DataValidator.php';
require_once 'bank/Data/BankLoanAccountDataMapper.php';
require_once 'bank/Model/BankLoanInfo.php';

/**
 * BankLoanAccount.php
 * Class for customer's bank account information
 * 
 * @package   Model
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-02
 */
class BankLoanAccount {
	private $accountOwner;
	private $accountName;
	private $IBAN;
	private $BIC;
	private $interestRate;
	private $currency;
	private $status;
	private $transactions;
	private $language;
	
	/**
	 * Detailed info about bank loan
	 * 
	 * @var BankLoanInfo $bankLoanInfo
	 */
	private $bankLoanInfo;
	public  $dataMapper;
	
	public function __construct( $IBAN ) {
		$this->IBAN = $IBAN;
		
		$this->dataMapper = new BankLoanAccountDataMapper();
	}
	
	/**
	 * Get bank account saldo in specific date.
	 * Calculates saldo from accounts transactions until given date.
	 * 
	 * @access public
	 * @param  string $date        Date in ISO format (yyyy-mm-dd)
	 * @return mixed  $saldo       default = NULL
	 *                             if saldo is possible to count (from db), return float
	 */
	public function getBankLoanAccountSaldoByDate( $date) {
		Debug::debug(get_class(), "getBankLoanAccountSaldoByDate", "Start");
		$saldo = NULL;
		
		if (DataValidator::isDateISOSyntaxValid($date)) {
			Debug::debug(get_class(), "getBankLoanAccountSaldoByDate", "Parameters are valid", 2);
			
			$saldo = $this->dataMapper->getBankLoanAccountSaldoByDate( $this->IBAN, $date );
		}
		return $saldo;
	}
		
	
	
	public function setBankLoanInfo( BankLoanInfo $info ) {
		$this->bankLoanInfo = $info;
	}
	
	public function getBankLoanInfo() {
		if (isset($this->bankLoanInfo)) {
			return $this->bankLoanInfo;
		} else {
			$bankLoanInfoObject = new BankLoanInfo();
			$bankLoanInfoObject->dataMapper->fillBankLoanInfo( $this );
			
			return $this->bankLoanInfo;
			unset($bankLoanInfoObject);
		}
	}
	
	public function setAccountOwner( $owner ) {
		if (is_string($owner)) {
			$this->accountOwner = $owner;
		}
	}
	
	public function getAccountOwner() {
		if (isset($this->accountOwner)) {
			return $this->accountOwner;
		}
	}
	
	public function setAccountName( $name ) {
		if (is_string($name)) {
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
	
	public function setBIC( $BIC ) {
		if (DataValidator::isFinnishBICValid( $BIC )) {
			$this->BIC = $BIC;
		}
	}
	
	public function getBIC() {
		if (isset($this->BIC)) {
			return $this->BIC;
		}
	}
	
	public function setInterestRate( $interestRate) {
		if ( DataValidator::isDecimalValid($interestRate) ) {
			$this->interestRate = $interestRate;
		}
	}
	
	public function getInterestRate() {
		if (isset($this->interestRate)) {
			return $this->interestRate;
		}
	}
	
	public function setCurrency( $currency ) {
		if ( DataValidator::isStringValid( $currency, 3 ) ) {
			$this->currency = $currency;
		}
	}
	
	public function getCurrency() {
		if (isset($this->currency)) {
			return $this->currency;
		}
	}
	
	public function setStatus( $status ) {
		// TODO: tarkistus
		$this->status = $status;
	}
	
	public function getStatus() {
		if (isset($this->status)) {
			return $this->status;
		}
	}
	
	public function setTransactions( $transactions ) {
		if (is_array($transactions)) {
			$this->transactions = $transactions;
		}
	}
	public function setLanguage( $language ) {
		if (is_string($language)) {
			$this->language = $language;
		}
	}
	
	public function getLanguage() {
		if (isset($this->language)) {
			return $this->language;
		}
	}
	
	public function addOneTransactionToTransactions( BankTransaction $transaction ) {
		$this->transactions[] = $transaction;
	}
	
	public function getTransactions() {
		if (isset($this->transactions)) {
			return $this->transactions;
		}
	}
	
	public function toString() {
		print "<p>BankLoanAccount<br/>
				Account owner: $this->accountOwner <br/>
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
		if (isset($this->bankLoanInfo)) {
			$this->bankLoanInfo->toString();
		}
	}
}
?>