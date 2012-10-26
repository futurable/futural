<?php
/**
 *  Customer.php
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

require_once 'User.php';

/**
 * Customer.php
 * Class for customer
 * 
 * @package   Model
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-17
 */
abstract class Customer extends User {
	protected $bankAccounts;
	protected $bankLoanAccounts;
	protected $loanApplications;
	
	public function __construct($id) {
		Debug::debug(get_class(), "__construct", "Start");
		parent::__construct($id);
	}
	
	protected function fillConcreteUserData() {
		
	}
	
	//protected abstract function doCreateUserById( $id );
}
?>