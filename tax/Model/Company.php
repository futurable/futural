<?php
/**
 *  Company.php
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

require_once 'CommonServices/DataValidator.php';
require_once 'tax/Data/CompanyDataMapper.php';

/**
 * Company
 * Class for Company
 * 
 * @package   Model
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-31
 */
class Company {
	
	private $businessID;
	private $companyName;
	private $referenceNumber;
	private $dataMapper;
	
	public function __construct( $businessID ) {
		Debug::debug(get_class(), "__construct", "Start");
		$this->setBusinessID( $businessID );
		$this->dataMapper = new CompanyDataMapper();
		
		$this->fillCompanyDataFromDataMapper();
	}
	
	private function fillCompanyDataFromDataMapper(){
		$this->dataMapper->fillCompanyData( $this, $this->businessID );
	}
	
	private function setBusinessID( $businessID ){
		if( DataValidator::isIntValid($businessID) ){
			$this->businessID = $businessID;
		}
	}
	
	public function getBusinessID(){
		if( isset($this->businessID) ){
			return $this->businessID;
		}
	}
	
	public function setCompanyName( $companyName ){
		if( is_string($companyName) ){
			$this->companyName = $companyName;
		}
	}
	
	public function getCompanyName(){
		if( isset($this->companyName) ){
			return $this->companyName;
		}
	}
	
	public function setReferenceNumber( $referenceNumber ){
		if( DataValidator::isIntValid($referenceNumber) ){
			$this->referenceNumber = $referenceNumber;
		}
	}
	
	public function getReferenceNumber(){
		if( isset($this->referenceNumber) ){
			return $this->referenceNumber;
		}
	}
	
	public function toString() {
		print "Company<br/>
				BusinessID = $this->businessID<br/>
				Company name = $this->companyName <br/>
				Reference nuber = $this->referenceNumber <br/>";
				
	}
	
}
?>