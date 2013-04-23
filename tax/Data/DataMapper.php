<?php
/**
 *  DataMapper.php
 *
 *  Copyright information
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Annika Granlund <annika.granlund@futurable.fi>
 *
 *  License
 *
 *      This file is part of project Futural/tax.
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

require_once 'CommonServices/DatabaseConnect.php';
require_once 'CommonServices/DataValidator.php';

/**
 * DataMapper.php
 * Abstract class for database queries.
 * 
 * @package   Data
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-17
 */
abstract class DataMapper {
	
	public function __construct() {
		$dbConnect = new DatabaseConnect();
	}
	
	/**
	 * Saves new object to database.
	 * 
	 * @access  public
	 * @param   mixed    $object (Model layer type object)
	 * @return  boolean  $successful  if save query is successful, return true
	 *                                else return false
	 */
	public function save( $object ) {
		Debug::debug(get_class(), "save", "Start");
		$successful = false;

		// Get object variables
		$objectVars = $object->getObjectVariables();
		$objectClass = get_class($object);
		
		// Escape object variables
		foreach($objectVars as $var => $value){
			if(!is_object($value) and !is_array($value)){
				$var = ucfirst($var);
				$temp = '$object->set'.$var.'(@mysql_real_escape_string("'.$value.'"));';
				Debug::debug(get_class(), "save", "Escaping $objectClass: '".'$'."$var'", 3);
				eval($temp);
			}
		}
		
		$successful = $this->doSave( $object );
		
		Debug::debug(get_class(), "save", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Saves object to database.
	 * Actual saving is made in child classes.
	 * 
	 * @param mixed $object (Model layer type object)
	 */
	protected abstract function doSave( $object );
	
	/**
	 * Updates object in database.
	 * 
	 * @access  public
	 * @param   mixed	 $object  (Model layer type object)
	 * @return  boolean  $successful  if update query is successful, return true
	 *                                else return false
	 */
	public function update( $object ){
		Debug::debug(get_class(), "update", "Start");
		$successful = false;
		
		// Get object variables
		$objectVars = $object->getObjectVariables();
		$objectClass = get_class($object);
		
		// Escape object variables
		foreach($objectVars as $var => $value){
			if(!is_object($value)){
				$var = ucfirst($var);
				$temp = '$object->set'.$var.'(@mysql_real_escape_string("'.$value.'"));';
				Debug::debug(get_class(), "update", "Escaping $objectClass: '".'$'."$var'", 3);
				eval($temp);
			}
		}
		
		$successful = $this->doUpdate( $object );
		
		Debug::debug(get_class(), "update", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Updates object in database.
	 * Actual update is made in child classes.
	 * 
	 * @param mixed $object (Model layer type object)
	 */
	protected abstract function doUpdate( $object );
	
	
	/**
	 * Delete object from database.
	 * 
	 * @access  public
	 * @param   mixed    $object (Model layer type object)
	 * @return  boolean  $successful  if save query is successful, return true
	 *                                else return false
	 */
	public function delete( $object ) {
		Debug::debug(get_class(), "delete", "Start");
		$successful = false;
		
		// Get object variables
		$objectVars = $object->getObjectVariables();
		$objectClass = get_class($object);
		
		// Escape object variables
		foreach($objectVars as $var => $value){
			if(!is_object($value)){
				$var = ucfirst($var);
				$temp = '$object->set'.$var.'(@mysql_real_escape_string("'.$value.'"));';
				Debug::debug(get_class(), "save", "Escaping $objectClass: '".'$'."$var'", 3);
				eval($temp);
			}
		}
		
		$successful = $this->doDelete( $object );
		
		Debug::debug(get_class(), "delete", "Return successfull = $successful");
		return $successful;
	}
	
	/**
	 * Delete object from database.
	 * Actual delete is made in child classes.
	 * 
	 * @param mixed $object (Model layer type object)
	 */
	protected abstract function doDelete( $object );
	
	/**
	 * Get all tax account transactions.
	 * Fill transactions to TaxAccount object.
	 * 
	 * @access public
	 * @param  TaxAccount 	$taxAccountObject
	 * @return bool			$success		
	 */
	public function getTransactions( TaxAccount $taxAccountObject ){
		Debug::debug(get_class(), "getTransactions", "Start");
		$success = false;
			
			// Fill VAT transactions
			$VATDataMapper = new VATDataMapper();
			$VATSuccess = $VATDataMapper->doGetTransactions($taxAccountObject);
			
			// Fill EC transactions
			$ECDataMapper = new ECDataMapper();
			$ECSuccess = $ECDataMapper->doGetTransactions($taxAccountObject);
			
			// Fill bank transactions
			$BankDataMapper = new BankDataMapper();
			$BankSuccess = $BankDataMapper->doGetTransactions($taxAccountObject);
			
			if( $VATSuccess and $ECSuccess and BankSuccess ){
				Debug::debug(get_class(), "getTransactions", "VATSuccess = $VATSuccess, $ECSuccess = $ECSuccess,
											BankSuccess = $BankSuccess");
				$success = true;
			} else { 
				$success = false;
			}
		
		return $success;
	}
	
	/**
	 * Get VAT and AC transactions.
	 * Fill transactions to TaxAccount objects transactions array.
	 * Actual filling is mage in sub classes.
	 * 
	 * @access public
	 * @param  TaxAccount $taxAccountObject
	 * @return boolean    $success
	 */
	public function getTaxTransactions( TaxAccount $taxAccountObject) {
		Debug::debug(get_class(), "getTransactions", "Start");
		$success = false;
			
		// Fill VAT transactions
		$VATDataMapper = new VATDataMapper();
		$VATSuccess = $VATDataMapper->doGetTransactions($taxAccountObject);
		
		// Fill EC transactions
		$ECDataMapper = new ECDataMapper();
		$ECSuccess = $ECDataMapper->doGetTransactions($taxAccountObject);
		
		if( $VATSuccess and $ECSuccess ){
			Debug::debug(get_class(), "getTransactions", "VATSuccess = $VATSuccess, $ECSuccess = $ECSuccess" );
			$success = true;
		} else { 
			$success = false;
		}
		
		return $success;
	}
	
	/**
	 * Get tax account transactions in by time range
	 * Fill transactions to TaxAccount object.
	 * 
	 * @access public
	 * @param  TaxAccount 	$taxAccountObject
	 * @param string $startDate		ISO-formatted date
	 * @param string $endDate		ISO-formatted date
	 * @return bool					$success		
	 */
	public function getTransactionsByTimeRange( TaxAccount $taxAccountObject, $startDate, $endDate ) {
		Debug::debug(get_class(), "getTaxTransactionsByTimeRange", "Start");
		$success = false;
		
		if( DataValidator::isDateISOSyntaxValid($startDate) and DataValidator::isDateISOSyntaxValid($endDate) ){
				
			Debug::debug(get_class(), "getTaxTransactionsByTimeRange", "Dates are valid", 2);

			// Fill VAT transactions
			$VATDataMapper = new VATDataMapper();
			$VATSuccess = $VATDataMapper->doGetTransactions($taxAccountObject, $startDate, $endDate );
			
			// Fill EC transactions
			$ECDataMapper = new ECDataMapper();
			$ECSuccess = $ECDataMapper->doGetTransactions($taxAccountObject, $startDate, $endDate );
			
			// Fill bank transactions
			$BankDataMapper = new BankDataMapper();
			$BankSuccess = $BankDataMapper->doGetTransactions($taxAccountObject, $startDate, $endDate);
			
			if( $VATSuccess and $ECSuccess and $BankSuccess ){
				$success = true;
			}
			else $success = false;
		}
		else $success = false;
		
		return $success;
	}
	
	public function getTaxTransactionsSumByPeriod( TaxAccount $taxAccountObject, $targetPeriod, $type ){
		Debug::debug(get_class(), "doGetTransactionsSumByPeriod", "Start");
		
		if ( DataValidator::isDateISOSyntaxValid( $targetPeriod ) and ($type == 'VAT' or $type == 'EC') ){

		$referenceNumber = @mysql_real_escape_string( $taxAccountObject->getReferenceNumber() );
		$taxAccount = substr($referenceNumber,0,-1);

			if ( DataValidator::isDateISOSyntaxValid( $targetPeriod )){
				Debug::debug(get_class(), "doGetTransactions", "Target period is valid", 2);
				
				$tax = new $type();
				
				$query = "
					SELECT sum(E.sum) AS saldo
					, E.eventType AS eventType
					FROM TaxDeclarationEvent AS E
					JOIN TaxDeclaration AS D
					ON D.declarationID = E.declarationID
					WHERE D.referenceNumber = '$taxAccount'
					AND D.targetPeriod = '$targetPeriod'
					AND D.declarationType = '$type'
					GROUP BY E.eventType
				";
				$result = mysql_query($query);
				
				if($result){
					Debug::debug(get_class(), "getTaxTransactionsSumByPeriod", "Got result", 3);
					
					while($resRow = @mysql_fetch_assoc($result)){
						Debug::debug(get_class(), "getTaxTransactionsSumByPeriod", "While loop", 4);
						
						$row[ 'tax'.$resRow['eventType'] ] = $resRow['saldo'];
					}
					$row[ 'targetPeriod' ] = $targetPeriod;
					$row[ 'referenceNumber' ] = $referenceNumber;
	
					$tax->fillObjectFromArray($tax, $row);
					$taxAccountObject->setOneTransactionToTransactions( $tax );
					unset( $tax );
				}
			}			
		}
	}
	
	/**
	 * Transaction begin
	 */
	public function begin() {
		@mysql_query("BEGIN");
	}

	/**
	 * Transaction commit
	 */
	public function commit() {
		@mysql_query("COMMIT");
	}

	/**
	 * Transaction rollback
	 */
	public function rollback() {
		@mysql_query("ROLLBACK");
	}
	
	
}
?>