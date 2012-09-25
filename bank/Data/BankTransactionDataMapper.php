<?php
/**
 *  BankTransactionDataMapper.php
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

require_once 'DataMapper.php';

/**
 * BankTransactionDataMapper.php
 * Class for BankTransaction object database queries.
 * 
 * @package   Data
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-06-21
 */
class BankTransactionDataMapper extends DataMapper {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Saves BankTransaction object to database.
	 * 
	 * @access protected
	 * @param  BankTransaction         $object
	 * @return boolean  $successful    if query is successfull, return true
	 *                                 if query is not successfull, return false
	 */
	protected function doSave( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		if ($object instanceof BankTransaction ) {
			Debug::debug(get_class(), "doSave", "Parameter is BankTransaction object", 2);
			
			if ( DataValidator::isArchiveNumberValid( $object->getArchiveID() ) === true ) {
			
				// object values
				$archiveID = @mysql_real_escape_string( $object->getArchiveID() );
				$recipientBankAccount = @mysql_real_escape_string( $object->getRecipientBankAccount() );
				$recipientBIC = @mysql_real_escape_string( $object->getRecipientBIC() );
				$recipientName = @mysql_real_escape_string( $object->getRecipientName() );
				$payerBankAccount = @mysql_real_escape_string( $object->getPayerBankAccount() );
				$payerName = @mysql_real_escape_string( $object->getPayerName() );
				$eventDate = @mysql_real_escape_string( $object->getEventDate() );
				$sum = @mysql_real_escape_string( $object->getSum() );
				$referenceNumber = @mysql_real_escape_string( $object->getReferenceNumber() );
				$message = @mysql_real_escape_string( $object->getMessage() );
				$currencyRate = @mysql_real_escape_string( $object->getCurrencyRate() );
				$currency = @mysql_real_escape_string( $object->getCurrency() );
				$author = @mysql_real_escape_string( $object->getAuthor() );
				
		
				$query = "	INSERT INTO		BankTransaction
							SET				archiveID = '$archiveID' 
											, recipientBankAccount = '$recipientBankAccount'
											, recipientBIC = '$recipientBIC'
											, recipientName = '$recipientName' 
											, payerBankAccount = '$payerBankAccount'
											, payerName = '$payerName'
											, eventDate = '$eventDate' 
											, sum = $sum 
											, referenceNumber = '$referenceNumber' 
											, message = '$message' 
											, currencyRate = $currencyRate 
											, currency = '$currency'
											, author = '$author' 
											, createDate = NOW() ";
				
				$successful = @mysql_query( $query );
			}
		}
		
		Debug::debug(get_class(), "doSave", "Return successful = $successful");
		return $successful;
	}
	
	protected function doUpdate( $object ) {
		if ($object instanceof BankTransaction ) {
			print "update BankTransaction";
		}
	}
	
	/**
	 * Delete BankTransaction object from db.
	 * @see DataMapper::doDelete()
	 * 
	 * @access protected
	 * @param  BankTransaction         $object
	 * @return boolean  $successful    if query is successfull, return true
	 *                                 if query is not successfull, return false
	 */
	protected function doDelete( $object ) {
		Debug::debug(get_class(), "doDelete", "Start");
		$successful = false;
		
		if ($object instanceof BankTransaction ) {
			Debug::debug(get_class(), "doDelete", "Parameter object is instance of BankTransaction", 2);
			
			$archiveID = @mysql_real_escape_string( $object->getArchiveID() );
			
			$query = "	DELETE	
						FROM		BankTransaction 
						WHERE		archiveID = '$archiveID' ";
			
			$successful = mysql_query( $query );
		}
		
		Debug::debug(get_class(), "doDelete", "Return successful = $successful");
		return $successful;
	}
}

?>