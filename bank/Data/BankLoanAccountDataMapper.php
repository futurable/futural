<?php

/**
 *  BankLoanAccountDataMapper.php
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
 * BankLoanAccountDataMapper.php
 * Abstract class for database queries.
 * 
 * @package   Data
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-05-22
 */
class BankLoanAccountDataMapper extends DataMapper {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Save BankLoanAccount object to db.
	 * @see DataMapper::doSave()
	 * 
	 * @access  protected
	 * @param   BankLoanAccount  $object
	 * @return  boolean          $successful    if query is successful, return true
	 *                                          if query is not successful, return false
	 */
	protected function doSave( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$succesfull = false;
		
		if ( $object instanceof BankLoanAccount ) {
			Debug::debug(get_class(), "doSave", "Parameter object is instance of BankLoanAccount", 2);
		}
		
		Debug::debug(get_class(), "doSave", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Update BankLoanAccount object to db.
	 * @see DataMapper::doUpdate()
	 * 
	 * @access  protected
	 * @param   BankLoanAccount  $object
	 * @return  boolean          $successful    if query is successful, return true
	 *                                          if query is not successful, return false
	 */
	protected function doUpdate( $object ) {
		Debug::debug(get_class(), "doUpdate", "Start");
		$succesfull = false;
		
		if ( $object instanceof BankLoanAccount ) {
			Debug::debug(get_class(), "doSave", "Parameter object is instance of BankLoanAccount", 2);
		}
		
		Debug::debug(get_class(), "doUpdate", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Delete object from db.
	 * @see DataMapper::doDelete()
	 * 
	 * @access  protected
	 * @param   BankLoanAccount  $object
	 * @return  boolean          $successful    if query is successful, return true
	 *                                          if query is not successful, return false
	 */
	protected function doDelete( $object ) {
		Debug::debug(get_class(), "doDelete", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof BankLoanAccount ) {
			// poista olio, jos poisto onnistuu successful = true
			
		}
		
		Debug::debug(get_class(), "doDelete", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Fill BankLoanAccount object data from db.
	 * 
	 * @access public
	 * @param  BankLoanAccount $object
	 */
	public function fillBankLoanAccount( BankLoanAccount $object ) {
		Debug::debug(get_class(), "fillBankLoanAccount", "Start");
		
		$IBAN = @mysql_real_escape_string($object->getIBAN());
		
		$query = "	SELECT	accountOwner
							, BIC
							, interestRate
							, currency
							, accountName
							, status
					FROM	BankLoanAccount
					WHERE	IBAN = '$IBAN' ";
		
		$result = @mysql_query($query);
		
		if ($result) {
			Debug::debug(get_class(), "fillBankLoanAccount", "Query ($query) has result", 2);
			$row = mysql_fetch_assoc($result);
			
			$accountOwner = $row[ 'accountOwner' ];
			$BIC = $row[ 'BIC' ];
			$interestRate = $row[ 'interestRate' ];
			$currency = $row[ 'currency' ];
			$accountName = $row[ 'accountName' ];
			$status = $row[ 'status' ];
			
			$object->setAccountOwner( $accountOwner );
			$object->setBIC( $BIC );
			$object->setInterestRate( $interestRate );
			$object->setCurrency( $currency );
			$object->setAccountName( $accountName );
			$object->setStatus( $status );
		}
	}
	
	/**
	 * Fill transactions to BankLoanAccount object.
	 * 
	 * @access public
	 * @param  BankLoanAccount $object
	 */
	public function fillTransactions( BankLoanAccount $object ) {
		Debug::debug(get_class(), "fillTransactions", "Start");
		
		$IBAN = @mysql_real_escape_string($object->getIBAN());
		
		if (DataValidator::isIBANValid( $IBAN )) {
			Debug::debug(get_class(), "fillTransactions", "IBAN id valid", 2);
			
			$query = "	SELECT	BankTransaction.archiveID AS archiveID
								, BankTransaction.recipientBankAccount AS recipientBankAccount
								, BankTransaction.recipientName AS recipientName 
								, BankTransaction.payerBankAccount AS payerBankAccount
								, BankTransaction.sum AS sum
								, BankTransaction.eventDate AS eventDate
								, BankTransaction.referenceNumber AS referenceNumber
								, BankTransaction.message AS message
								, BankTransaction.currency AS currency
								, BankTransaction.author AS author
								, BankAccount.accountOwnerName AS payerName
						FROM	BankTransaction
						JOIN	BankAccount
						ON		BankTransaction.payerBankAccount = BankAccount.IBAN
						WHERE	BankTransaction.recipientBankAccount = '$IBAN' 
						ORDER BY BankTransaction.eventDate DESC";
			
			$result = @mysql_query($query);

			if ($result) {
				Debug::debug(get_class(), "fillTransactions", "Query ($query) has result", 3);
				
				while ($row = mysql_fetch_assoc($result)){
					Debug::debug(get_class(), "fillTransactions", "While", 4);
					$bankTransaction = new BankTransaction();
					$bankTransaction->fillObjectFromArray($bankTransaction, $row);
					
					$object->addOneTransactionToTransactions($bankTransaction);
					unset($bankTransaction);
				}
			}
		}
	} // end of fillTransactions()
	
	/**
	 * Get specific bank accounts saldo in specific date.
	 * 
	 * @access public
	 * @param  string $bankAccount   IBAN number
	 * @param  string $date          Date in ISO format (yyyy-mm-dd)
	 * @return mixed  $saldo         default = null, if there are transactions, count saldo and return float or integer
	 */
	public function getBankLoanAccountSaldoByDate( $bankAccount, $date) {
		Debug::debug(get_class(), "getBankAccountSaldoByDate", "Start");
		$saldo = NULL;
		
		if (DataValidator::isIBANValid($bankAccount) and DataValidator::isDateISOSyntaxValid($date)) {
			Debug::debug(get_class(), "getBankLoanAccountSaldoByDate", "Parameters are valid", 2);
			
			$query = "	SELECT		sum(IF(payerBankAccount = '$bankAccount', sum * -1, sum)) AS sum
						FROM		BankTransaction 
						WHERE		( payerBankAccount = '$bankAccount'
									OR
									recipientBankAccount = '$bankAccount' )
						AND			eventDate <= '$date' ";
			
			$result = mysql_query($query);
			
			if ($result) {
				$row = mysql_fetch_assoc($result);
				$sum = $row[ 'sum' ];
				if ( $sum === NULL ) {
					$sum = '0.00';
				}
				$saldo = $sum;
			}
		}
		
		Debug::debug(get_class(), "getBankLoanAccountSaldoByDate", "Return saldo $saldo");
		return $saldo;
	}
}
?>