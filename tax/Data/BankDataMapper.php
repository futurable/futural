<?php
/**
 *  BankDataMapper.php
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
 * BankDataMapper.php
 * Class for BankAccount object database queries.
 * 
 * @package   Data
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-13
 */
class BankDataMapper extends DataMapper {
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Save Bank to database.
	 * @see DataMapper::doSave()
	 * 
	 * @access  protected
	 * @param   Bank       $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doSave( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof Bank ) {
			Debug::debug(get_class(), "doSave", "Parameter object is instance of Bank", 2);
			print "doUpdate Bank";
		}

		Debug::debug(get_class(), "doSave", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Update Bank in database.
	 * @see DataMapper::doUpdate()
	 * 
	 * @access  protected
	 * @param   Bank       $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doUpdate( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof Bank ) {
			Debug::debug(get_class(), "doUpdate", "Parameter object is instance of Bank", 2);
			print "doUpdate Bank";
		}

		Debug::debug(get_class(), "doUpdate", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Delete Bank from database.
	 * @see DataMapper::doDelete()
	 * 
	 * @access  protected
	 * @param   Bank       $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doDelete( $object ) {
		Debug::debug(get_class(), "doDelete", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof Bank ) {
			Debug::debug(get_class(), "doDelete", "Parameter object is instance of Bank", 2);
			// delete object
			print "doDelete Bank";
		}
		
		Debug::debug(get_class(), "doDelete", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Function to fill Bank declaration objects in spesific time range
	 * @param taxAccount $taxAccountObject	Tax account object
	 * @param string $startDate				yyyy-mm-dd, default false
	 * @param string $endDate				yyyy-mm-dd, default false
	 */
	public function doGetTransactions( TaxAccount $taxAccountObject, $startDate = false, $endDate = false){
		Debug::debug(get_class(), "doGetTransactions", "Start");
		
		$referenceNumber = @mysql_real_escape_string( $taxAccountObject->getReferenceNumber() );

		if (
			( DataValidator::isDateISOSyntaxValid( $startDate ) or $startDate == false )
			and 
			( DataValidator::isDateISOSyntaxValid( $endDate ) or $endDate == false )
			){
			
			Debug::debug(get_class(), "doGetTransactions", "Dates and reference number are valid", 2);
			
			// Get Bank declarations
			$query = "
				SELECT sum
				, eventDate
				, DATE_FORMAT( createDate, GET_FORMAT(DATE,'ISO')) as createDate
				FROM BankTransaction
				WHERE recipientBankAccount = 'FI0797029900110011'
				AND referenceNumber = '$referenceNumber'
			";
			
			if($startDate != false){
				$query .= "AND eventDate >= '$startDate' ";
			}
			if($endDate != false){
				$query .= "AND eventDate <= '$endDate' ";
			}

			$result = @mysql_query($query);
		
			if ($result) {
				Debug::debug(get_class(), "doGetTransactions", "Query ($query) has result", 2);
				
				while ($row = mysql_fetch_assoc($result)){
					Debug::debug(get_class(), "doGetTransactions", "While loop", 3);
					
					$Bank = new Bank();
					$Bank->fillObjectFromArray($Bank, $row);
					
					$taxAccountObject->setOneTransactionToTransactions( $Bank );
					unset( $Bank );
				}
			}
		}
	}
}
?>