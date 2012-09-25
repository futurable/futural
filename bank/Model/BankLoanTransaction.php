<?php
require_once 'bank/Data/BankLoanTransactionDataMapper.php';
/**
 *  BankLoanTransaction
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
 * BankLoanTransaction
 * Class for customer loan application information
 * 
 * @package   Model
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-06-20
 */
class BankLoanTransaction {
	private $archiveID;
	private $loanAccount;
	private $instalment;
	private $eventDate;
	private $dueDate;
	private $author;
	public  $dataMapper;
	
	public function __construct() {
		$this->dataMapper = new BankLoanTransactionDataMapper();
	}
	
/**
	 * Fill existing object with data coming from array (for example $_POST)
	 * 
	 * @access public
	 * @param  BankTransaction $object
	 * @param  array $array
	 */
	public function fillObjectFromArray ( BankLoanTransaction $object, $array ) {
		Debug::debug(get_class(), "fillObjectFromArray", "Start");
		
		if ( is_array($array)) {
			Debug::debug(get_class(), "fillObjectFromArray", "Array is array", 2);
			
			if ( isset($array[ 'archiveID' ]) and !empty($array[ 'archiveID'] ) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "ArchiveID is in array", 3);
				$this->setArchiveID( $array[ 'archiveID' ] );
			}
			if (isset($array[ 'loanAccount' ]) and !empty($array[ 'loanAccount' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "LoanAccount is in array", 3);
				$this->setLoanAccount( $array[ 'loanAccount' ] );
			}
			if (isset($array[ 'instalment' ]) and !empty($array[ 'instalment' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "InterestAmount is in array", 3);
				$this->setInstalment( $array[ 'instalment' ] );
			}
			if (isset($array[ 'eventDate' ]) and !empty($array[ 'eventDate' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "EventDate is in array", 3);
				$this->setEventDate( $array[ 'eventDate' ] );
			}
			if (isset($array[ 'dueDate' ]) and !empty($array[ 'dueDate' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "DueDate is in array", 3);
				$this->setDueDate( $array[ 'dueDate' ] );
			}
			if (isset($array[ 'author']) and !empty($array[ 'author' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "Author is in array", 3);
				$this->setAuthor( $array[ 'author' ] );
			}
		}
	}
	
	public function validate() {
		// TODO: validointi, tarvitaanko? vain archive ID pakollinen
	}
	
	public function setArchiveID( $ID ) {
		$this->archiveID = $ID;
	}
	
	public function getArchiveID() {
		if (isset($this->archiveID)) {
			return $this->archiveID;
		}
	}
	
	public function setLoanAccount( $account ) {
		if ( DataValidator::isIBANValid( $account ) ) {
			$this->loanAccount = $account;
		}
	}
	
	public function getLoanAccount() {
		if (isset($this->loanAccount)) {
			return $this->loanAccount;
		}
	}
	
	public function setInstalment( $sum ) {
		// if instalment is decimal or integer
		if (DataValidator::isDecimalValid( $sum ) or DataValidator::isIntValid( $sum )) {
			if (DataValidator::isIntValid( $sum )) {
				$sum = number_format( $sum, 2, '.', '');
			} else if (DataValidator::isDecimalValid($sum)) { 
				// could be dot or comma separator, change possible comma to dot
				$sum = str_replace(',', '.', $sum);
			} 
			$this->instalment = $sum;
		}
	}
	
	public function getInstalment() {
		if (isset($this->instalment)) {
			return $this->instalment;
		}
	}
	
	public function setEventDate( $date ) {
		if (DataValidator::isDateEUROSyntaxValid($date)) {
			Debug::debug(get_class(), "setEventDate", "Date $date is EURO syntax.", 2);
			
			$dateISOFormat = CommonFunctions::modifyEURODateToISOFormat($date);
			$this->eventDate = $dateISOFormat;
		} else if (DataValidator::isDateISOSyntaxValid($date)) {
			Debug::debug(get_class(), "setEventDate", "Date $date is ISO syntax.", 2);
			$this->eventDate = $date;
		} 
	}
	
	public function getEventDate() {
		if (isset($this->eventDate)) {
			return $this->eventDate;
		}
	}
	
	public function setDueDate( $date ) {
		if (DataValidator::isDateEUROSyntaxValid($date)) {
			Debug::debug(get_class(), "setDueDate", "Date $date is EURO syntax.", 2);
			
			$dateISOFormat = CommonFunctions::modifyEURODateToISOFormat($date);
			$this->dueDate = $dateISOFormat;
		} else if (DataValidator::isDateISOSyntaxValid($date)) {
			Debug::debug(get_class(), "setDueDate", "Date $date is ISO syntax.", 2);
			$this->dueDate = $date;
		}
	}
	
	public function getDueDate() {
		if (isset($this->dueDate)) {
			return $this->dueDate;
		}
	}
	
	public function setAuthor( $auth ) {
		if (is_string($auth)) {
			$this->author = $auth;
		}
	}
	
	public function getAuthor() {
		if (isset($this->author)) {
			return $this->author;
		}
	}
	
	public function getObjectVariables(){
		return get_object_vars($this);
	}
	
	public function toString() {
		print "<p>BankLoanTransaction<br/>
				Archive ID: $this->archiveID <br/>
				Loan account: $this->loanAccount <br/>
				Instalment: $this->instalment <br/>
				Event Date: $this->eventDate <br/>
				Due Date: $this->dueDate <br/>
				Author: $this->author </p>";
	}
}
?>