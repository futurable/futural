<?php
/**
 *  CompanyDataMapper.php
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
 * CompanyDataMapper.php
 * Class for Company object database queries.
 * 
 * @package   Data
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-17
 */
class CompanyDataMapper extends DataMapper {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Save Company to database.
	 * @see DataMapper::doSave()
	 * 
	 * @access  protected
	 * @param   Company    $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doSave( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof Company ) {
			Debug::debug(get_class(), "doSave", "Parameter object is instance of Company", 2);
			print "doSave Company";
		}
		
		Debug::debug(get_class(), "doSave", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Update Company in database.
	 * @see DataMapper::doUpdate()
	 * 
	 * @access  protected
	 * @param   Company    $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doUpdate( $object ) {
		Debug::debug(get_class(), "doSave", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof User ) {
			Debug::debug(get_class(), "doUpdate", "Parameter object is instance of Company", 2);
			print "doUpdate Company";
		}

		Debug::debug(get_class(), "doUpdate", "Return successful $successful");
		return $successful;
	}
	
	/**
	 * Delete Company from database.
	 * @see DataMapper::doDelete()
	 * 
	 * @access  protected
	 * @param   Company    $object
	 * @return  boolean    $successful    if query is successful, return true
	 *                                    if query is not successful, return false
	 */
	protected function doDelete( $object ) {
		Debug::debug(get_class(), "doDelete", "Start");
		$successful = false;
		
		// check object
		if ( $object instanceof User ) {
			Debug::debug(get_class(), "doDelete", "Parameter object is instance of Company", 2);
			// delete object
			print "doDelete Company";
		}
		
		Debug::debug(get_class(), "doDelete", "Return successful = $successful");
		return $successful;
	}
	
	public function fillCompanyData( Company $company, $businessID ) {
		Debug::debug(get_class(), "fillCompanyData", "Start");
		$businessID = @mysql_real_escape_string($businessID);
		
		// Get company name
		$companyQuery = "	SELECT	nimi AS 'name' 
							FROM	yhtio 
							WHERE	ytunnus = '$businessID'
							LIMIT 1";
		
		$companyResult = @mysql_query($companyQuery);
		
		if($companyResult){
			$company->setCompanyName( @mysql_result( $companyResult, 0 ,'name' ) );	
		}
		
		// Get company account reference number
		$refQuery = " 	SELECT referenceNumber
						FROM TaxAccount
						WHERE accountOwner = '$businessID'
						LIMIT 1";
		$refResult = @mysql_query($refQuery);

		// Company already has an account
		if( @mysql_num_rows($refResult) > 0 ){
			$referenceNumber = @mysql_result( $refResult, 0 ,'referenceNumber' );
			// Get verification number for reference number
			$referenceNumber = $referenceNumber.CommonFunctions::getReferenceNumberVerificationNumber($referenceNumber);
			
			$company->setReferenceNumber( $referenceNumber );
		}
		// Company does not have an account
		else{
			// Create tax account
			$newAccountQuery = "	
				INSERT INTO TaxAccount
				SET accountOwner = '$businessID'
				, author = 'FuturalTax'
				";
			@mysql_query($newAccountQuery);
		}
		
		$refResult = @mysql_query($refQuery);
		if(@mysql_num_rows($refResult) > 0){
			$referenceNumber = @mysql_result( $refResult, 0 ,'referenceNumber' );
			// Get verification number for reference number
			$referenceNumber = $referenceNumber.CommonFunctions::getReferenceNumberVerificationNumber($referenceNumber);
		}
		else{
			die("Error: can't connect to database.");
		}
		
	}
	
}
?>