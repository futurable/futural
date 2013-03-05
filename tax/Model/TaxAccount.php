<?php
/**
 *  TaxAccount.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Jarmo Kortetjärvi <jarmo.kortetjarvi@futurable.fi>
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
require_once 'tax/Data/TaxAccountDataMapper.php';

/**
 * Company
 * Class for Company
 * 
 * @package   Model
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-14
 */
class TaxAccount {
	
	private $referenceNumber;
	private $saldo;
	private $transactions;
	private $declarationPeriods;
	
	public $dataMapper;
	
	public function __construct( $referenceNumber ) {
		Debug::debug(get_class(), "__construct", "Start");
		
		$this->dataMapper = new TaxAccountDataMapper();
		$this->setReferenceNumber( $referenceNumber );
		$this->setSaldo( $this->dataMapper->getTaxAccountSaldo( $this->referenceNumber) );
	}
	
	public function setOneTransactionToTransactions( Transaction $transaction ) {
		Debug::debug(get_class(), "setOneTransactionToTransactions", "Start");
		$this->transactions[] = $transaction;
	}
	
	public function setReferenceNumber( $referenceNumber ){
		if(is_string($referenceNumber)){
			$this->referenceNumber= $referenceNumber;
		}
	}
	
	public function getReferenceNumber(){
		if(isset($this->referenceNumber)){
			return $this->referenceNumber;
		}
	}

	public function setSaldo( $saldo ){
		if(DataValidator::isNumericValid($saldo)){
			$this->saldo = $saldo;
		}
	}
	
	public function getSaldo(){
		if(isset($this->saldo)){
			return $this->saldo;
		}
	}
	
	public function getSaldoByDate( $date ){
		if( DataValidator::isDateISOSyntaxValid($date)){
			return $this->dataMapper->getTaxAccountSaldo( $this->referenceNumber, $date );
		}
	}
	
	public function setTransactions( $transactions ){
		if( is_array($transaction) ){
			$this->transactions = $transactions;
		}
	}
	
	/**
	 * Get all tax account transactions ( tax + bank )
	 */
	public function getTransactions(){
		Debug::debug(get_class(), "getTransactions", "Start");
		$this->dataMapper->getTransactions($this);
		
		return $this->transactions;
	}
	
	/**
	 * Get tax transactions only ( exclude bank ) 
	 */
	public function getTaxTransactions() {
		Debug::debug(get_class(), "getTaxTransactions", "Start");
		$this->dataMapper->getTaxTransactions($this);
		
		return $this->transactions;
	}
	
	/**
	 * 
	 * Function to get tax transactions by time range
	 * @access public
	 * @param string $startDate		ISO-formatted date
	 * @param string $endDate		ISO-formatted date
	 */
	public function getTransactionsByTimeRange( $startDate, $endDate ) {
		if( DataValidator::isDateISOSyntaxValid($startDate) and DataValidator::isDateISOSyntaxValid($endDate) ){
			$this->dataMapper->getTransactionsByTimeRange( $this, $startDate, $endDate );
		}
		
		return $this->transactions;
	}
	
	/**
	 * Get chosen transaction.
	 * 
	 * @access public
	 * @param  string $targetPeriod
	 * @param  string $type				The type of the event ( VAT, EC )
	 * @return Transaction object
	 */
	public function getChosenTransaction( $targetPeriod, $type ){
		
		if(DataValidator::isDateISOSyntaxValid($targetPeriod)){
			$this->dataMapper->getTaxTransactionsSumByPeriod($this, $targetPeriod, $type);
		}
		
		return $this->transactions[0];
	}
	
	public function toString() {
		print "<p>TaxAccount <br/>
				ReferenceNumber: $this->referenceNumber <br/>
				Saldo: $this->saldo </p>
				<pre>";
		print_r($this->transactions);
		print "</pre>";
	}
}
?>