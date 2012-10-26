<?php
/**
 *  TaxAccountDataMapper.php
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

require_once 'DataMapper.php';

/**
 * TaxAccountDataMapper.php
 * Class for TaxAccount object database queries.
 * 
 * @package   Data
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-07
 */
class TaxAccountDataMapper extends DataMapper {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Save TaxAccount to database.
	 * @see DataMapper::doSave()
	 * 
	 * @access  protected
	 * @param   TaxAccount	$object
	 * @return  boolean    	$successful    	if query is successful, return true
	 *                                    	if query is not successful, return false
	 */
	protected function doSave( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof User ) {
			Debug::debug(get_class(), "doSave", "Parameter object is instance of TaxAccount", 2);
			print "doSave TaxAccount";
		}
		
		Debug::debug(get_class(), "doSave", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Update TaxAccount in database.
	 * @see DataMapper::doUpdate()
	 * 
	 * @access  protected
	 * @param   User       $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doUpdate( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof User ) {
			Debug::debug(get_class(), "doUpdate", "Parameter object is instance of TaxAccount", 2);
			print "doUpdate TaxAccount";
		}

		Debug::debug(get_class(), "doUpdate", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Delete TaxAccount from database.
	 * @see DataMapper::doDelete()
	 * 
	 * @access  protected
	 * @param   User       $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doDelete( $object ) {
		Debug::debug(get_class(), "doDelete", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof User ) {
			Debug::debug(get_class(), "doDelete", "Parameter object is instance of TaxAccount", 2);
			// delete object
			print "doDelete TaxAccount";
		}
		
		Debug::debug(get_class(), "doDelete", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Get tax account saldo
	 * 
	 * @access public
	 * @param  string	$referenceNumber
	 * @param  string	$date				The date to count the saldo for, default 'now()'
	 * @return decimal	$saldo
	 */
	public function getTaxAccountSaldo( $referenceNumber , $date = false){
		Debug::debug(get_class(), "fillTaxAccountTransactions", "Start");
		
		$referenceNumber = @mysql_real_escape_string( $referenceNumber );
		$taxAccount = substr($referenceNumber,0,-1);
		$saldo = 0;
		
		if($date && DataValidator::isDateISOSyntaxValid($date)){
			$date = "'$date'";
		}
		else{
			$date = 'now()';
		}
		
		// Get bank transactions
		$query = "
			SELECT sum(sum) AS sum
			FROM BankTransaction
			WHERE recipientBankAccount = 'FI0797029900110011'
			AND referenceNumber = '$referenceNumber'
			AND eventDate <= $date
			LIMIT 1
			";
		
		$bankResult = @mysql_query($query);
		
		// Get tax declarations
		$query = "
			SELECT sum(E.sum) AS sum
			FROM TaxDeclarationEvent AS E
			JOIN TaxDeclaration AS D
			ON D.declarationID = E.declarationID
			WHERE D.referenceNumber = '$taxAccount'
			AND (
				E.eventType = '308' 
				OR E.eventType = '608'
				)
			AND D.createDate <= $date
			LIMIT 1
		";
		
		$taxResult = @mysql_query($query);
		
		if($bankResult && $taxResult){
		// Count tax account saldo
			$bankSaldo = @mysql_result($bankResult,0,'sum');
			$taxSaldo = @mysql_result($taxResult,0,'sum');
			
			$saldo = $bankSaldo - $taxSaldo;
		}
		else $saldo = 0;
		
		return $saldo;
	}
}
?>