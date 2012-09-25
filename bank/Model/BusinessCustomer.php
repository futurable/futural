<?php
require_once 'Customer.php';

/**
 *  BusinessCustomer.php
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

/**
 * BusinessCustomer
 * Class for business customer (user is created in Pupesoft)
 * 
 * @package   Model
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-06-01
 */
class BusinessCustomer extends Customer {
	
	public function __construct($id) {
		parent::__construct($id);
	}
	
	protected function fillConcreteUserData() {
		// TODO: haetaan DataMapperin avulla mm. yhtio ja tili- sekä lainatilinumerot
		$this->dataMapper->fillConcreteBusinessCustomerUserData( $this );
		
	}
	
	public function fillCustomerLoanApplications(){
		Debug::debug(get_class(), "fillCustomerLoanApplications", "Start");
		$this->dataMapper->getCustomerLoanApplications( $this );
	}
	
	public function checkAccountType( $account ) {
		$type = null;
		if (DataValidator::isIBANValid($account)) {
			$type = $this->dataMapper->checkAccountType( $account );
		}
		return $type;
	}
	
	protected function doCreateUserById( $id ) {
		
	}
	
	public function toString() {
		print "User<br/>
				Id = $this->id<br/>
				Name = $this->name <br/>
				Role = $this->role <br/>
				Company = $this->company <br/>
				Language = $this->language <br/>
				BankAccounts = ";
		print_r($this->bankAccounts);
		print "<br/>BankLoanAccounts = ";
		print_r($this->bankLoanAccounts);
		print "<br/>LoanApplications = ";
		print_r($this->loanApplications);
	}
}
?>