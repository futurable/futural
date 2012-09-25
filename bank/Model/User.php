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
 *      This file is part of project Futural/AuthComponent.
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
 *
 */

require_once 'Data/UserDataMapper.php';

/**
 * User.php
 * Abstract class for user's basic information
 * 
 * @package   Model
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-05-28
 */
abstract class User {
	protected $id;
	protected $name;
	protected $role;
	protected $language;
	protected $company;
	protected $companyName;
	protected $companyBusinessID;
	protected $dataMapper;
	public static $userTypes = array( 'opiskelija' => 'BusinessCustomer', 'Admin profil' => 'Admin');
	
	public function __construct( $id ) {
		$this->id = $id;
		
		$this->dataMapper = new UserDataMapper();
		$this->fillUserDataFromDataMapper();
	}
	
	public static function createUserById( $id ) {
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
	
	public function setCompany ( $company ) {
		if (is_string($company)) {
			$this->company = $company;
		}
	}
	
	public function getCompany() {
		if (isset($this->company)) {
			return $this->company;
		}
	}
	
	public function setCompanyName( $companyName ){
		if (is_string($companyName)) {
			$this->companyName = $companyName;
		}
	}
	public function getCompanyName(){
		if (isset($this->companyName)) {
			return $this->companyName;
		}
	}
	
	public function setCompanyBusinessID( $companyBusinessID ){
		if(is_string( $companyBusinessID )){
			$this->companyBusinessID = $companyBusinessID;
		}
	}
	public function getCompanyBusinessID(){
		if(isset($this->companyBusinessID)){
			return $this->companyBusinessID;
		}
	}
	
	public function toString() {
		print "User<br/>
				Id = $this->id<br/>
				Name = $this->name <br/>
				Role = $this->role <br/>
				Language = $this->language ";
	}
	
}

?>