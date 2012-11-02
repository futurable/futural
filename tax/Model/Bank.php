<?php
/**
 *  Bank.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Jarmo Kortetjärvi <jarmo.kortetjarvi@futurable.fi>
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

require_once 'Transaction.php';
require_once 'Data/BankDataMapper.php';

/**
 * Bank.php
 * 
 * @package   Model
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-13
 */
class Bank extends Transaction {
	
	private $eventDate;
	public $dataMapper;
	
	public function __construct() {
		parent::__construct();
		
		$this->dataMapper = new BankDataMapper();
		$this->setDescriptions();
	}
	
	/**
	 * Fill Bank object from array.
	 * @see Transaction::fillObjectFromArray()
	 */
	public function fillObjectFromArray( Transaction $object, $array ) {
		Debug::debug(get_class(), "fillObjectFromArray", "Start");
		
		if ( $object instanceof Bank and is_array($array) ) {
			Debug::debug(get_class(), "fillObjectFromArray", "Parameter array is array", 2);
			
			if ( isset($array[ 'sum' ]) and (!empty($array[ 'sum'] ) or $array[ 'sum' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "sum is in array", 3);
				$this->setSum( $array[ 'sum' ] );
			}
			if ( isset($array[ 'eventDate' ]) and (!empty($array[ 'eventDate'] )) ) {
				Debug::debug(get_class(), "fillObjectFromArray", "eventDate is in array", 3);
				$this->setEventDate( $array[ 'eventDate' ] );
			}
		}
	}
	
public function validate() {
		Debug::debug(get_class(), "validate", "Start");
		$validated = '';
		
		if ( isset($this->eventDate) and DataValidator::isDateISOSyntaxValid($this->eventDate) === false) {
			Debug::debug(get_class(), "validate", "Event date not valid");
			$validated[ 'tax301' ] = gettext( 'Please use valid event date!' );
		}
		
		if (empty($validated)) {
			$validated = true;
		}
		
		return $validated;
	}
	
	private function setDescriptions() {
		$this->descriptions = array( "sum" => gettext("Own payment") );
	}
	
	// getters and setters

	public function getEventDate() {
		if (isset($this->EventDate)) {
			return $this->EventDate;
		}
	}
	
	// Getter for targetPeriod, will return EventDate instead
	public function getTargetPeriod() {
		if (isset($this->EventDate)) {
			return $this->EventDate;
		}
	}
	
	// Getter for createDate, will return EventDate instead
	public function getCreateDate() {
		if (isset($this->EventDate)) {
			return $this->EventDate;
		}
	}
	
	public function setEventDate( $eventDate ) {
		if(DataValidator::isDateISOSyntaxValid($eventDate)){
			$this->EventDate = $eventDate;
		}
	}
	
	public function getObjectVariables(){
		return get_object_vars($this);
	}
	
	public function toString() {
		print "<p>Bank <br/>
				Sum: $this->sum <br/>
				EventDate: $this->eventDate </p>";
	}
}
?>