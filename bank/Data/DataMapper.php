<?php
/**
 *  DataMapper.php
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
 * @version   2011-06-16
 */
abstract class DataMapper {
	/**
	 * Database connect
	 * @var DatabaseConnect $dbConnect
	 */
	protected $dbConnect;
	
	public function __construct() {
		$this->dbConnect = new DatabaseConnect();
		@mysql_set_charset('utf8'); // Set charset for tables with wrong charset
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
			if(!is_object($value)){
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