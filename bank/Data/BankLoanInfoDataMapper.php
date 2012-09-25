<?php
/**
 *  BankLoanInfoDataMapper.php
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
 * BankLoanInfoDataMapper.php
 * Class for BankLoanInfo objects database queries.
 * 
 * @package   Data
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-05-22
 */
class BankLoanInfoDataMapper extends DataMapper {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Saves BankLoanInfo object to database.
	 * 
	 * @access protected
	 * @param  BankLoanInfo            $object
	 * @return boolean  $successful    if query is successful, return true
	 *                                 if query is not successful, return false
	 */
	protected function doSave( $object ){
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		if ( $object instanceof BankLoanInfo ) {
			Debug::debug(get_class(), "doSave", "Parameter object is instance of BankLoanInfo", 2);
			
			// Object values
			$loanID = @mysql_real_escape_string( $object->getLoanID() );
			$loanApplicant = @mysql_real_escape_string( $object->getLoanApplicant() );
			$interestType = @mysql_real_escape_string( $object->getInterestType() );
			$loanType = @mysql_real_escape_string( $object->getLoanType() );
			$loanAmount = @mysql_real_escape_string( $object->getLoanAmount() );
			$repaymentInterval = @mysql_real_escape_string( $object->getRepaymentInterval() );
			$loanTerm = @mysql_real_escape_string( $object->getLoanTerm() );
			$repayment = ( $object->getRepayment() > 0 ) ?  @mysql_real_escape_string( $object->getRepayment() ) : $repayment = 'NULL';
			$instalment = ( $object->getInstalment() > 0 ) ? @mysql_real_escape_string( $object->getInstalment() ) : $instalment = 'NULL';
			$endDate = @mysql_real_escape_string( $object->getEndDate() );
			
			$author = $object->getAuthor();
	
			$query = "	INSERT INTO BankLoanInfo
						SET 		loanID = '$loanID'
									, loanApplicant = '$loanApplicant'
									, interestType = '$interestType'
									, loanType = '$loanType'
									, loanAmount = '$loanAmount'
									, loanTerm = '$loanTerm'
									, instalment = $instalment
									, repayment = $repayment
									, endDate = '$endDate'
									, repaymentInterval = '$repaymentInterval'
									, eventDate = 1
									, createDate = NOW()
									, author = '$author'
									, status = 'open'
						";
			
			Debug::debug(get_class(), "doSave", "BankLoanQuery: ( $query )");
			$successful = mysql_query( $query );
		}
		
		Debug::debug(get_class(), "doSave", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Updates BankLoanInfo object to db
	 * @see DataMapper::doUpdate()
	 * 
	 * @access  protected
	 * @param   BankLoanInfo  $object
	 * @return boolean        $successful    if query is successful, return true
	 *                                       if query is not successful, return false
	 */
	protected function doUpdate($object) {
		Debug::debug(get_class(), "doUpdate", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof BankLoanInfo ) {
			Debug::debug(get_class(), "doUpdate", "Parameter object is instance of BankLoanInfo", 2);
			
			// Object values
			$loanID = @mysql_real_escape_string( $object->getLoanID() );
			$loanStatus = @mysql_real_escape_string( $object->getStatus() );
	
			$query = "	UPDATE BankLoanInfo 
						SET status = '$loanStatus'
						, acceptDate = now()
						WHERE loanID = '$loanID' LIMIT 1";
			
			Debug::debug(get_class(), "doUpdate", "BankLoanApplicationUpdateQuery: ( $query )", 2);
			$successful = mysql_query( $query );
		}
		Debug::debug(get_class(), "doUpdate", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Delete BankLoanInfo object from db.
	 * @see DataMapper::doDelete()
	 * 
	 * @access protected
	 * @param  BankLoanInfo  $object
	 * @return boolean       $successful    if query is successful, return true
	 *                                      if query is not successful, return false
	 */
	protected function doDelete( $object ) {
		Debug::debug(get_class(), "doDelete", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof BankLoanInfo ) {
			Debug::debug(get_class(), "doDelete", "Parameter object is instance of BankLoanInfo", 2);
			$loanID = @mysql_real_escape_string( $object->getLoanID() );
			
			$query = "UPDATE loanInfo SET status = 'removed' WHERE loanID = '$loanID'";
		}
		
		Debug::debug(get_class(), "doDelete", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Fill BankLoanAccount bankLoanInfo variable with BankLoanInfo object.
	 * 
	 * @access protected
	 * @param  BankLoanAccount $loanAccount
	 */
	public function fillBankLoanInfo( BankLoanAccount $loanAccount ) {
		Debug::debug(get_class(), "fillBankLoanInfo", "Start");
		$IBAN = @mysql_real_escape_string( $loanAccount->getIBAN() );
		
		if (DataValidator::isIBANValid( $IBAN )) {
			Debug::debug(get_class(), "fillBankLoanInfo", "IBAN is valid", 2);
			
			$query = "	SELECT 		loanAccount
									, loanID
									, loanApplicant 
									, loanGranter 
									, interestRate 
									, interestMargin
									, DATE_FORMAT(interestRateUpdated, get_format( date, 'ISO' )) AS interestRateUpdated
									, interestType  
									, loanType 
									, loanAmount 
									, loanTerm 
									, instalment 
									, repayment 
									, endDate
									, DATE_FORMAT(eventDate, get_format( date, 'ISO' )) AS eventDate 
									, DATE_FORMAT(createDate, get_format( date, 'ISO' )) AS createDate 
									, DATE_FORMAT(grantDate, get_format( date, 'ISO' )) AS grantDate  
									, DATE_FORMAT(acceptDate, get_format( date, 'ISO' )) AS acceptDate
									, repaymentInterval
									, status 
									, author AS userId
						FROM		BankLoanInfo 
						WHERE		loanAccount = '$IBAN' ";
			
			$result = mysql_query($query);
			
			if ($result) {
				Debug::debug(get_class(), "fillBankLoanInfo", "Query ($query) has result", 3);
				$row = mysql_fetch_assoc($result);
				
				$loanInfo = new BankLoanInfo();
				$loanInfo->fillObjectFromArray($loanInfo, $row);
				$loanAccount->setBankLoanInfo( $loanInfo );
				unset($loanInfo);
			}
		}
	} // end of fillBankLoanInfo()
}
?>