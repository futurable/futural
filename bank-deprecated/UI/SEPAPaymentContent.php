<?php
/**
 *  SEPAPaymentsContent.php
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

require_once 'Model/SEPAPayment.php';

/**
 * SEPAPaymentsContent.php
 * Class for displaying page contents for SEPA-payments content
 * 
 * @package   UI
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-04-25
 */

class SEPAPaymentContent extends Content {
	
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
		
		$content = "<h1>". gettext('SEPA payments') ."</h1>";
		
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
	 * Get HTML-formatted content for admins
	 * 
	 * @access  private
	 * @return  mixed   $content
	 */
	private function doDisplayAdminContentInHtml( User $user ) {
		Debug::debug(get_class(), "doDisplayAdminContentInHtml", "Start");

		// Not in use
		return false;
	}
	
	/**
	 * Get HTML-formatted content for business customers
	 * 
	 * @access  private
	 * @return  mixed   $content
	 */
	private function doDisplayBusinessCustomerContentInHtml( User $user ) {
		Debug::debug(get_class(), "doDisplayAdminContentInHtml", "Start");
			
		// Display SEPA-file upload
		$SEPAUL = "<p>".gettext('Create payments from SEPA-formatted XML-file').":</p>";
		
		$SEPAUL .= "<form action='' method='post' enctype='multipart/form-data'>
						<p><label for='SEPAFile'>Upload file:</label>
						<input type='file' name='SEPAFile' id='SEPAFile' />
						<input type='submit' name='saveSEPAPayments' value='".gettext('Create transactions')."' /></p>
					</form>";

		// User has uploaded a file
		if(!empty($_FILES["SEPAFile"])){
			if ($_FILES["SEPAFile"]["error"] > 0) {
			  	$errors[] = gettext('No file selected.');
			}
			elseif ( $_FILES["SEPAFile"]["type"] == "text/xml" && $_FILES["SEPAFile"]["size"] < 20000 ) {
				$errors = $this->createSEPAPaymentsFromFile( $user, $_FILES["SEPAFile"]["tmp_name"] );
			}
			else {
				$errors[] = gettext('You can only upload valid XML-formatted SEPA payments');
			}
		}
		
		if(isset($errors)){
			foreach($errors as $error){
				$SEPAUL .= "<p class='incorrect'>$error</p>\n";
			}
		}
		
		if(isset($_POST['saveSEPAPayments']) && empty($errors) ){
			$SEPAUL .= "<p>".gettext("Payments saved.")."</p>";
		}
		
		// Display SEPA-file download
		$SEPADL = "<br/><p>".gettext('Download bank statement in SEPA-format').":</p>";
		$SEPADL .= "<form action='' method='post' enctype='multipart/form-data'>";
		$SEPADL .= "<p><input type='submit' name='getBankStatement' value='".gettext('Download statement')."'/></p>";
		$SEPADL .= "</form>";
		
		if(isset($_POST['getBankStatement'])){
			$SEPADL .= $this->createBankToCustomerSEPAFile($user);
		}
			
		$content = $SEPAUL.$SEPADL; 
		
		return $content;
	}
	
	/**
	 * Get HTML-formatted content for instructors
	 * 
	 * @access  private
	 * @return  mixed   $content
	 */
	private function doDisplayInstructorContentInHtml( User $user ) {
		Debug::debug(get_class(), "doDisplayAdminContentInHtml", "Start");

		// Not in use
		return false;
	}
	
	/**
	 * Create SEPA payments from XML-formatted SEPA-file
	 * @access 	private
	 * @param	User	$user			
	 * @param	mixed	$paymentsFile	SEPA payments file
	 * @return	array 	$errors			Return empty array on success
	 */
	private function createSEPAPaymentsFromFile( User $user, $paymentsFile){
		$SEPAPayments = simplexml_load_file( $paymentsFile );
		
		foreach ($SEPAPayments->children() as $pain) {
			$GrpHdr = $pain->GrpHdr; // Group header info
			$PmtInf = $pain->PmtInf; // Payment info
			$errors = array();
			
			/* 
			 * Fill needed information for transaction
			 * and check permissions
			 */
			$TransactionContent = array();
			$TransactionContent['author'] = $user->getId();
			
			$UserBankAccounts = $user->getActiveBankAccounts();

			// Check if BIC is correct
			if( $PmtInf->DbtrAgt->FinInstnId->BIC != $UserBankAccounts[0]->getBIC() ){
				$errors[] = gettext("The SEPA payment data you gave is for another bank.");
			}
			
			// Check if user owns the account used for paying
			$UserIBANS = array();
			foreach($UserBankAccounts as $UserBankAccount){
				$UserIBANS[] = $UserBankAccount->getIBAN();
			}
			
			if( in_array( $PmtInf->DbtrAcct->Id->IBAN, $UserIBANS ) ){
				$TransactionContent['payerBankAccount'] = (string)$PmtInf->DbtrAcct->Id->IBAN;
			}
			else{
				$errors[] = gettext("You can only make payments from accounts you own.");
			}
			$TransactionContent['payerName'] = (string)$PmtInf->Dbtr->Nm;
			// If given date is valid and not yet passed, use it as event date. Else use now
			if( DataValidator::isDateISOSyntaxValid($PmtInf->ReqdExctnDt) && strtotime($PmtInf->ReqdExctnDt)>time() ){
				$TransactionContent['eventDate'] = (string)$PmtInf->ReqdExctnDt;
			}
			else {
				$TransactionContent['eventDate'] = date('Y-m-d');
			}
			// Set currency
			// TODO: fetch currency
			$TransactionContent['currencyRate'] = 1;
			$TransactionContent['currency'] = 'EUR';
			
			// Make transactions for each payment
			$tmperr = array();
			foreach( $PmtInf->{'CdtTrfTxInf'} as $Pmt ){
				if( $Pmt->CdtrAgt->FinInstnId->BIC != $UserBankAccounts[0]->getBIC() ){
					$errors[] = gettext("External payments are not yet supported.")." ".gettext("Sorry for the inconvenience.");
				}
				
				$TransactionContent['archiveID'] =  uniqid('FUTUB');
				$TransactionContent['recipientBankAccount'] = (string)$Pmt->CdtrAcct->Id->IBAN;
				$TransactionContent['recipientName'] = (string)$Pmt->Cdtr->Nm;
				
				// Check currency
				// TODO: make support for other currencies
				if($Pmt->Amt->InstdAmt->attributes()->Ccy == "EUR"){
					$TransactionContent['sum'] = (string)$Pmt->Amt->InstdAmt;
				} 
				else {
					$errors[] = gettext("Only Euro payments are supported.")." ".gettext("Sorry for the inconvenience.");		
				}
				
				// Set reference number of message
				if( isset( $Pmt->RmtInf->Strd->CdtrRefInf->CdtrRef ) ){
					$TransactionContent['referenceNumber'] = (string)$Pmt->RmtInf->Strd->CdtrRefInf->CdtrRef;
				}
				elseif( isset( $Pmt->RmtInf->Ustrd ) ){
					$TransactionContent['message'] = (string)$Pmt->RmtInf->Ustrd;
				}

				if( empty($errors) ){
					$BankTransaction = new BankTransAction(); 
					$BankTransaction->fillObjectFromArray( $BankTransaction, $TransactionContent );
					$BankTransaction->dataMapper->begin();
					$successful = $BankTransaction->dataMapper->save( $BankTransaction );
					if($successful) $BankTransaction->dataMapper->commit();
					else{
						$BankTransaction->dataMapper->rollback();
						$PmtId = $Pmt->PmtId->InstrId;
						$tmperr[] = gettext("Payment ID")." '$PmtId' ".gettext("is invalid and was not saved.");
					}
				}
				else{
					$errors[] = gettext("You have errors in you payment data. No transactions were made.");
				}
				
				// Unset variables set inside the loop to be safe
				unset($TransactionContent['archiveID']);
				unset($TransactionContent['recipientBankAccount']);
				unset($TransactionContent['recipientName']);
				unset($TransactionContent['sum']);
				unset($TransactionContent['referenceNumber']);
				unset($TransactionContent['message']);
			}
			$errors = array_merge($errors, $tmperr);
			
			return $errors;
		}
	}

	/**
	 * @access private
	 * @param 	User 	$user
	 * @return	mixed	$SEPAfile
	 */
	private function createBankToCustomerSEPAFile(User $user){
		$userBankAccounts = $user->getActiveBankAccountNumbers();
		
		// TODO: ask camt type
		$camtType = 'camt053';
		
		foreach($userBankAccounts AS $userBankAccount){
			$bankAccount = $user->getOneBankAccountByIBAN( $userBankAccount );
			$SEPAPayment = new SepaPayment($user, $bankAccount, $camtType);
	
			$SEPAPayment->getDocumentAsXML();
			$this->saveXMLHeader($SEPAPayment);
		}
	}
	
	private function saveXMLHeader($SEPAPayment){
		$successful = false;
		
		// Start transaction
		$SEPAPayment->dataMapper->begin();
		
		// Lock table so we don't get duplicate sequence numbers
		@mysql_query("LOCK TABLES BankSEPAFiles, BankTransactionCollect WRITE;");
		
		if($SEPAPayment instanceof SEPAPayment ) {
			$successful = $SEPAPayment->dataMapper->save( $SEPAPayment );
		}
		if ($successful === true) {
			Debug::debug(get_class(), "saveXMLHeader", "Successful = $successful, commit", 2);
			$SEPAPayment->dataMapper->commit();
		} else {
			Debug::debug(get_class(), "saveXMLHeader", "Successful = $successful, rollback", 2);
			$SEPAPayment->dataMapper->rollback();
		}
		
		// Unlock table
		@mysql_query("UNLOCK TABLES;");
		
		return $successful;
	}
}