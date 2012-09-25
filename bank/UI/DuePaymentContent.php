<?php
/**
 *  DuePaymentContent.php
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
 * DuePaymentContent
 * Class for due payment content
 * 
 * @package   UI
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-06-27
 */
class DuePaymentContent extends Content {
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * Display due payments content
	 * @see Content::doDisplayInHtml()
	 * 
	 * @access protected
	 * @param  User      $user
	 * @return string    $content
	 */
	protected function doDisplayInHtml( User $user ) {
		Debug::debug(get_class(), "doDisplayInHtml", "Start");
		
		$content = "<h1>". gettext( 'Due payments' ) ."</h1>";
		
		// check user role
		$userRole = $user->getRole();
		
		if ( strcmp(trim($userRole), 'opiskelija') === 0 ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Profil = $userRole", 2);
			$content .= $this->doDisplayBusinessCustomerContentInHtml( $user );
		}
		
		return $content;
	}
	
	/**
	 * Display business customer due payments content.
	 * Helper method for doDisplayInHtml.
	 * 
	 * @access private
	 * @param  User    $userObject
	 * @return string  $content
	 */
	private function doDisplayBusinessCustomerContentInHtml( User $userObject ) {
		Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Start");
		$content = '';
		
		// if user is pressed getTransaction
		if (isset($_POST[ 'deletePayment']) and $_POST[ 'deletePayment']) {
			Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "DeletePayment has been pressed", 2);
			$_POST[ 'archiveID' ] = Crypt::decrypt($_POST[ 'archiveID' ]);
			
			// create object
			$transactionObject = new BankTransaction();
			$transactionObject->fillObjectFromArray( $transactionObject, $_POST);
			
			$querySuccess = $transactionObject->dataMapper->delete( $transactionObject );
			
			if ($querySuccess === true) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Transaction delete successful", 3);
				$content .= "<p>". gettext('Transaction delete successful') ."</p>";
			} else {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Transaction delete not successful", 3);
				$content .= "<p>". gettext('Transaction delete not successful') ."</p>";
			}
			
			$content .= $this->displayActiveBankAccountDuePaymentsInTable( $userObject );
			
		} else {
			$content = $this->displayActiveBankAccountDuePaymentsInTable( $userObject );
		}
		
		Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Return content $content");
		return $content;
	}
	
	/**
	 * Display active BankAccount objects due payments (transactions) in html table.
	 * Helper method for doDisplayInHtml.
	 * 
	 * @access private
	 * @param  User      $userObject
	 * @return string    $content
	 */
	private function displayActiveBankAccountDuePaymentsInTable( User $userObject ) {
		Debug::debug(get_class(), "displayActiveBankAccountDuePaymentsInTable", "Start");
		$content = '';
		
		// active bank accounts
		$activeBankAccounts = $userObject->getActiveBankAccounts();
		
		if (!empty($activeBankAccounts)) {
			Debug::debug(get_class(), "displayActiveBankAccountDuePaymentsInTable", "ActiveBankAccount is not empty", 2);
			$content .= "<div id='transactions' class='margin20top'>
							<table>
								<tr class='bold'>
									<td>". gettext('Event Date') ."</td>
									<td>". gettext('Recipient name') ." /<br/>". gettext('Recipient bank account') ."</td>
									<td>". gettext('Payer name') ." /<br/>". gettext('Payer bank account') ."</td>
									<td>". gettext('Sum') ."</td>
									<td>". gettext('Reference number') ."</td>
									<td>". gettext('Message') ."</td>
									<td>". gettext('Delete payment') ."</td>
								</tr>";
			$rows = 0;
			$sumTotal = 0;
			$currency = '';
			
			// different bank accounts
			foreach ($activeBankAccounts as $key => $object) {
				Debug::debug(get_class(), "displayActiveBankAccountDuePaymentsInTable", "Foreach", 3);
				// get current bank accounts due payments from db
				$object->getDuePayments( $object );
				
				// get due payments to array
				$duePayments = $object->getTransactions();
				
				// if current BankAccount object has duePayments
				if (!empty($duePayments)) {
					Debug::debug(get_class(), "displayActiveBankAccountDuePaymentsInTable", "DuePayments is not empty", 4);
					// foreach accounts due payments array
					foreach ($duePayments as $dueKey => $dueObject) {
						Debug::debug(get_class(), "displayActiveBankAccountDuePaymentsInTable", "Foreach", 5);
						$rows = $rows +1;
						
						$archiveID = $dueObject->getArchiveID();
						$eventDate = $dueObject->getEventDate();
						$eventDate = Format::formatISODateToEUROFormat($eventDate);
						$recipientName = $dueObject->getRecipientName();
						$recipientBankAccount = $dueObject->getRecipientBankAccount();
						$payerName = $dueObject->getPayerName();
						$payerBankAccount = $dueObject->getPayerBankAccount();
						$currency = $dueObject->getCurrency();
						$sum = $dueObject->getSum();
						$referenceNumber = $dueObject->getReferenceNumber();
						$message = $dueObject->getMessage();
						$sumTotal = $sumTotal + $sum;
						
						$content .= "<tr";
								if ($rows%2 != 0) {
									$content .= " class='blueBg' ";
								}
								$content .= <<<EOT
								>
									<td>$eventDate</td>
										<td>$recipientName <br/>$recipientBankAccount</td>
										<td>$payerName <br/>$payerBankAccount</td>
										<td>$currency $sum </td>
										<td>$referenceNumber</td>
										<td>$message</td>
EOT;
						$content .= "<td>
											<form action='' method='post'>
												<p><input type='submit' name='deletePayment' value='". gettext('Delete') ."' />
												<input type='hidden' name='archiveID' value='". Crypt::encrypt($archiveID) ."' /></p>
											</form>	
										</td>
									</tr>";
					}
				}
			}
			$content .= "<tr>
							<td class='borderTop' colspan='2'></td>
							<td class='borderTop'>". gettext('Due payments total') ."</td>
							<td class='borderTop'>$currency ". sprintf("%01.2f", $sumTotal) ."</td>
							<td class='borderTop' colspan='3'></td>
						</tr>";
			$content .= "</table>
							</div><!-- /transactions -->";
		}
		
		Debug::debug(get_class(), "displayActiveBankAccountDuePaymentsInTable", "Return content $content");
		return $content;
	}
}
?>