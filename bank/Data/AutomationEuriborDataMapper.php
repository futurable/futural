<?php
require_once 'DataMapper.php';

/**
 *  AutomationEuriborDataMapper
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Jarmo Kortetjärvi <jarmo.kortetjarvi@futurable.fi>
 *
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
 * AutomationEuriborDataMapper.php
 * Class for euribor object database queries.
 * 
 * @package   Data
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-07-01
 */

class AutomationEuriborDataMapper extends DataMapper {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Save euribor to database.
	 * @see DataMapper::doSave()
	 * 
	 * @access  protected
	 * @param   Euribor      $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doSave( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// Check object
		if ( $object instanceof AutomationEuribor ) {
			Debug::debug(get_class(), "doSave", "Parameter object is instance of Euribor", 2);
			
			$euriborArray = $object->getEuriborArray();
				
			$query = "
				REPLACE INTO BankInterest
				(
				bankID
				, interestID
				, interestType
				, interestRate
				, createDate
				, updateDate
				, author
				, modifier
				)
				VALUES";
			
			foreach($euriborArray as $key => $value){
				$interestID = "OIVA".$key;
				
				$query .= "
					(
					'OIVAFIT0'
					, '$interestID'
					, '$key'
					, $value
					, now()
					, now()
					, 'oivapankki'
					, 'oivapankki'
					),";
			}
			
			$query = substr($query, 0, -1);
			
			$result = @mysql_query($query);
			
			if($result) $successful = true;
			else $successful = false;
		}
		
		Debug::debug(get_class(), "doSave", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Update Euribor in database.
	 * @see DataMapper::doUpdate()
	 * 
	 * @access  protected
	 * @param   Euribor		$object
	 * @return  boolean    	$successful		if query is successful, return true
	 *                                   	if query is not successful, return false
	 */
	protected function doUpdate( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof User ) {
			Debug::debug(get_class(), "doUpdate", "Parameter object is instance of Euribor", 2);
			print "doUpdate Euribor";
		}

		Debug::debug(get_class(), "doUpdate", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Delete User from database.
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
			Debug::debug(get_class(), "doDelete", "Parameter object is instance of User", 2);
			// poista olio, jos poisto onnistuu successful = true
			print "doDelete Euribor";
		}
		
		Debug::debug(get_class(), "doDelete", "Return successful = $successful");
		return $successful;
	}
	
}
?>