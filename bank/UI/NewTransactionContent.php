<?php
/**
 *  NewTransactionContent.php
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

require_once 'Model/BankTransaction.php';
require_once 'Model/BankLoanTransaction.php';

/**
 * NewTransactionContent.php
 * Class for new transaction content
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-06-28
 */

class NewTransactionContent extends Content {
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * Displays new transaction content.
	 * Content of this page depends on user's role.
	 * 
	 * @see Content::doDisplayInHtml()
	 */
	public function doDisplayInHtml( User $userObject ) {
		Debug::debug(get_class(), "doDisplayInHtml", "Start");
		
		$content = "<h1>". gettext('New payment') ."</h1>";
		
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
		
		// if user has pressed checkAccount (1. step)
		if (isset($_POST[ 'checkAccount']) and $_POST[ 'checkAccount']) {
			Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "POST has checkAccount variable.", 2);
			$content = $this->displayCheckAccountIsPressedContent( $user );
			
		} 
		// if user has pressed continuePayment (2. step), validation is made here
		else if (isset($_POST[ 'continuePayment' ]) and $_POST[ 'continuePayment'] ) {
			Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "ContinuePayment button is pressed", 2);
			
			$currentBankAccount = $user->getOneBankAccountByIBAN( $_POST[ 'payerBankAccount' ] );
			$currentBankAccountSaldo = $currentBankAccount->getBankAccountSaldoByDate( date('Y-m-d') );
			
			$transaction = new BankTransaction();
			$transaction->fillObjectFromArray ( $transaction, $_POST );
			
			// check that account has enough money
			if ( $currentBankAccountSaldo >= $transaction->getSum() ) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Account has enought money", 3);
		
				$validated = $transaction->validateBankTransaction();
				
				// object is valid, print information and apply button
				if ($validated === true) {
					Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Transaction is valid", 4);
					$content = $this->displayValidatedNewPaymentInformationUsingObject( $transaction );
				} else {
					Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Transaction is not valid", 4);
					$content = $this->displayNotValidPayment($user, $_POST[ 'recipientBankAccount' ], $transaction, $validated);
				}
			} else {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Account has not enought money", 3);
				
				$errors[ 'sum' ] = gettext('Bank account saldo is insufficient');
				$content = $this->displayNotValidPayment($user, $_POST[ 'recipientBankAccount' ], $transaction, $errors);
			}
		} 
		// if user has pressed savePayment (3. step)
		else if (isset($_POST[ 'savePayment' ]) and $_POST[ 'savePayment' ] ) {
			Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "SavePayment button is pressed", 2);
			
			// check what kind of account is in question
			$accountType = $this->checkAndValidateAccount( $user, $_POST[ 'recipientBankAccount'] );
			
			$successful = $this->savePayment( $accountType );
			
			if ($successful === true) {
				Debug::debug(get_class(), "displaySavePaymentIsPressedContent", "Successfull = $successful", 2);
				
				$content = "<p>". gettext('Payment done') .".</p>
							<p><a href=''>". gettext('Make new payment') ."</a> ". gettext('or') ."
							 <a href='Index.php'>". gettext('Go back to front page') ."</a></p>";
			} else {
				Debug::debug(get_class(), "displaySavePaymentIsPressedContent", "Successfull = $successful", 2);
				$content = "<p>". gettext('Something went wrong. Please, try again later.') ."</p>";
			}
			
		} 
		// if user comes first time to this page
		else {
			Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "POST has not checkAccount variable.", 2);
			$content = $this->displayGiveAccountNumberForm();
		}
		
		Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Return content = $content");
		return $content;
	}
	
	private function doDisplayAdminContentInHtml( User $userObject ) {
		// TODO: admin-puolen maksu
		return "Tämä on adminin uusi maksu";
	}
	
	/**
	 * Prints form for getting recipients accoutn number.
	 * If $incorrect parameter is true, print incorrect field with css class "incorrect"
	 * and info text for user.
	 * 
	 * @access private
	 * @param  boolean $incorrect
	 * @param  boolean $invalidBranchCode
	 * @return string $form
	 */
	private function displayGiveAccountNumberForm( $incorrect = false, $invalidBranchCode = false ) {
		$form = <<<EOT
		<div id='form'>
			<form action='' method='post'>
				<fieldset>
					<legend>
EOT;
		$form .= gettext('Give recipient IBAN') . "</legend>
					
					<label>". gettext('Recipient IBAN') ."</label>
					<span>";
		
		if ( $incorrect === true ) {
			$form .= "<input type='text' name='recipientAccount' class='incorrect' value='{$_POST['recipientAccount']}'/>" . gettext('Check recipient account');
			if($invalidBranchCode === true){
				$form .= "<p><br/>".
				gettext('Given IBAN has an unknown bank SWIFT.')."<br/>".
				gettext('External payments are not supported.')."</p>";
			}
		} else {
			$form .= "<input type='text' name='recipientAccount' />";
		}
		
		$form .= "</span>
				</fieldset>
				<p><input type='submit' value='". gettext('Continue') ."' name='checkAccount' /></p>
			</form>
		</div><!-- /form -->";
		
		return $form;
	}
	
	/**
	 * Displays content when "check account"-button is pressed.
	 * If account is bank account, content is new payment form.
	 * If account is loan account, content is loan payment form.
	 * If account is not found in db, ask account again (content is same as before pushing the check account button with error text)
	 * 
	 * @access private
	 * @return string $content
	 */
	private function displayCheckAccountIsPressedContent( User $user ) {
		Debug::debug(get_class(), "displayCheckAccountIsPressedContent", "Start");
		$content = NULL;
		
		$account =  str_replace(' ', '', $_POST[ 'recipientAccount']);
		// check what kind of account is in question
		$accountType = $this->checkAndValidateAccount( $user, $account );
		
		if( $this->checkAndValidateBranchCode($account) == false ){
			Debug::debug(get_class(), "displayCheckAccountIsPressedContent", "Branch code is incorrect", 2);
			// tell user that the branch code is incorrect
			$content = $this->displayGiveAccountNumberForm( true, true );
		}
		else{
			if ($accountType instanceof BankAccount) {
				Debug::debug(get_class(), "displayCheckAccountIsPressedContent", "Account is instance of BankAccount", 3);
				// create new payment form
				$content = $this->displayNewPaymentForm( $user, $account );
				
			} else if ($accountType instanceof BankLoanAccount) {
				Debug::debug(get_class(), "displayCheckAccountIsPressedContent", "Account is instance is BankLoanAccount", 3);
				// create new loan payment form
				$content = $this->displayNewLoanPaymentForm( $user, $account );
				
			} else {
				Debug::debug(get_class(), "displayCheckAccountIsPressedContent", "Account is incorrect", 3);
				// tell user that bank account is incorrect
				$content = $this->displayGiveAccountNumberForm( true );
			}
		}
		
		return $content;
	}
	
	/**
	 * Check and validate account.
	 * 
	 * @param User $user
	 * @param string $account
	 */
	private function checkAndValidateAccount( User $user, $account ) {
		Debug::debug(get_class(), "checkAndValidateAccount", "Start");
		$type = null;
		
		if (DataValidator::isIBANValid( $account )) {
			Debug::debug(get_class(), "checkAndValidateAccount", "Parameter account is IBAN", 2);
			$type = $user->checkAccountType( $account );
		}
		
		Debug::debug(get_class(), "", "Return type");
		return $type;
	}
	
	/**
	 * Check and validate branch code
	 * 
	 * @param string	$IBAN
	 */
	private function checkAndValidateBranchCode( $IBAN ){
		$isValid = false;

		// Get branchcode
		$branchCode = IBANComponent::iban_get_branch_part($IBAN);
		
		if($branchCode != false){
			// Fetch valid branch codes
			$handle = file_get_contents("Conf/conf-bankBranches.xml", true);
			$xml = new SimpleXMLElement($handle);
				
			foreach( $xml->BankBranch as $bankBranch ){
				if( $bankBranch->BranchCode == $branchCode ){
					$isValid = true;
					break;
				}
				else continue;
			}
		}
		else $isValid = false;
		
		return $isValid;
	}
	
	/**
	 * Get bank BIC (SWIFT) from IBAN
	 * 
	 * @param string $IBAN
	 */
	private function getBICCodefromIBAN($IBAN){
		$BIC = false;
		
		if( DataValidator::isIBANValid($IBAN) ){
			$branchCode = IBANComponent::iban_get_branch_part($IBAN);

			// Get BIC code
			if($branchCode != false){
				// Fetch valid branch codes
				$handle = file_get_contents("Conf/conf-bankBranches.xml", true);
				$xml = new SimpleXMLElement($handle);
			
				foreach( $xml->BankBranch as $bankBranch ){
					if( $bankBranch->BranchCode == $branchCode ){
						$BIC = (string)$bankBranch->BIC;
						break;
					}
					else continue;
				}
			}
		}
		else $BIC = false;
		
		return $BIC;
	}
	
	/**
	 * Displays not valid payment form.
	 * Check what kind of account type is in question and displays content depending on type.
	 * 
	 * @access private
	 * @param  User            $user         current user$IBAN
	 * @param  string (IBAN)   $account      recipient bank account (account to check the type of payment)
	 * @param  BankTransaction $transaction  payment transaction
	 * @param  array           $errorArray   errors in array
	 * @return string          $content
	 */
	private function displayNotValidPayment( User $user, $account, BankTransaction $transaction, $errorArray ) {
		$content = "<p>". gettext('Something went wrong. Please, try again later.') ."</p>";
		
		if (DataValidator::isIBANValid($account) and is_array($errorArray)) {
			// check what kind of account is in question
			$accountType = $this->checkAndValidateAccount( $user, $account );
			
			if ( $accountType instanceof BankAccount ) {
				$content = $this->displayNotValidNewPaymentUsingObjectAndErrorArray( $transaction, $user, $errorArray );
			} else if ($accountType instanceof BankLoanAccount ) {
				$content = $this->displayNotValidNewLoanPaymentUsingObjectAndErrorArray( $transaction, $user, $errorArray );
			} 
		}
		
		return $content;
	}
	
	/**
	 * Displays form for new payment
	 * 
	 * @access private
	 * @param  User $user
	 * @param  string $recipientAccount
	 * @param  mixed  $recipientName     default = false
	 *                                   if given, $recipientName is string
	 * @return string $form
	 */
	private function displayNewPaymentForm( User $user, $recipientAccount, $recipientName = false ) {
		$accountOwnerName = $user->getName();
		$payerBankAccounts = $user->getActiveBankAccountNumbers();
		$lang = $user->getLanguage();
		
		// Set default due date
		if(!isset($_POST['eventDate'])) $_POST['eventDate'] = date('d.m.Y');
		
		// make archiveNumber
		$archiveID = uniqid('FUTUB');
		
		// Calendar JavaScript
		$form = "
		<script type=\"text/javascript\">
		$(function() {
			$.datepicker.setDefaults($.datepicker.regional['{$lang}']);
			$( \"#eventDate\" ).datepicker( { minDate: '+0d' } );
		});
		</script>";
		
		$form .= "<div id='form'>
			<form action='' method='post'>
				<fieldset>
					<legend>". gettext('Payer info') ."</legend>";
					
		$form .= $this->getFormDropDownMenu( gettext('Payer IBAN'), $payerBankAccounts, 'payerBankAccount');
		$form .= $this->getFormTextLabelWithHiddenInput( gettext('Payer name'), $accountOwnerName, 'payerName');
		$form .= $this->getFormHiddenInputField('userId', $user->getId() );
		$form .= "</fieldset>
				<fieldset>
					<legend>". gettext('Recipient info') ."</legend>";
		
		$form .= $this->getFormTextLabelWithHiddenInput( gettext('Recipient IBAN'), $recipientAccount, 'recipientBankAccount');
		$form .= $this->getFormTextLabelWithHiddenInput( gettext('Recipient BIC'), $this->getBICCodefromIBAN($recipientAccount), 'recipientBIC');

		if($recipientName !== false) {
			$form .= $this->getFormTextLabelWithHiddenInput( gettext('Recipient name'), $recipientName, 'recipientName');
		} else {
			$form .= $this->getFormInputField( gettext('Recipient name'), 'recipientName');
		}
		
		$form .= "</fieldset>
				<fieldset>
					<legend>". gettext('Payment info') ."</legend>";
		
		$form .= $this->getFormInputField( gettext('Sum'), 'sum');
		$form .= $this->getFormInputField( gettext('Due date'),'eventDate');
		$form .= $this->getFormInputField( gettext('Reference number'), 'referenceNumber');
		$form .= "\n
				<label class='bold'>". gettext('or') ." </label>\n
				<br/>\n";
		$form .= $this->getFormTextarea( gettext('Message'), 'message', 5, 50);
		$form .= $this->getFormHiddenInputField( 'archiveID' , $archiveID);
					
		$form .= "</fieldset>
				<p><input type='submit' name='continuePayment' value='". gettext('Continue') ."' />
				<input type='submit' name='cancel' value='". gettext('Cancel') ."' /></p>
			</form>
		</div><!-- /form -->";

		return $form;
		
	}
	
	/**
	 * Displays form for new loan payment (extra loan payment)
	 * 
	 * @access private
	 * @param  User          $user                current user
	 * @param  string (IBAN) $recipientAccount
	 * @return string        $form                form for payment
	 */
	private function displayNewLoanPaymentForm( User $user, $recipientAccount ) {
		$accountOwnerName = $user->getName();
		$payerBankAccounts = $user->getActiveBankAccountNumbers();
		// make archiveNumber
		$archiveID = uniqid('FUTUB');
		
		$form = "<div id='form'>
			<form action='' method='post'>
				<fieldset>
					<legend>". gettext('Payer info') ."</legend>";
		
		$form .= $this->getFormDropDownMenu( gettext('Payer IBAN'), $payerBankAccounts, 'payerBankAccount');
		$form .= $this->getFormTextLabelWithHiddenInput( gettext('Payer name'), $accountOwnerName, 'payerName');
		$form .= $this->getFormHiddenInputField('userId', $user->getId() );
		
		$form .= "</fieldset>
				<fieldset>
					<legend>". gettext('Recipient info') ."</legend>";
		
		$form .= $this->getFormTextLabelWithHiddenInput( gettext('Recipient IBAN'), $recipientAccount, 'recipientBankAccount');
		$form .= $this->getFormTextLabelWithHiddenInput( gettext('Recipient BIC'), $this->getBICCodefromIBAN($recipientAccount), 'recipientBIC');
		$form .= $this->getFormTextLabelWithHiddenInput( gettext('Recipient name'), 'Futural Bank', 'recipientName');
		
		$form .= "</fieldset>
				<fieldset>
					<legend>". gettext('Payment info') ."</legend>";
		
		$form .= $this->getFormInputField( gettext('Sum'), 'sum');
		$form .= $this->getFormTextLabelWithHiddenInput( gettext('Due date') , date('d.m.Y'), 'eventDate');
		$form .= $this->getFormTextLabelWithHiddenInput( gettext('Message'), gettext('Extra loan repayment'), 'message');
		$form .= $this->getFormHiddenInputField( 'archiveID' , $archiveID);
		
		$form .= "</fieldset>
				<p><input type='submit' name='continuePayment' value='". gettext('Continue') ."' />
				<input type='submit' name='cancel' value='". gettext('Cancel') ."' /></p>
			</form>
		</div><!-- /form -->";
		
		return $form;
	}
	
	/**
	 * Displays validated BankTransaction information.
	 * Information is displayed with information in object (parameter object).
	 * 
	 * @access private
	 * @param  BankTransaction $object
	 * @return string $form
	 */
	private function displayValidatedNewPaymentInformationUsingObject ( BankTransaction $object ) {
		
		$form = "<div id='form'>
			<form action='' method='post'>
				<fieldset>
					<legend>". gettext('Payment info') ."</legend>";

		$form .= $this->getFormTextLabelWithHiddenInput(gettext('Payer IBAN'), $object->getPayerBankAccount(), 'payerBankAccount');
		$form .= $this->getFormTextLabelWithHiddenInput(gettext('Payer name'), $object->getPayerName(), 'payerName');
		$form .= $this->getFormHiddenInputField( 'userId' , $object->getAuthor());
		$form .= $this->getFormTextLabelWithHiddenInput(gettext('Recipient IBAN'), $object->getRecipientBankAccount(), 'recipientBankAccount');
		$form .= $this->getFormTextLabelWithHiddenInput(gettext('Recipient BIC'), $object->getRecipientBIC(), 'recipientBIC');
		$form .= $this->getFormTextLabelWithHiddenInput(gettext('Recipient name'), $object->getRecipientName(), 'recipientName');
		$form .= $this->getFormTextLabelWithHiddenInput(gettext('Sum'), $object->getSum(), 'sum');
		// special for date
		$form .= "<label>". gettext('Due date') .": </label><span>". Format::formatISODateToEUROFormat($object->getEventDate()) ."</span>\n";
		$form .= $this->getFormHiddenInputField( 'eventDate' , $object->getEventDate());
		
		$form .= $this->getFormTextLabelWithHiddenInput(gettext('Reference number'), $object->getReferenceNumber(), 'referenceNumber');
		$form .= $this->getFormTextLabelWithHiddenInput(gettext('Message'), $object->getMessage(), 'message') ."\n";
		$form .= $this->getFormHiddenInputField( 'archiveID' , $object->getArchiveID());
		$form .= "</fieldset>
				<p>
				<input type='submit' name='savePayment' value='". gettext('Confirm') ."' />
				<input type='submit' name='cancel' value='". gettext('Cancel') ."' />
				</p>
			</form>
		</div><!-- /form -->";

		return $form;
	}
	
	/**
	 * Displays not valid new payment form.
	 * Information is displayed with information in objects (parameter objects) and errorArray.
	 * 
	 * @access private
	 * @param  BankTransaction $object
	 * @param  User $user
	 * @param  array $errorArray
	 * @return string $form
	 */
	private function displayNotValidNewPaymentUsingObjectAndErrorArray( BankTransaction $object, User $user, $errorArray ) {
		if (is_array($errorArray)) {
		
			$form = "<div class='form'>
			<form action='' method='post'>
				<fieldset>
					<legend>". gettext('Payer info') ."</legend>";
			
			$form .= $this->getFormDropDownMenu( gettext('Payer IBAN'), $user->getActiveBankAccountNumbers(), 'payerBankAccount');
			$form .= $this->getFormTextLabelWithHiddenInput( gettext('Payer name'), $object->getPayerName(), 'payerName');
			$form .= $this->getFormHiddenInputField('userId', $object->getAuthor());
			$form .= "</fieldset>
					<fieldset>
						<legend>". gettext('Recipient info') ."</legend>";
			
			$form .= $this->getFormTextLabelWithHiddenInput( gettext('Recipient IBAN'), $object->getRecipientBankAccount(), 'recipientBankAccount');
			$form .= $this->getFormTextLabelWithHiddenInput( gettext('Recipient BIC'), $this->getBICCodefromIBAN($object->getRecipientBankAccount()), 'recipientBIC');
			$form .= $this->getFormInputField(gettext('Recipient name'), 'recipientName', $errorArray);
			
			$form .= "</fieldset>
					<fieldset>
						<legend>". gettext('Payment info') ."</legend>";
			
			$form .= $this->getFormInputField( gettext('Sum'), 'sum', $errorArray);
			$form .= $this->getFormCalendarField(gettext('Due date'), 'eventDate', $errorArray);
			$form .= $this->getFormInputField( gettext('Reference number'), 'referenceNumber', $errorArray);
			$form .= "\n
					<label class='bold'>tai </label>\n
					<br/>\n";
			$form .= $this->getFormTextarea( gettext('Message'), 'message', 5, 50);
			$form .= $this->getFormHiddenInputField( 'archiveID' , $object->getArchiveID());
						
			$form .= "</fieldset>
					<p><input type='submit' name='continuePayment' value='". gettext('Continue') ."' />
					<input type='submit' name='cancel' value='". gettext('Cancel') ."' /></p>
				</form>
			</div><!-- /form -->";
	
			return $form;
		}
	}
	
	/**
	 * Displays not valid new loan payment form.
	 * Information is displayed with information in objects (parameter objects) and errorArray.
	 * 
	 * @access private
	 * @param  BankTransaction $object
	 * @param  User            $user
	 * @param  array           $errorArray
	 * @return string          $form
	 */
	private function displayNotValidNewLoanPaymentUsingObjectAndErrorArray( BankTransaction $object, User $user, $errorArray ) {
		if (is_array($errorArray)) {
			$form = "<div id='form'>
			<form action='' method='post'>
				<fieldset>
					<legend>". gettext('Payer info') ."</legend>";
			
			$form .= $this->getFormDropDownMenu( gettext('Payer IBAN'), $user->getActiveBankAccountNumbers(), 'payerBankAccount');
			$form .= $this->getFormTextLabelWithHiddenInput( gettext('Payer name'), $object->getPayerName(), 'payerName');
			$form .= $this->getFormHiddenInputField('userId', $object->getAuthor());
			$form .= "</fieldset>
					<fieldset>
						<legend>". gettext('Recipient info') ."</legend>";
			
			$form .= $this->getFormTextLabelWithHiddenInput( gettext('Recipient IBAN'), $object->getRecipientBankAccount(), 'recipientBankAccount');
			$form .= $this->getFormTextLabelWithHiddenInput( gettext('Recipient BIC'), $this->getBICCodefromIBAN($object->getRecipientBankAccount()), 'recipientBIC');
			$form .= $this->getFormTextLabelWithHiddenInput( gettext('Recipient name'), 'Futural Bank', 'recipientName' );
			
			$form .= "</fieldset>
					<fieldset>
						<legend>". gettext('Payment info') ."</legend>";
			
			$form .= $this->getFormInputField( gettext('Sum'), 'sum', $errorArray);
			// special for date
			$form .= "<label>". gettext('Due date') .": </label><span>". Format::formatISODateToEUROFormat($object->getEventDate()) ."</span>\n";
			$form .= $this->getFormHiddenInputField( 'eventDate' , $object->getEventDate());
			
			$form .= $this->getFormTextLabelWithHiddenInput( gettext('Message'), gettext('Extra loan repayment'), 'message');
			$form .= $this->getFormHiddenInputField( 'archiveID' , $object->getArchiveID());
						
			$form .= "</fieldset>
					<p><input type='submit' name='continuePayment' value='". gettext('Continue') ."' />
					<input type='submit' name='cancel' value='". gettext('Cancel') ."' /></p>
				</form>
			</div><!-- /form -->";
	
			return $form;
		}
	}
	
	/**
	 * Saves payment.
	 * If save is successful, return true.
	 * If save is not succesfull, return false.
	 * 
	 * @access  private
	 * @return  boolean  $successful
	 */
	private function savePayment( $accountType = false ) {
		Debug::debug(get_class(), "savePayment", "Start");
		$successful = NULL;
		
		$transaction = new BankTransaction();
		$transaction->fillObjectFromArray( $transaction, $_POST );
		
		// add currency rate, currency
		// TODO: hae valuuttakurssit jostain! Kun käytetään EUROja, kurssi on aina 1
		$currencyRate = 1;
		$currency = 'EUR';
		
		$transaction->setCurrencyRate( $currencyRate );
		$transaction->setCurrency( $currency );
		
		// start transaction
		$transaction->dataMapper->begin();
		
		if ( $accountType instanceof BankLoanAccount ) {
			Debug::debug(get_class(), "savePayment", "Account type is BankLoanAccount", 2);
			
			// make extra variables to POST array
			$_POST[ 'loanAccount'] = $_POST[ 'recipientBankAccount' ];
			$_POST[ 'instalment' ] = $_POST[ 'sum' ];
			$_POST[ 'author' ] = $_POST[ 'userId' ];
			$_POST[ 'dueDate' ] = $_POST[ 'eventDate' ];
			
			// create BankLoanTransaction object and save it
			$bankLoanTransaction = new BankLoanTransaction();
			$bankLoanTransaction->fillObjectFromArray( $bankLoanTransaction, $_POST );
			
			$successful = $bankLoanTransaction->dataMapper->save( $bankLoanTransaction );
			Debug::debug(get_class(), "savePayment", "Successful = $successful (saving to BankLoanTransaction table)", 2);
		}
		
		if ($successful !== FALSE) {
			Debug::debug(get_class(), "savePayment", "Successful is not false, save transaction to BankTransaction", 2);
			// save transaction
			$successful = $transaction->dataMapper->save( $transaction );
		}
		
		if ($successful === TRUE) {
			Debug::debug(get_class(), "savePayment", "Successful = $successful, commit", 2);
			$transaction->dataMapper->commit();
		} else {
			Debug::debug(get_class(), "savePayment", "Successful = $successful, rollback", 2);
			$transaction->dataMapper->rollback();
		}
		
		Debug::debug(get_class(), "savePayment", "Return successful = $successful");
		return $successful;
	}

}
?>