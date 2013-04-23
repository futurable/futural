<?php
/**
 *  BankTransactionsContent
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

require_once 'Model/BankTransaction.php';

/**
 * BankTransactionsContent
 * Class for transactions content
 * 
 * @package   UI
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-06-09
 */
class BankTransactionsContent extends Content {
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * Display bank transactions content in html.
	 * @see Content::doDisplayInHtml()
	 * 
	 * @access  protected
	 * @param   User      $userObject
	 * @return  string    $content
	 */
	protected function doDisplayInHtml( User $userObject ) {
		Debug::debug(get_class(), "doDisplayInHtml", "Start");
		
		$content = "<h1>". gettext('Bank account transactions') ."</h1>";
		
		// check user role
		$userRole = $userObject->getRole();
		
		if ( strcmp(trim($userRole), 'opiskelija') === 0 ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Profil = $userRole", 2);
			$content .= $this->doDisplayBusinessCustomerContentInHtml( $userObject );
				
		} else if ( strcmp(trim($userRole), 'Admin profil') === 0 ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Profil = $userRole", 2);
			$content .= $this->doDisplayAdminContentInHtml( $userObject );
			
		} else if ( strcmp(trim($userRole), 'ohjaaja') === 0 ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Profil = $userRole", 2);
			$content .= $this->doDisplayInstructorContentInHtml( $userObject );
		}
		
		return $content;
	}
	
	/**
	 * Displays business customer bank transaction content in html.
	 * Helper method for doDisplayInHtml.
	 * 
	 * @access private
	 * @param  Customer $userObject
	 * @return string   $content
	 */
	private function doDisplayBusinessCustomerContentInHtml( Customer $userObject ) {
		Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Start");
		
		// if user is pressed getTransaction
		if (isset($_POST[ 'getTransactions']) and $_POST[ 'getTransactions']) {
			Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "GetTransactions has been pressed", 2);
			
			$startDate = $_POST[ 'startDate' ];
			$endDate = $_POST[ 'endDate' ];
			
			// possible errors
			if ( empty($startDate) ) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Start date is empty", 3);
				$errors[ 'startDate'] = gettext('Give start date');
				$content = $this->displayBusinessCustomerSearchForm( $userObject, $errors );
				
			} else if ( empty($endDate)) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "End date is empty", 3);
				$errors[ 'endDate' ] = gettext('Give end date');
				$content = $this->displayBusinessCustomerSearchForm( $userObject, $errors );
				
			} else if ( DataValidator::isDateEUROSyntaxValid($startDate) === false ) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Start date syntax is not correct", 3);
				$errors[ 'startDate' ] = gettext('Start date is not correct (format dd.mm.yyyy)');
				$content = $this->displayBusinessCustomerSearchForm( $userObject, $errors );
				
			} else if ( DataValidator::isDateEUROSyntaxValid($endDate) === false ) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "End date syntax is not correct", 3);
				$errors[ 'endDate' ] = gettext('End date is not correct (format dd.mm.yyyy)');
				$content = $this->displayBusinessCustomerSearchForm( $userObject, $errors );
				
			} else if ( DataValidator::isStartDateBeforeEndDate($startDate, $endDate) === false ) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", " Start date is later than end date", 3);
				$errors[ 'startDate' ] = gettext('Start date can not be later than end date');
				$content = $this->displayBusinessCustomerSearchForm( $userObject, $errors );
				
			} else if ( DataValidator::isDateNotInFuture($endDate) === false ) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "End date is in future", 3);
				$errors[ 'endDate' ] = gettext('End date can not be in future');
				$content = $this->displayBusinessCustomerSearchForm( $userObject, $errors );
				
			} 
			// everything ok, get transactions
			else {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Everything ok, get transactions", 3);
				$content = $this->displayBusinessCustomerSearchForm( $userObject );
				$content .= $this->displayBusinessCustomerTransactions( $userObject, $startDate, $endDate );
			}
			
		} else {
			Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "User has not pressed button", 2);
			$content = $this->displayBusinessCustomerSearchForm( $userObject );
		}
		
		return $content;
	}
	
	/**
	 * Get HTML-formatted content for admins
	 * 
	 * @access  private
	 * @return  mixed   $content
	 */
	private function doDisplayAdminContentInHtml( User $user ) {
		Debug::debug(get_class(), "doDisplayAdminContentInHtml", "Start");

		$content = "<p>".gettext('Admin transactions view').".</p>";
		return $content;
	}
	
	/**
	 * Displays business customer's bank transactions search form (bank accounts, start date, end date).
	 * Is errors array is given, displays errors too.
	 * 
	 * @access private
	 * @param  User $userObject
	 * @param  array $errors
	 * @return string $form
	 */
	private function displayBusinessCustomerSearchForm( User $userObject, $errors = false ) {
		Debug::debug(get_class(), "displayBusinessCustomerSearchForm", "Start");
		$userBankAccounts = $userObject->getActiveBankAccountNumbers(); 
		$lang = $userObject->getLanguage();

		// Calendar JavaScript
		$form = "
		<script type=\"text/javascript\">
		$(function() {
			$.datepicker.setDefaults($.datepicker.regional['{$lang}']);
			$( \"#startDate\" ).datepicker( );
			$( \"#endDate\" ).datepicker( { maxDate: '+0d' } );
		});
		</script>";
		
		$form .= <<<EOT
		<div id='form' class='margin20bottom'>
			<form action='' method='post'>
				<fieldset>
EOT;
		$form .= "<legend>". gettext('Choose bank account and time range') ."</legend>";
		
		$form .= $this->getFormDropDownMenu(gettext('Bank account'), $userBankAccounts, 'userBankAccount');
		
		if ( $errors !== false and is_array($errors) ) {
			Debug::debug(get_class(), "displayBusinessCustomerSearchForm", "Errors array is given", 2);
			$form .= $this->getFormInputField(gettext('Start date'), 'startDate', $errors);
			$form .= $this->getFormInputField(gettext('End date'), 'endDate', $errors);
		} else {
			Debug::debug(get_class(), "displayBusinessCustomerSearchForm", "", 2);
			
			// Default dates
			if(!isset($_POST['startDate'])) $_POST['startDate'] = date('01.m.Y');
			if(!isset($_POST['endDate'])) $_POST['endDate'] = date('d.m.Y');
			
			$form .= $this->getFormInputField(gettext('Start Date'), 'startDate');
			$form .= $this->getFormInputField(gettext('End date'), 'endDate');
		}
		
		$form .= "</fieldset>
				<p><input type='submit' value='". gettext('Get Transactions') ."' name='getTransactions' /></p>
			</form>
		</div><!-- /form -->";
		
		Debug::debug(get_class(), "displayBusinessCustomerSearchForm", "Return content = $form");
		return $form;
	}
	
	/**
	 * Displays business customer transactions by user and start date and end date.
	 * 
	 * @access private
	 * @param  User   $user
	 * @param  string $startDate   dd.mm.yyyy
	 * @param  string $endDate     dd.mm.yyyy
	 * @return string $content     default = NULL
	 *                             if transactions is not empty, return content with transactions
	 *                             if transactions i empty, return content with information "No transactions"
	 */
	private function displayBusinessCustomerTransactions( User $user, $startDate, $endDate ) {
		Debug::debug(get_class(), "displayBusinessCustomerTransactions", "Start");
		$content = NULL;
		
		if ( DataValidator::isDateEUROSyntaxValid($startDate) and DataValidator::isDateEUROSyntaxValid($endDate) ) {
			Debug::debug(get_class(), "displayBusinessCustomerTransactions", "Dates are valid", 2);
			// chosen bankAccount
			$chosenBankAccount = $_POST[ 'userBankAccount' ];
			
			if ( DataValidator::isIBANValid($chosenBankAccount) ) {
				Debug::debug(get_class(), "displayBusinessCustomerTransactions", "Chosen bank account is valid", 3);
		
				// get chosen bank account object
				$bankAccount = $user->getOneBankAccountByIBAN( $chosenBankAccount );
				
				// modifying dates to ISO format
				$startDateISO = Format::formatEURODateToISOFormat($startDate);
				$endDateISO = Format::formatEURODateToISOFormat($endDate);
				
				// get bank accounts transactions by time range
				$bankAccount->getTransactionsByTimeRange( $startDateISO, $endDateISO );
				// get transactions
				$transactions = $bankAccount->getTransactions();
				
				$currency = $bankAccount->getCurrency();
				// get saldos
				$startDateSaldo = $bankAccount->getBankAccountSaldoByDate( $startDateISO);
				$endDateSaldo = $bankAccount->getBankAccountSaldoByDate( $endDateISO);
				
				$content = "<div class='info'>
								<fieldset>
									<label>". gettext('Company') ."</label>
									<span class='bold'>". $user->getCompany() ."</span>
									<label>". gettext('Bank account') ." </label>
									<span>$chosenBankAccount</span>
									<label>". gettext('Bank transactions by period') ." </label>
									<span>$startDate - $endDate</span>
									<label>". gettext('Saldo') ." $startDate</label>
									<span>$currency $startDateSaldo</span>
									<label>". gettext('Saldo') ." $endDate </label>
									<span>$currency $endDateSaldo</span>
								</fieldset>
							</div>";
				
				if (!empty($transactions)) {
					Debug::debug(get_class(), "displayBusinessCustomerTransactions", "Transactions has content", 4);
					
					$content .= "<div id='transactions' class='margin20top'>
								<table>
									<tr class='bold'>
										<td>". gettext('Event Date') ."</td>
										<td>". gettext('Recipient name') ." /<br/>". gettext('Recipient bank account') ."</td>
										<td>". gettext('Payer name') ." /<br/>". gettext('Payer bank account') ."</td>
										<td>". gettext('Sum') ."</td>
										<td>". gettext('Reference number') ." / ". gettext('Message') ."</td>
									</tr>";
					$sumTotal = 0;
					$rows = 0;
					foreach ($transactions as $key => $object) {
						$rows = $rows + 1;
						$eventDate = $object->getEventDate();
						$eventDate = Format::formatISODateToEUROFormat($eventDate);
						$recipientName = $object->getRecipientName();
						$recipientIBAN = $object->getRecipientBankAccount();
						$payerName = $object->getPayerName();
						$payerBankAccount = $object->getPayerBankAccount();
						$sum = $object->getSum();
						$referenceNumber = $object->getReferenceNumber();
						$message = $object->getMessage();
						$sumTotal = $sumTotal + $sum;
						
						$content .= "<tr";
						if ($rows%2 != 0) {
							$content .= " class='blueBg' ";
						}
						$content .= <<<EOT
						>
							<td>$eventDate</td>
							<td>$recipientName <br/> $recipientIBAN</td>
							<td>$payerName <br/> $payerBankAccount</td>
							<td>$sum</td>
							<td>$referenceNumber $message</td>
						</tr>
EOT;
					}
					$content .= "<tr>
									<td  class='borderTop' colspan='2'></td>
									<td  class='borderTop'>". gettext('Transaction total') ."</td>
									<td  class='borderTop' colspan='3'>$currency ". sprintf("%01.2f", $sumTotal) ."</td>
								</tr>
								<tr>
									<td colspan='2'></td>
									<td>". gettext('Saldo') ." $endDate</td>
									<td colspan='3'>$currency $endDateSaldo </td>
								</tr>";
					$content .= "</table></div><!-- /transactions -->";
				} else {
					Debug::debug(get_class(), "displayBusinessCustomerTransactions", "Transactions has content", 4);
					
					/*
					$content .= "<div class='info'>
									<fieldset>
										<label>". gettext('Company') ."</label>
										<span class='bold'>". $user->getCompany() ."</span>
										<label>". gettext('Bank account') ." </label>
										<span>$chosenBankAccount</span>
										<label class='bold'>". gettext('No bank transactions by period') ." </label>
										<span>$startDate - $endDate</span>
									</fieldset>
								</div>";*/
					$content .= "<div class='info'>
									<fieldset>
										<label class='bold'>". gettext('No bank transactions by period') ." </label>
										<span>$startDate - $endDate</span>
									</fieldset>
								</div>";
				}
			}
		}
		
		return $content;
	}
}
?>