<?php
/**
 *  BankLoanTransactionDataMapper.php
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
 * BankLoanTransactionDataMapper.php
 * Class for BankLoanTransaction object database queries.
 * 
 * @package   Data
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-05-22
 */
class BankLoanTransactionDataMapper extends DataMapper {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Saves BankLoanTransaction object to database.
	 * 
	 * @access private
	 * @param  BankLoanTransaction     $object
	 * @return boolean  $successful    if query is successfull, return true
	 *                                 if query is not successfull, return false
	 */
	protected function doSave( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		if ($object instanceof BankLoanTransaction ) {
			Debug::debug(get_class(), "doSave", "Parameter is BankLoanTransaction object", 2);
			
			if ( DataValidator::isArchiveNumberValid( $object->getArchiveID() ) === true ) {
				Debug::debug(get_class(), "doSave", "ArchiveNumber is valid", 3);
			
				// object values
				$archiveID = @mysql_real_escape_string( $object->getArchiveID() );
				$loanAccount = @mysql_real_escape_string( $object->getLoanAccount() );
				$instalment = @mysql_real_escape_string( $object->getInstalment() );
				$eventDate = @mysql_real_escape_string( $object->getEventDate() );
				$dueDate = @mysql_real_escape_string( $object->getDueDate() );
				$author = @mysql_real_escape_string( $object->getAuthor() );
				
		
				$query = "	INSERT INTO		BankLoanTransaction
							SET				archiveID = '$archiveID' 
											, loanAccount = '$loanAccount' 
											, instalment = $instalment 
											, eventDate = '$eventDate' 
											, dueDate = '$dueDate' 
											, author = '$author' ";
				
				$successful = @mysql_query( $query );
			}
		}
		
		Debug::debug(get_class(), "doSave", "Return successful = $successful");
		return $successful;
	}
	
	protected function doUpdate( $object ) {
		if ($object instanceof BankLoanTransaction ) {
			// TODO: 
			print "update BankLoanTransaction";
		}
	}
	
	protected function doDelete( $object ) {
		Debug::debug(get_class(), "doDelete", "Start");
		$successful = false;
		
		if ($object instanceof BankLoanTransaction ) {
			// TODO:
		}
		
		Debug::debug(get_class(), "doDelete", "Return successful = $successful");
		return $successful;
	}
}
?>