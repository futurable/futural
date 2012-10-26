<?php
/**
 *  User.php
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

require_once 'Data/UserDataMapper.php';
require_once 'Model/BusinessCustomer.php';
require_once 'Model/Company.php';

/**
 * User.php
 * Abstract class for user's basic information
 * 
 * @package   Model
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-17
 */
abstract class User {
	protected $id;
	protected $name;
	protected $role;
	protected $language;
	protected $companies;
	protected $currentCompany;
	protected $dataMapper;
	protected $taxAccount;
	
	public static $userTypes = array( 'opiskelija' => 'BusinessCustomer', 'Admin profil' => 'Admin');
	
	public function __construct( $id ) {
		Debug::debug(get_class(), "__construct", "Start (id = $id)");
		$this->id = $id;
		
		$this->dataMapper = new UserDataMapper();
		$this->fillUserDataFromDataMapper();
	}
	
	public static function createUserById( $id ) {
		Debug::debug(get_class(), "createUserById", "Start (id = $id)");
		$dataMapper = new UserDataMapper();
		$role = $dataMapper->getUserRoleById( $id );
		
		$class = self::$userTypes[ $role ];
		$user = new $class( $id );
		
		return $user;
	}
	
	private function fillUserDataFromDataMapper() {
		$this->dataMapper->fillAbstractUserData( $this );
		$this->fillConcreteUserData();
	}
	
	protected abstract function fillConcreteUserData();
	//protected abstract function doCreateUserById( $id );
	
	public function setId ( $id ) {
		if (is_numeric($id)) {
			$this->id = $id;
		}
	}
	
	public function getId () {
		if (isset($this->id)) {
			return $this->id;
		}
	}
	
	public function setName ( $name ) {
		if (is_string($name)) {
			$this->name = $name;
		}
	}
	
	public function getName() {
		if (isset($this->name)) {
			return $this->name;
		}
	}
	
	public function setRole( $role ) {
		if (is_string($role)) {
			// TODO: tarkistetaan, että rooli on oikeanlainen
			$this->role = $role;
		}
	}
	
	public function getRole() {
		if (isset($this->role)) {
			return $this->role;
		}
	}
	
	public function setLanguage( $language ) {
		if (is_string($language)) {
			// TODO: tarkistetaan kielen oikeellisuus
			$this->language = $language;
		}
	}
	
	public function getLanguage() {
		if (isset($this->language)) {
			return $this->language;
		}
	}
	
	public function setCurrentCompany( $businessID ) {
		if (DataValidator::isPositiveIntValid($businessID)) {
			$this->currentCompany = new Company( $businessID );
		}
	}
	
	public function getCurrentCompany() {
		if (isset($this->currentCompany)) {
			return $this->currentCompany;
		}
	}
	
	public function setTaxAccount($taxAccount){
		if($taxAccount instanceof TaxAccount){
			$this->taxAccount = $taxAccount;
		}
	}
	
	public function getTaxAccount(){
		if(isset($this->taxAccount)){
			return $this->taxAccount;
		}
	}
	
	public function getCompanies() {
		if (isset($this->companies)) {
			return $this->companies;
		}
	}
	
	public function setCompanies( $companies ) {
		if (is_array($companies)) {
			$this->companies = $companies;
		}
	}
	
	public function setOneCompanyToCompaniesArray( $businessID, $companyName ) {
		if (DataValidator::isPositiveIntValid($businessID, 8) and is_string($companyName)) {
			$this->companies[ $businessID ] = $companyName;
		}
	}
	
	public function toString() {
		print "User<br/>
				Id = $this->id<br/>
				Name = $this->name <br/>
				Role = $this->role <br/>
				Language = $this->language <br/>
				CurrentCompanyBusinessID = ". $this->getCurrentCompany()->getBusinessID() ."<br/>
				CurrentCompanyName = ". $this->getCurrentCompany()->getCompanyName() ."<br/>
				Companies = 
				";
		print_r($this->companies);
				
	}
	
}

?>