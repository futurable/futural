<?php
require_once 'DataMapper.php';

/**
 *  BankAccountDataMapper.php
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
 * BankAccountDataMapper.php
 * Class for BankAccount object database queries.
 * 
 * @package   Data
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-05-22
 */
class BankAccountDataMapper extends DataMapper {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Save BankAccount object to db.
	 * @see DataMapper::doSave()
	 * 
	 * @access  protected
	 * @param   BanAccount  $object
	 * @return  boolean     $successful    if query is successful, return true
	 *                                     if query is not successful, return false
	 */
	protected function doSave( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$succesfull = false;
		
		if ( $object instanceof BankAccount ) {
			Debug::debug(get_class(), "doSave", "Parameter object is instance of BankLoanAccount", 2);
			
			$author = @mysql_real_escape_string( $object->getAuthor() );
			$accountOwner = @mysql_real_escape_string( $object->getAccountOwner() );
			$accountOwnerName = @mysql_real_escape_string( $object->getAccountOwnerName() );
			$accountName = @mysql_real_escape_string( $object->getAccountName() );
			$IBAN = @mysql_real_escape_string( $object->getIBAN() );
			$BIC = @mysql_real_escape_string( $object->getBIC() );
			$interestRate = @mysql_real_escape_string( $object->getInterestRate() );
			$currency = @mysql_real_escape_string( $object->getCurrency() );
			$status = @mysql_real_escape_string( $object->getStatus() );
			
			$query = "	INSERT INTO BankAccount
						SET				
							accountOwner = '$accountOwner' 
							, accountOwnerName = '$accountOwnerName' 
							, accountName = '$accountName' 
							, IBAN = '$IBAN' 
							, BIC = '$BIC' 
							, interestRate = '$interestRate' 
							, currency = '$currency' 
							, status = '$status' 
							, author = '$author' 
							, createDate = NOW() ";
			
			$successful = @mysql_query( $query );
		}
		
		Debug::debug(get_class(), "doSave", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Update BankAccount object to db.
	 * @see DataMapper::doUpdate()
	 * 
	 * @access  protected
	 * @param   BankAccount  $object
	 * @return  boolean      $successful    if query is successful, return true
	 *                                      if query is not successful, return false
	 */
	protected function doUpdate( $object ) {
		Debug::debug(get_class(), "doUpdate", "Start");
		$succesfull = false;
		
		if ( $object instanceof BankAccount ) {
			Debug::debug(get_class(), "doSave", "Parameter object is instance of BankLoanAccount", 2);
		}
		
		Debug::debug(get_class(), "doUpdate", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Delete BankAccount object from db.
	 * @see DataMapper::doDelete()
	 * 
	 * @access  protected
	 * @param   BankAccount  $object
	 * @return  boolean      $successful    if query is successful, return true
	 *                                      if query is not successful, return false
	 */
	protected function doDelete( $object ) {
		Debug::debug(get_class(), "doDelete", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof BankAccount ) {
			// poista olio, jos poisto onnistuu successful = true
			
		}
		
		Debug::debug(get_class(), "doDelete", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Get specific bank accounts saldo in specific date.
	 * 
	 * @access public
	 * @param  string $bankAccount   IBAN number
	 * @param  string $date          yyyy-mm-dd
	 * @return mixed  $saldo         default = null, if there is transactions, count saldo and return float or integer
	 */
	public function getBankAccountSaldoByDate( $bankAccount, $date) {
		Debug::debug(get_class(), "getBankAccountSaldoByDate", "Start");
		$saldo = NULL;
		
		if (DataValidator::isIBANValid($bankAccount) and DataValidator::isDateISOSyntaxValid($date)) {
			Debug::debug(get_class(), "getBankAccountSaldoByDate", "Parameters are valid", 2);
			
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
		
		Debug::debug(get_class(), "getBankAccountSaldoByDate", "Return saldo $saldo");
		return $saldo;
	}
	
	/**
	 * Get bank transactions in specific bank account in specific time range.
	 * Fill transactions to BankAccount object.
	 * 
	 * @access public
	 * @param  BankAccount $bankAccountObject
	 * @param  string      $startDate           yyyy-mm-dd
	 * @param  string      $endDate             yyyy-mm-dd
	 */
	public function fillBankTransactionsInSpecificTimeRange( BankAccount $bankAccountObject, $startDate, $endDate ) {
		Debug::debug(get_class(), "fillBankTransactionsInSpecificTimeRange", "Start");
		$transactions = array();
		
		$bankAccount = $bankAccountObject->getIBAN();
		
		if ( DataValidator::isIBANValid($bankAccount)
			and DataValidator::isDateISOSyntaxValid( $startDate )
			and DataValidator::isDateISOSyntaxValid( $endDate )) {
			Debug::debug(get_class(), "fillBankTransactionsInSpecificTimeRange", "Dates and IBAN are valid", 2);
			
			$query = "	SELECT		BankTransaction.recipientBankAccount AS recipientBankAccount
									, BankTransaction.recipientName	AS recipientName
									, BankTransaction.payerBankAccount AS payerBankAccount
									, IF(BankTransaction.payerBankAccount = '$bankAccount', sum * -1, sum) AS sum
									, BankTransaction.eventDate AS eventDate
									, BankTransaction.referenceNumber AS referenceNumber
									, BankTransaction.message AS message
									, BankTransaction.currency AS currency
									, BankTransaction.payerName AS payerName
						FROM		BankTransaction
						WHERE		(BankTransaction.recipientBankAccount = '$bankAccount' 
									OR BankTransaction.payerBankAccount = '$bankAccount' ) 
						AND			(eventDate >= '$startDate' AND eventDate <= '$endDate') 
						AND			eventDate <= now() 
						ORDER BY	eventDate ASC, BankTransaction.createDate ASC";
			
			$result = @mysql_query($query);
			
			if ($result) {
				Debug::debug(get_class(), "fillBankTransactionsInSpecificTimeRange", "Query ($query) has a result", 3);
				
				while ($row = @mysql_fetch_assoc($result)){
					Debug::debug(get_class(), "fillBankTransactionsInSpecificTimeRange", "While loop", 4);
					
					$bankTransaction = new BankTransaction();
					$bankTransaction->fillObjectFromArray($bankTransaction, $row);
					$bankAccountObject->setOneBankTransactionToTransactions($bankTransaction);
					unset($bankTransaction);
				}
			}
		}
	}
	
	/**
	 * Get bank transactions in specific bank account that haven't been collected
	 * Fill transactions to BankAccount object.
	 * 
	 * @access 	public
	 * @param  	BankAccount 	$bankAccountObject
	 * @param 	string			$type					Collect type. Options: 
	 * 														'AccountStatement'
	 * 														, 'ReferenceMaterial'
	 */
	public function fillUncollectedBankTransactions($bankAccountObject, $type){
		Debug::debug(get_class(), "fillUncollectedBankTransactions", "Start");
		
		$bankAccount = $bankAccountObject->getIBAN();
		$TypesArray = array('AccountStatement', 'ReferenceMaterial');
						
		if ( DataValidator::isIBANValid($bankAccount) and in_array($type, $TypesArray) ) {
			Debug::debug(get_class(), "fillUncollectedBankTransactions", "IBAN is valid", 2);
			Debug::debug(get_class(), "fillUncollectedBankTransactions", "type is valid", 2);
			
			if($type == 'ReferenceMaterial'){
				$andReferencenumberIsNotNull = "AND BankTransaction.referenceNumber IS NOT NULL";
			}
			else $andReferencenumberIsNotNull = null;
		
			//$query = "LOCK TABLES BankTransaction WRITE "; // Lock tables to prevent data corruption
			$query = 	"SELECT		BankTransaction.archiveID, BankTransaction.recipientBankAccount AS recipientBankAccount
									, BankTransaction.recipientName	AS recipientName
									, BankTransaction.payerBankAccount AS payerBankAccount
									, IF(BankTransaction.payerBankAccount = '{$bankAccount}', sum * -1, sum) AS sum
									, BankTransaction.eventDate AS eventDate
									, BankTransaction.referenceNumber AS referenceNumber
									, BankTransaction.message AS message
									, BankTransaction.currency AS currency
									, DATE_FORMAT(BankTransaction.createDate, GET_FORMAT(DATE,'EUR')) AS createDate
									, BankTransaction.payerName AS payerName
						FROM		BankTransaction
						LEFT OUTER JOIN BankTransactionCollect 
						ON 			BankTransaction.archiveID = BankTransactionCollect.archiveID
						WHERE		eventDate <= now() 
						AND			(
										(BankTransactionCollect.{$type}Payer IS NULL AND BankTransaction.payerBankAccount = '{$bankAccount}')
										OR
										(BankTransactionCollect.{$type}Recipient IS NULL AND BankTransaction.recipientBankAccount = '{$bankAccount}')
									)
						$andReferencenumberIsNotNull
						ORDER BY	eventDate ASC, BankTransaction.createDate ASC";
			
			$result = @mysql_query($query);
		}
		
			if ($result) {
				Debug::debug(get_class(), "fillUncollectedBankTransactions", "Query ($query) has a result", 3);
				
				while ($row = @mysql_fetch_assoc($result)){
					Debug::debug(get_class(), "fillBankTransactionsInSpecificTimeRange", "While loop", 4);
					
					$bankTransaction = new BankTransaction();
					$bankTransaction->fillObjectFromArray($bankTransaction, $row);
					$bankAccountObject->setOneBankTransactionToTransactions($bankTransaction);
					unset($bankTransaction);
				}
			}
	}
	
	/**
	 * Get due payments from db.
	 * Fill due payments to BankAccount object.
	 * 
	 * @access public
	 * @param  BankAccount $bankAccountObject
	 */
	public function fillBankAccountsDuePayments( BankAccount $bankAccountObject ) {
		Debug::debug(get_class(), "selectBankAccountsDuePayments", "Start");
		$bankAccount = $bankAccountObject->getIBAN();
		
		if (DataValidator::isIBANValid($bankAccount)) {
			Debug::debug(get_class(), "fillBankAccountsDuePayments", "IBAN is valid", 2);
			
			$query = "	SELECT		BankTransaction.archiveID AS archiveID
									, BankTransaction.recipientBankAccount AS recipientBankAccount
									, BankTransaction.recipientName	AS recipientName
									, BankTransaction.payerBankAccount AS payerBankAccount
									, BankTransaction.sum AS sum
									, BankTransaction.eventDate AS eventDate
									, BankTransaction.referenceNumber AS referenceNumber
									, BankTransaction.message AS message
									, BankTransaction.currency AS currency
									, BankAccount.accountOwnerName AS payerName
						FROM		BankTransaction
						JOIN		BankAccount
						ON			BankTransaction.payerBankAccount = BankAccount.IBAN
						WHERE		BankTransaction.payerBankAccount = '$bankAccount' 
						AND			eventDate > now()
						ORDER BY	eventDate ASC ";
			
			$result = @mysql_query($query);
			
			if ($result) {
				Debug::debug(get_class(), "fillBankAccountsDuePayments", "Query ($query) has result", 3);
				
				while ($row = mysql_fetch_assoc($result)){
					Debug::debug(get_class(), "fillBankAccountsDuePayments", "While", 4);
				
					$bankTransaction = new BankTransaction();
					$bankTransaction->fillObjectFromArray($bankTransaction, $row);
					$bankAccountObject->setOneBankTransactionToTransactions($bankTransaction);
					unset($bankTransaction);
				}
			}
		}
	} // end of fillBankAccountsDuePayments()
}
?>