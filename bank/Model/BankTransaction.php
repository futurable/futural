<?php
/**
 *  BankTransaction.php
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
require_once 'bank/Data/BankTransactionDataMapper.php';

/**
 * BankTransaction.php
 * Class for customer's bank account information
 * 
 * @package   Model
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-07-12
 */
class BankTransaction {
	private $archiveID;
	private $recipientBankAccount;
	private $recipientBIC;
	private $recipientName;
	private $payerBankAccount;
	private $payerName;
	private $eventDate;
	private $createDate;
	private $sum;
	private $referenceNumber;
	private $message;
	private $currencyRate;
	private $currency;
	private $author;
	public  $dataMapper;
	
	public function __construct() {
		$this->dataMapper = new BankTransactionDataMapper();
	}
	/*
	public function __construct( $recipientBankAccount, $recipientName, $payerBankAccount, $payerName, $eventDate, $sum ) {
		$this->recipientBankAccount = $recipientBankAccount;
		$this->recipientName = $recipientName;
		$this->payerBankAccount = $payerBankAccount;
		$this->payerName = $payerName;
		$this->eventDate = $eventDate;
		$this->sum = $sum;
	}*/
	
	/**
	 * Fill existing object with data coming from array (for example $_POST)
	 * 
	 * @access public
	 * @param  BankTransaction $object
	 * @param  array $array
	 */
	public function fillObjectFromArray ( BankTransaction $object, $array ) {
		Debug::debug(get_class(), "fillObjectFromArray", "Start");
		
		if ( is_array($array)) {
			Debug::debug(get_class(), "fillObjectFromArray", "Array is array", 2);
			
			if ( isset($array[ 'archiveID' ]) and !empty($array[ 'archiveID'] ) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "ArchiveID is in array", 3);
				$this->setArchiveID( $array[ 'archiveID' ] );
			}
			if ( isset($array[ 'recipientBankAccount' ]) and !empty($array[ 'recipientBankAccount' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "RecipientBankAccount is in array", 3);
				$this->setRecipientBankAccount( $array['recipientBankAccount'] );
			}
			if ( isset($array[ 'recipientBIC' ]) and !empty($array[ 'recipientBIC' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "RecipientBIC is in array", 3);
				$this->setRecipientBIC( $array['recipientBIC'] );
			}
			if ( isset($array[ 'recipientName' ]) and !empty($array[ 'recipientName' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "RecipientName is in array", 3);
				$this->setRecipientName( $array[ 'recipientName' ] );
			}
			if (isset($array[ 'payerBankAccount' ]) and !empty($array[ 'payerBankAccount' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "PayerBankAccount is in array", 3);
				$this->setPayerBankAccount( $array[ 'payerBankAccount' ] );
			}
			if (isset($array[ 'payerName' ]) and !empty($array[ 'payerName' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "PayerName is in array", 3);
				$this->setPayerName( $array[ 'payerName' ] );
			}
			if (isset($array[ 'eventDate' ]) and !empty($array[ 'eventDate' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "EventDate is in array", 3);
				$this->setEventDate( $array[ 'eventDate' ] );
			}
			if (isset($array[ 'createDate' ]) and !empty($array[ 'createDate' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "createDate is in array", 3);
				$this->setCreateDate( $array[ 'createDate' ] );
			}
			if (isset($array[ 'sum' ]) and !empty($array[ 'sum' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "Sum is in array", 3);
				$this->setSum( $array[ 'sum' ] );
			}
			if (isset($array[ 'referenceNumber' ]) and !empty($array[ 'referenceNumber' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "ReferenceNumber is in array", 3);
				$this->setReferenceNumber( $array[ 'referenceNumber' ] );
			}
			if (isset($array[ 'message' ]) and !empty($array[ 'message' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "Message is in array", 3);
				$this->setMessage( $array[ 'message' ] );
			}
			if (isset($array[ 'userId' ]) and !empty($array[ 'userId' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "UserId is in array", 3);
				$this->setAuthor( $array[ 'userId' ] );
			}
			if (isset($array[ 'archiveID']) and !empty($array[ 'archiveID']) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "ArchiveId is in array", 3);
				$this->setArchiveID( $array[ 'archiveID' ] );
			}
			if (isset($array[ 'currencyRate' ]) and !empty($array[ 'currencyRate' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "CurrencyRate is in array", 3);
				$this->setCurrencyRate( $array[ 'currencyRate' ] );
			}
			if (isset($array[ 'currency' ]) and !empty($array[ 'currency' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "Currency is in array", 3);
				$this->setCurrency( $array[ 'currency' ] );
			}
			if (isset($array[ 'author']) and !empty($array[ 'author' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "Author is in array", 3);
				$this->setAuthor( $array[ 'author' ] );
			}
		}
	}
	
	public function validateBankTransaction () {
		$validated = '';
		
		// Payer bank account and recipientBankAccount should always be there, 
		// because user could not change that information
		/*
		if (!isset($this->payerBankAccount)) {
			$validated[ 'payerBankAccount' ] = gettext( 'Check IBAN' );
		} 
		if (!isset($this->recipientBankAccount)) {
			$validated[ 'recipientBankAccount' ] = gettext( 'Check recipient IBAN' );
		}*/
		if ( !isset($this->recipientName) ) {
			$validated[ 'recipientName' ] = gettext( 'Check repicient name' );
		}
		if ( !isset($this->sum)) {
			$validated[ 'sum' ] = gettext( 'Check sum' );
		}
		if ( !isset($this->eventDate)) {
			$validated[ 'eventDate' ] = gettext( 'Check event date' );
		}
		if ( !isset($this->referenceNumber) and !isset($this->message)) {
			$validated[ 'referenceNumber' ] = gettext( 'Check reference number' );
		}
		
		// if every required field is set
		if (isset($this->payerBankAccount) and isset($this->recipientBankAccount) and 
			isset($this->recipientName) and isset($this->sum) and 
			isset($this->eventDate) and (isset($this->referenceNumber) or isset($this->message))) {
				$validated = true;
		}
		
		return $validated;
	}
	
	public function setArchiveID( $ID ) {
		 if ( DataValidator::isArchiveIDValid( $ID ) ) {
			$this->archiveID = $ID;
		}
	}
	
	public function getArchiveID() {
		if (isset($this->archiveID)) {
			return $this->archiveID;
		}
	}
	
	public function setRecipientBankAccount( $account ) {
		if ( DataValidator::isIBANValid( $account) ) {
			$this->recipientBankAccount = $account;
		}
	}
	
	public function getRecipientBankAccount() {
		if (isset($this->recipientBankAccount)) {
			return $this->recipientBankAccount;
		}
	}
	
	public function setRecipientBIC( $BIC ) {
		if ( DataValidator::isStringValid( $BIC ) ) {
			$this->recipientBIC = $BIC;
		}
	}
	
	public function getRecipientBIC() {
		if (isset($this->recipientBIC)) {
			return $this->recipientBIC;
		}
	}
	
	public function setRecipientName( $name ) {
		if (is_string( $name )) {
			$this->recipientName = $name;
		}
	}
	
	public function getRecipientName() {
		if (isset($this->recipientName)) {
			return $this->recipientName;
		}
	}
	
	public function setPayerBankAccount( $account ) {
		if ( DataValidator::isIBANValid( $account ) ) {
			$this->payerBankAccount = $account;
		}
	}
	
	public function getPayerBankAccount() {
		if (isset($this->payerBankAccount)) {
			return $this->payerBankAccount;
		}
	}
	
	public function setPayerName( $name ) {
		if (is_string( $name )) {
			$this->payerName = $name;
		}
	}
	
	public function getPayerName() {
		if (isset($this->payerName)) {
			return $this->payerName;
		}
	}
	
	public function setEventDate( $date ) {
		if (DataValidator::isDateEUROSyntaxValid($date)) {
			Debug::debug(get_class(), "setEventDate", "Date $date is EURO syntax.", 2);
			
			$dateISOFormat = Format::formatEURODateToISOFormat($date);
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
	
	public function setCreateDate( $date ){
		if (DataValidator::isDateEUROSyntaxValid($date)) {
			Debug::debug(get_class(), "setCreateDate", "Date $date is EURO syntax.", 2);
			
			$dateISOFormat = Format::formatEURODateToISOFormat($date);
			$this->createDate = $dateISOFormat;
		} else if (DataValidator::isDateISOSyntaxValid($date)) {
			Debug::debug(get_class(), "setCreateDate", "Date $date is ISO syntax.", 2);
			$this->createDate = $date;
		} 
	}
	public function getCreateDate(){
		if (isset($this->createDate)){
			return $this->createDate;
		}
	}
	
	/**
	 * Set sum.
	 * Sum could be integer or decimal with comma or dot separator.
	 * If it is integer, add dot and two trailing zeros.
	 * If it is decimal, change possible comma separator to dot.
	 * 
	 * @param integer/decimal $sum
	 */
	public function setSum( $sum ) {
		// if sum is decimal or integer
		if ( DataValidator::isDecimalValid( $sum ) or DataValidator::isIntValid( $sum )) {
			if (DataValidator::isIntValid( $sum )) {
				$sum = number_format( $sum, 2, '.', '');
			} else if (DataValidator::isDecimalValid($sum)) { 
				// could be dot or comma separator, change possible comma to dot
				$sum = str_replace(',', '.', $sum);
			} 
			$this->sum = $sum;
		}
	}
	
	public function getSum() {
		if (isset($this->sum)) {
			return $this->sum;
		}
	}
	
	public function setReferenceNumber( $number ) {
		if (DataValidator::isReferenceNumberValid( $number )) {
			$this->referenceNumber = $number;
		} 
	}
	
	public function getReferenceNumber() {
		if (isset($this->referenceNumber)) {
			return $this->referenceNumber;
		}
	}
	
	public function setMessage( $message ) {
		if(is_string($message)) {
			$this->message = $message;
		}
	}
	
	public function getMessage() {
		if (isset($this->message)) {
			return $this->message;
		}
	}
	
	public function setCurrencyRate( $rate ) {
		if ( is_numeric($rate )) {
			$this->currencyRate = $rate;
		}
	}
	
	public function getCurrencyRate() {
		if (isset($this->currencyRate)) {
			return $this->currencyRate;
		}
	}
	
	public function setCurrency( $currency ) {
		if ( DataValidator::isStringValid( $currency, 3 )) {
			$this->currency = $currency;
		}
	}
	
	public function getCurrency() {
		if (isset($this->currency)) {
			return $this->currency;
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
		print "<p>BankTransaction<br/>
				Archive ID: $this->archiveID <br/>
				Payer IBAN: $this->payerBankAccount <br/>
				Payer Name: $this->payerName <br/>
				Recipient IBAN: $this->recipientBankAccount <br/>
				Recipient Name: $this->recipientName <br/>
				Event Date: $this->eventDate <br/>
				Create Date: $this->createDate <br/>
				Sum: $this->sum <br/>
				Reference Number: $this->referenceNumber <br/>
				Message: $this->message <br/>
				Currency Rate: $this->currencyRate <br/>
				Currency: $this->currency <br/>
				Author: $this->author </p>";
	}
}

?>