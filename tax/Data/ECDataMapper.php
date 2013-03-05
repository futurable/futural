<?php
/**
 *  ECDataMapper.php
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
 * ECDataMapper.php
 * Class for BankAccount object database queries.
 * 
 * @package   Data
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-13
 */
class ECDataMapper extends DataMapper {
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Save EC to database.
	 * @see DataMapper::doSave()
	 * 
	 * @access  protected
	 * @param   EC       $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doSave( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof EC ) {
			Debug::debug(get_class(), "doSave", "Parameter object is instance of EC", 2);
			
			// Start transaction
			$this->begin();
			
			// Create declaration header
			$referenceNumber = substr( $object->getReferenceNumber(), 0, -1 );
			$declarationID = $object->getDeclarationID();
			$targetPeriod = $object->getTargetPeriod()."-12";
			$declarationType = "EC";
			$author = $object->getAuthor();
			
			$declarationQuery = "
				INSERT INTO TaxDeclaration
				SET referenceNumber = '$referenceNumber'
				, declarationID = '$declarationID'
				, targetPeriod = '$targetPeriod'
				, declarationType = '$declarationType'
				, author = '$author'
			";
			
			$declarationResult = @mysql_query($declarationQuery);
			
			// Create declaration events
			$insertID = mysql_insert_id();
			$variables = $object->getObjectVariables();
			$events = array();

			foreach($variables as $key => &$value){
				if( substr($key, 0, 3) == 'tax' ){
					$events[ str_replace('tax', '' ,$key) ] = $value;
				}
			}
			
			$eventQuery = "
				INSERT INTO TaxDeclarationEvent
				(
				declarationID
				, eventType
				, sum
				, author
				)
				VALUES
			";
			
			foreach($events as $key => &$value){
				if(!empty($value)){
					$eventQuery .= "
						(
						'$declarationID'
						, '$key'
						, '$value'
						, '$author'
						),";
				}
			}
			// Pop the last comma
			$eventQuery = substr($eventQuery, 0 , -1);
			
			$eventResult = @mysql_query($eventQuery);
			
			if($declarationResult && $eventResult){
				$this->commit();
				$successful = true;
			}
			else{
				$this->rollback();
				$successful = false;
			}

		}
		else $successful = false;
		
		Debug::debug(get_class(), "doSave", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Update EC in database.
	 * @see DataMapper::doUpdate()
	 * 
	 * @access  protected
	 * @param   EC       $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doUpdate( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof EC ) {
			Debug::debug(get_class(), "doUpdate", "Parameter object is instance of EC", 2);
			print "doUpdate EC";
		}

		Debug::debug(get_class(), "doUpdate", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Delete EC from database.
	 * @see DataMapper::doDelete()
	 * 
	 * @access  protected
	 * @param   EC       $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doDelete( $object ) {
		Debug::debug(get_class(), "doDelete", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof EC ) {
			Debug::debug(get_class(), "doDelete", "Parameter object is instance of EC", 2);
			// delete object
			print "doDelete EC";
		}
		
		Debug::debug(get_class(), "doDelete", "Return successful = $successful");
		return $successful;
	}
	
	/**
	 * Function to fill EC declaration objects in spesific time range
	 * @param taxAccount 	$taxAccountObject	Tax account object
	 * @param string 		$startDate			yyyy-mm-dd, default false
	 * @param string 		$endDate			yyyy-mm-dd, default false
	 */
	public function doGetTransactions( TaxAccount $taxAccountObject, $startDate = false, $endDate = false){
		Debug::debug(get_class(), "doGetTransactions", "Start");
		
		$referenceNumber = @mysql_real_escape_string( $taxAccountObject->getReferenceNumber() );
		$taxAccount = substr($referenceNumber,0,-1);

		if ( (DataValidator::isDateISOSyntaxValid( $startDate ) or $startDate == false )
		 and ( DataValidator::isDateISOSyntaxValid( $endDate ) or $endDate == false ) ) {
			Debug::debug(get_class(), "doGetTransactions", "Dates are valid", 2);
			
			// Get EC declarations
			$query = "
				SELECT declarationID
				, targetPeriod
				, author
				, referenceNumber
				, DATE_FORMAT( createDate, GET_FORMAT(DATE,'ISO')) as createDate
				FROM TaxDeclaration
				WHERE referenceNumber = '$taxAccount'
				AND declarationType = 'EC'
			";
			
		 	if($startDate != false){
				$query .= "AND createDate >= '$startDate' ";
			}
			if($endDate != false){
				$query .= "AND createDate <= '$endDate' ";
			}
			
			$query .= "ORDER BY createDate DESC";
			
			$result = @mysql_query($query);
			
			if ($result) {
				Debug::debug(get_class(), "doGetTransactions", "Query ($query) has result", 2);
				
				while ($row = mysql_fetch_assoc($result)){
					Debug::debug(get_class(), "doGetTransactions", "While loop", 3);
					$declarationID = $row['declarationID'];
					$EC = new EC();
					
					$eventQuery = "
								SELECT -sum AS saldo
								, eventType
								FROM TaxDeclarationEvent
								WHERE declarationID = '$declarationID'";
					
					$eventResult = mysql_query($eventQuery);

					if($eventResult){
						Debug::debug(get_class(), "doGetTransactions", "EventResult");
						
						while($eventRow = @mysql_fetch_assoc($eventResult)){
							Debug::debug(get_class(), "doGetTransactions", "While loop");
							
							$row[ 'tax'.$eventRow['eventType'] ] = $eventRow['saldo'];
						}
					}
					
					$EC->fillObjectFromArray($EC, $row);
					$taxAccountObject->setOneTransactionToTransactions( $EC );
					unset( $EC );
				}
			}
		}
	}
	
}

?>