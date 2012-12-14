<?php
/**
 *  BankLoanInfo
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
require_once 'bank/Data/BankLoanInfoDataMapper.php';

/**
 * BankLoanInfo.php
 * Class for customer loan application information
 * 
 * @package   Model
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-06-21
 */
class BankLoanInfo {
	private $loanAccount;
	private $loanID;
	private $loanApplicant;
	private $loanGranter;
	private $interestRate;
	private $interestMargin;
	private $interestRateUpdated;
	private $interestType;
	private $loanType;
	private $loanAmount;
	private $loanTerm;
	private $instalment;
	private $repayment;
	private $endDate;
	private $eventDate;
	private $createDate;
	private $grantDate;
	private $acceptDate;
	private $repaymentInterval;
	private $status;
	private $author;
	
	public  $dataMapper;
	
	public function __construct() {
		$this->dataMapper = new BankLoanInfoDataMapper();
	}
	
	/**
	 * Fill existing object with data coming from array (for example $_POST)
	 * 
	 * @access public
	 * @param  BankLoanInfo $object
	 * @param  array $array
	 */
	public function fillObjectFromArray ( BankLoanInfo $object, $array ) {
		Debug::debug(get_class(), "fillObjectFromArray", "Start");
		
		if ( is_array($array)) {
			Debug::debug(get_class(), "fillObjectFromArray", "Array is array", 2);
			
			if (isset($array[ 'loanAccount' ]) and !empty($array[ 'loanAccount' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "loanAccount is in array", 3);
				$this->setLoanAccount($array[ 'loanAccount' ]);
			}
			if (isset($array[ 'loanID' ]) and !empty($array[ 'loanID' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "loanID is in array", 3);
				$this->setLoanID( $array['loanID'] );
			}
			if (isset($array[ 'loanApplicant' ]) and !empty($array[ 'loanApplicant' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "loanApplicant is in array", 3);
				$this->setLoanApplicant($array[ 'loanApplicant' ]);
			}
			if (isset($array[ 'loanGranter' ]) and !empty($array[ 'loanGranter' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "loanGranter is in array", 3);
				$this->setLoanGranter($array[ 'loanGranter' ]);
			}
			if (isset($array[ 'interestRate' ]) and !empty($array[ 'interestRate' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "InterestRate is in array", 3);
				$this->setInterestRate($array[ 'interestRate' ]);
			}
			if (isset($array[ 'interestMargin' ]) and !empty($array[ 'interestMargin' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "InterestMargin is in array", 3);
				$this->setInterestMargin($array[ 'interestMargin']);
			}
			if (isset($array[ 'interestRateUpdated' ]) and !empty($array[ 'interestRateUpdated']) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "InterestRateUpdated is in array", 3);
				$this->setInterestRateUpdated($array[ 'interestRateUpdated' ]);
			}
			if (isset($array[ 'interestType' ]) and !empty($array[ 'interestType' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "interestType is in array", 3);
				$this->setInterestType( $array[ 'interestType' ] );
			}
			if (isset($array[ 'loanType' ]) and !empty($array[ 'loanType' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "loanType is in array", 3);
				$this->setLoanType( $array[ 'loanType' ] );
			}
			if (isset($array[ 'loanAmount' ]) and !empty($array[ 'loanAmount' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "loanAmount is in array", 3);
				$this->setLoanAmount( $array['loanAmount'] );
			}
			if (isset($array[ 'loanTerm' ]) and !empty($array[ 'loanTerm' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "loanTerm is in array", 3);
				$this->setLoanTerm( $array[ 'loanTerm' ] );
			}
			if (isset($array[ 'instalment' ]) and !empty($array[ 'instalment' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "instalment is in array", 3);
				$this->setInstalment( $array[ 'instalment' ] );
			}
			if (isset($array[ 'repayment' ]) and !empty($array[ 'repayment' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "repayment is in array", 3);
				$this->setRepayment( $array[ 'repayment' ] );
			}
			if (isset($array[ 'endDate' ]) and !empty($array[ 'endDate' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "endDate is in array", 3);
				$this->setEndDate( $array[ 'endDate' ] );
			}
			if (isset($array[ 'eventDate' ]) and !empty($array[ 'eventDate' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "EventDate is in array", 3);
				$this->setEventDate($array[ 'evetnDate' ]);
			}
			if (isset($array[ 'createDate' ]) and !empty($array[ 'createDate' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "CreateDate is in array", 3);
				$this->setCreateDate($array[ 'createDate' ]);
			}
			if (isset($array[ 'grantDate' ]) and !empty($array[ 'grantDate' ]) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "GrantDate is in array", 3);
				$this->setGrantDate($array[ 'grantDate' ]);
			}
			if (isset($array[ 'acceptDate' ]) and !empty($array[ 'acceptDate' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "acceptDate is in array", 3);
				$this->setAcceptDate($array[ 'acceptDate' ]);
			}
			if (isset($array[ 'repaymentInterval' ]) and !empty($array[ 'repaymentInterval' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "repaymentInterval is in array", 3);
				$this->setRepaymentInterval( $array[ 'repaymentInterval' ] );
			}
			if (isset($array[ 'status' ]) and !empty($array[ 'status' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "status is in array", 3);
				$this->setStatus($array[ 'status' ]);
			}
			if (isset($array[ 'userId' ]) and !empty($array[ 'userId' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "UserId is in array", 3);
				$this->setAuthor($array[ 'userId' ]);
			}
		}
	}
	
	/**
	 * Fill existing object with data coming from array (for example $_POST)
	 * 
	 * @access public
	 * @return bool		$validated on success
	 */
	public function validateBankLoanInfo () {
		$validated = '';
		
		if ( empty($this->loanAmount) || ( !DataValidator::isDecimalValid($this->loanAmount) 
			and !DataValidator::isIntValid($this->loanAmount) ) ) {
			$validated[ 'loanAmount' ] = gettext( 'Check loan amount' );
		}
		if ( $this->loanType == 'fixedRepayment' and ( empty($this->repayment) or !DataValidator::isPositiveNumericValid($this->repayment) ) ) {
			$validated[ 'repayment' ] = gettext( 'Check repayment' );
		}
		if ( $this->loanType == 'fixedInstalment' and ( empty($this->instalment) or !DataValidator::isPositiveNumericValid($this->instalment) ) ) {
			$validated[ 'instalment' ] = gettext( 'Check instalment' );
		}
		if ( $this->loanType == 'annuity' and ( empty($this->loanTerm) or !DataValidator::isPositiveIntValid($this->loanTerm) ) ) {
			$validated[ 'loanTerm' ] = gettext( 'Check loan term' );
		}
		
		if(empty($validated)){
			$validated = true;
		}
		
		return $validated;
	}
	
	public function setLoanAccount( $account ) {
		if (DataValidator::isIBANValid($account)) {
			$this->loanAccount = $account;
		}
	}
	
	public function getLoanAccount() {
		if (isset($this->loanAccount)) {
			return $this->loanAccount;
		}
	}
	
	public function setLoanID( $ID ) {
		if(DataValidator::isArchiveNumberValid($ID)){
			$this->loanID = $ID;
		}
	}
	
	public function getLoanID() {
		if (isset($this->loanID)) {
			return $this->loanID;
		}
	}
	
	public function setLoanApplicant( $applicantName) {
		if (is_string($applicantName)) {
			$this->loanApplicant = $applicantName;
		}
	}
	
	public function getLoanApplicant() {
		if (isset($this->loanApplicant)) {
			return $this->loanApplicant;
		}
	}
	
	public function setLoanGranter( $granter ) {
		if (is_string($granter)) {
			$this->loanGranter = $granter;
		}
	}
	
	public function getLoanGranter() {
		if (isset($this->loanGranter)) {
			return $this->loanGranter;
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
	
	public function setInterestMargin( $margin ) {
		if (DataValidator::isDecimalValid($margin)) {
			$this->interestMargin = $margin;
		}
	}
	
	public function getInterestMargin() {
		if (isset($this->interestMargin)) {
			return $this->interestMargin;
		}
	}
	
	public function setInterestRateUpdated( $date ) {
		if (DataValidator::isDateISOSyntaxValid($date)) {
			$this->interestRateUpdated = $date;
		}
	}
	
	public function getInterestRateUpdated() {
		if (isset($this->interestRateUpdated)) {
			return $this->interestRateUpdated;
		}
	}
	
	public function setInterestType( $interestType ) {
		if(is_string($interestType)){
			$this->interestType = $interestType;
		}
	}
	
	public function getInterestType() {
		if (isset($this->interestType)) {
			return $this->interestType;
		}
	}
	
	public function setLoanType( $loanType ) {
		if(is_string($loanType)){
			$this->loanType = $loanType;
		}
	}
	
	public function getLoanType() {
		if (isset($this->loanType)) {
			return $this->loanType;
		}
	}
	
	public function setLoanAmount( $loanAmount ) {
		$loanAmount = CommonFunctions::trimToDecimal($loanAmount);
		if($loanAmount > 0 && ( DataValidator::isIntValid($loanAmount) || DataValidator::isDecimalValid($loanAmount) ) ){
			$this->loanAmount = str_replace(',', '.', $loanAmount);
		}
	}
	
	public function getLoanAmount() {
		if (isset($this->loanAmount)) {
			return $this->loanAmount;
		}
	}
	
	public function setLoanTerm( $loanTerm) {
		if(DataValidator::isIntValid($loanTerm)){
			$this->loanTerm = $loanTerm;
		}
	}
	
	public function getLoanTerm() {
		if (isset($this->loanTerm)) {
			return $this->loanTerm;
		}
	}
	
	public function setInstalment( $instalment ) {
		$instalment = CommonFunctions::trimToDecimal($instalment);
		if( $instalment > 0 && ( DataValidator::isIntValid($instalment) || DataValidator::isDecimalValid($instalment) ) ){
			$this->instalment = str_replace(',', '.', $instalment);
		}
	}
	
	public function getInstalment() {
		if (isset($this->instalment)) {
			return $this->instalment;
		}
	}
	
	public function setRepayment( $repayment ) {
		$repayment = CommonFunctions::trimToDecimal($repayment);
		if( $repayment > 0 && ( DataValidator::isIntValid($repayment) || DataValidator::isDecimalValid($repayment) ) ){
			$this->repayment = str_replace(',', '.', $repayment);
		}
	}
	public function getRepayment() {
		if (isset($this->repayment)) {
			return $this->repayment;
		}
	}
	
	public function setEndDate( $endDate ) {
		if(DataValidator::isDateEUROSyntaxValid($endDate)){
			$this->endDate = $endDate;
		}
	}
	public function getEndDate() {
		if (isset($this->endDate)) {
			return $this->endDate;
		}
	}

	public function setEventDate( $eventDate ) {
		if (DataValidator::isDateEUROSyntaxValid($eventDate)) {
			$this->eventDate = $eventDate;
		}
	}
	
	public function getEventDate() {
		if (isset($this->eventDate)) {
			return $this->eventDate;
		}
	}
	
	public function setCreateDate( $createDate ) {
		if (DataValidator::isDateEUROSyntaxValid($createDate)) {
			$this->createDate = $createDate;
		}
	}
	
	public function getCreateDate() {
		if (isset($this->createDate)) {
			return $this->createDate;
		}
	}
	
	public function setGrantDate( $grantDate ) {
		if (DataValidator::isDateEUROSyntaxValid( $grantDate )) {
			$this->grantDate = $grantDate;
		}
	}
	
	public function getGrantDate() {
		if (isset($this->grantDate)) {
			return $this->grantDate;
		}
	}
	
	public function setAcceptDate( $date ) {
		if (DataValidator::isDateISOSyntaxValid($date)) {
			$this->acceptDate = $date;
		}
	}
	
	public function getAcceptDate() {
		if (isset($this->acceptDate)) {
			return $this->acceptDate;
		}
	}
	
	public function setRepaymentInterval( $repaymentInterval ) {
		if(is_string($repaymentInterval)){
			$this->repaymentInterval = $repaymentInterval;
		}
	}
	
	public function getRepaymentInterval() {
		if (isset($this->repaymentInterval)) {
			return $this->repaymentInterval;
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
	
	public function getObjectVariables(){
		return get_object_vars($this);
	}
	
	public function toString() {
		echo 	"<p>BankLoanInfo<br/>
				Loan account: $this->loanAccount <br/>
				Loan ID: $this->loanID <br/>
				Loan applicant: $this->loanApplicant <br/>
				Loan granter: $this->loanGranter <br/>
				Interest rate: $this->interestRate <br/>
				Interest margin: $this->interestMargin <br/>
				Interest rate updated: $this->interestRateUpdated <br/>
				Interest type: $this->interestType <br/>
				Loan type: $this->loanType <br/>
				Loan amount: $this->loanAmount <br/>
				Loan term: $this->loanTerm <br/>
				Instalment: $this->instalment <br/>
				Repayment: $this->repayment <br/>
				End date: $this->endDate <br/>
				Event date: $this->eventDate <br/>
				Create date: $this->createDate <br/>
				Grant date: $this->grantDate <br/>
				Accept date: $this->acceptDate <br/>
				Repayment interval: $this->repaymentInterval <br/>
				Status: $this->status <br/>
				Author: $this->author </p>";
	}
	
}

?>