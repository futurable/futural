<?php
/**
 *  SEPAPaymentDataMapper.php
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

require_once 'DataMapper.php';

/**
 * SEPAPaymentDataMapper.php
 * Class for SEPAPayment object database queries.
 * 
 * @package   Data
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-07-19
 */
class SEPAPaymentDataMapper extends DataMapper {
	
	public function __construct() {
		parent::__construct();
	}
	
	protected function doSave( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		if ($object instanceof SEPAPayment ) {
			Debug::debug(get_class(), "doSave", "Parameter is SEPAPayment object", 2);
			
			$fileID = $object->getFileName();
			$ElctrncSeqNb = $object->getElctrncSeqNb();
			$MsgId = $object->getMsgId();
			$FrDtTm = $object->getFrDtTm();
			$ToDtTm = $object->getToDtTm();
			$CreDtTm = $object->getCreDtTm();
			$businessID = $object->getUser()->getCompanyBusinessID();
			$transactions = $object->getBankAccount()->getTransactions();
			
			$headerQuery = "
					INSERT INTO 	BankSEPAFiles
					SET				fileID = '$fileID'
									, ElctrncSeqNb = '$ElctrncSeqNb'
									, MsgId = '$MsgId'
									, FrDtTm = '$FrDtTm'
									, ToDtTm = '$ToDtTm'
									, CreDtTm = '$CreDtTm'
									, businessID = '$businessID'
			";

			$headerSuccess = @mysql_query( $headerQuery );
			
			$payerQuery = "
					INSERT INTO		BankTransactionCollect
									(
									archiveID
									, accountStatementPayer
									, createDate
									)
					VALUES
					";
			
			$recipientQuery = "
					INSERT INTO		BankTransactionCollect
									(
									archiveID
									, accountStatementRecipient
									, createDate
									)
					VALUES
					";
			
			$DbitTransactions = false;
			$CrdtTransactions = false;
			
			if(!empty($transactions)){
				foreach ($transactions as $transaction){
					$archiveID = $transaction->getArchiveID();
					$CdtDbt = ( $transaction->getSum() < 0 ) ? "DBIT" : "CRDT";
					
					$addQuery = "('$archiveID', now(), now()),";
					
					if($CdtDbt == 'DBIT'){
						// Customer is the debetor (payer)
						$DbitTransactions = true; // We have at least one debit transaction
						$payerQuery .= $addQuery;
					}
					elseif($CdtDbt == 'CRDT'){
						// Customer is the creditor (recipient)
						$CrdtTransactions = true; // We have at least one credit transaction
						$recipientQuery .= $addQuery;
					}
				}
			}
			
			if($DbitTransactions === true){
				$payerQuery = substr($payerQuery, 0, -1); // Strip the last comma
				$payerQuery .=  " ON DUPLICATE KEY UPDATE accountStatementPayer=now()";
				
				$payerSuccess = @mysql_query($payerQuery);
			}
			else $payerSuccess = true; // No transactions so this can't be failed
			
			if($CrdtTransactions === true){
				$recipientQuery = substr($recipientQuery, 0, -1); // Strip the last comma
				$recipientQuery .=  " ON DUPLICATE KEY UPDATE accountStatementRecipient=now()";
				
				$recipientSuccess = @mysql_query($recipientQuery);
			}
			else $recipientSuccess = true; // No transactions so this can't be failed
			
			if( $headerSuccess && $payerSuccess && $recipientSuccess ) $successful = true;
			else $successful = false;
		}
		
		Debug::debug(get_class(), "doSave", "Return successful = $successful");
		return $successful;
	}
	
	protected function doUpdate( $object ) {
		if ($object instanceof BankTransaction ) {
			print "update BankTransaction";
		}
	}
	
	protected function doDelete( $object ) {
		if ($object instanceof BankTransaction ) {
			print "delete BankTransaction";
		}
	}
}

?>