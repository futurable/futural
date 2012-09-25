<?php
/**
 *  NewAccountContent.php
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

require_once 'Model/NewAccount.php';

/**
 * NewAccountContent.php
 * Class for new account content
 * 
 * @package   UI
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-05-25
 */

class NewAccountContent extends Content {
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * Displays new account content.
	 * Only available for admin
	 * 
	 * @see Content::doDisplayInHtml()
	 */
	public function doDisplayInHtml( User $userObject ) {
		Debug::debug(get_class(), "doDisplayInHtml", "Start");
		
		$content = "<h1>". gettext('New account') ."</h1>";
		
		// check user role
		$userRole = $userObject->getRole();
		
		if ( strcmp(trim($userRole), 'opiskelija') === 0 ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Profil = $userRole", 2);
			$content .= $this->doDisplayBusinessCustomerContentInHtml( $userObject );
				
		} else if ( strcmp(trim($userRole), 'Admin profil') === 0 ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Profil = $userRole", 2);
			$content .= $this->doDisplayAdminContentInHtml( $userObject );
		}
		
		return $content;
	}
	
	/**
	 * Displays business customer's content in html (helper function to doDisplayInHtml).
	 * This function handles every form that has send in this page in business customer content.
	 * 
	 * @access private
	 * @param  User $user
	 */
	private function doDisplayBusinessCustomerContentInHtml( User $user ) {
		Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Start");
		
		$content = "<p class='errorText'>".gettext('You have insufficient privileges to display this page').".</p>";
		$content = "<p>".gettext('If you think you should be able to view this content, please contact administation').".</p>";
	}
	
	/**
	 * Displays admins content in html (helper function to doDisplayInHtml).
	 * This function handles every form that has send in this page in business customer content.
	 * 
	 * @access private
	 * @param  User $user
	 */
	private function doDisplayAdminContentInHtml( User $user ) {
		$errors = array();
		$content = '';
		
		if(isset($_POST['createAccount']) and !empty($_POST['createAccount'])){
			$errors = $this->validateNewAccount();
			
			if(empty($errors)){
				$_POST['author'] = $user->getId();
				$successful = $this->saveAccount();
			
				if($successful == true){
					unset($_POST);
					$content .= "<p class='correct'>".gettext('Saving account successful').".</p>";
				}
				else $content .= "<p class='incorrect'>".gettext('Saving account failed').".</p>";
			}
			else $content.= "<p class='incorrect'>".gettext('Check the account information').".</p>";
		}

		$content .= $this->displayNewAccountCreationForm($errors);
		
		return $content;
	}
	
	private function displayNewAccountCreationForm($errors = false){
		$form = "<div class='form'>
			<form action='' method='post'>
				<fieldset>
					<legend>". gettext('Owner info') ."</legend>";
					
		$form .= $this->getFormInputField( gettext('Account owner'), 'accountOwner', $errors );
		$form .= $this->getFormInputField( gettext('Account owner name'), 'accountOwnerName', $errors);
		$form .= $this->getFormInputField( gettext('Account name'), 'accountName', $errors);
		$form .= $this->getFormInputField( gettext('IBAN'), 'IBAN', $errors);
		$form .= $this->getFormDisabledInputField( 'BIC', 'BankBIC', $this->getBankBIC(), $errors);
		$form .= $this->getFormInputField( gettext('Interest rate'), 'interestRate', $errors);
		$form .= $this->getFormDropDownMenu( gettext('Account status'), array('enabled', 'disabled'), 'status', $errors);
					
		$form .= "</fieldset>
				<p><input type='submit' name='createAccount' value='". gettext('Create account') ."' /></p>
			</form>
		</div><!-- /form -->";

		return $form;
	}
	
	private function validateNewAccount(){
		$errors = array();
		// Validate account owner data
		if(isset($_POST['accountOwner'])){
			if(!DataValidator::isStringValid($_POST['accountOwner'], 5)) $errors['accountOwner'] = gettext('Erronous account owner.');
		}
		
		if(isset($_POST['accountOwnerName'])){
			if(!DataValidator::isStringValid($_POST['accountOwnerName'])) $errors['accountOwnerName'] = gettext('Erronous account owner name.');
		}
		
		if(isset($_POST['accountName'])){
			if(!DataValidator::isStringValid($_POST['accountName'])) $errors['accountName'] = gettext('Erronous account name.');
		}
		
		if(isset($_POST['IBAN'])){
			if(!DataValidator::isIBANValid($_POST['IBAN'])) $errors['IBAN'] = gettext('Erronous IBAN number.');
		}
		
		if(isset($_POST['BankBIC'])){
			if(!DataValidator::isBICValid($_POST['BankBIC'])) $errors['BankBIC'] = gettext('Erronous BIC number.');
		}
		
		if(isset($_POST['interestRate'])){
			if(!DataValidator::isNumericValid($_POST['interestRate'])) $errors['interestRate'] = gettext('Erronous interest rate.');
		}
		
		if(isset($_POST['status'])){
			if( $_POST['status'] != 'enabled' and $_POST['status'] != 'disabled' ) $errors['interestRate'] = gettext('Erronous status.');
		}
		
		return $errors;
	}
	
	/**
	 * Saves Account.
	 * If save is successful, return true.
	 * If save is not succesfull, return false.
	 * 
	 * @access  private
	 * @return  boolean  $successful
	 */
	private function saveAccount( $accountType = false ) {
		Debug::debug(get_class(), "savePayment", "Start");
		$successful = NULL;
		
		$account = new BankAccount($_POST['IBAN']);
		$account->setAuthor($_POST['author']);
		$account->setAccountOwner($_POST['accountOwner']);
		$account->setAccountOwnerName($_POST['accountOwnerName']);
		$account->setAccountName($_POST['accountName']);
		$account->setBIC($this->getBankBIC());
		$account->setInterestRate( CommonFunctions::trimToDecimal($_POST['interestRate']) );
		$account->setStatus($_POST['status']);
		
		// TODO: get currency
		$currency = 'EUR';
		$account->setCurrency( $currency );
		
		// start transaction
		$account->dataMapper->begin();
		
		Debug::debug(get_class(), "saveAccount", "Successful is not false, save account to BankAccount", 2);
		// save transaction
		$successful = $account->dataMapper->save( $account );
		
		if ($successful === TRUE) {
			Debug::debug(get_class(), "saveAccount", "Successful = $successful, commit", 2);
			$account->dataMapper->commit();
		} else {
			Debug::debug(get_class(), "saveAccount", "Successful = $successful, rollback", 2);
			$account->dataMapper->rollback();
		}
		
		Debug::debug(get_class(), "saveAccount", "Return successful = $successful");
		return $successful;
	}
}
?>