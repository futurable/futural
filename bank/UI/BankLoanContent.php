<?php
/**
 *  BankLoanContent
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
 * BankLoanContent
 * Class for bank loan content (all active loans and their information)
 * 
 * @package   UI
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-22
 */
class BankLoanContent extends Content {
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * Display BankLoanContent in html.
	 * @see Content::doDisplayInHtml()
	 * 
	 * @access  protected
	 * @param   User       $userObject
	 * @return  string     $content
	 */
	protected function doDisplayInHtml( User $userObject ) {
		Debug::debug(get_class(), "doDisplayInHtml", "Start");
		
		$content = "<h1>". gettext('Bank loans') ."</h1>";
		
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
		
		Debug::debug(get_class(), "doDisplayInHtml", "Return content $content");
		return $content;
	}
	
	/**
	 * Displays business customers bank loan content in html.
	 * Helper method for doDisplayInHtml.
	 * 
	 * @access  private
	 * @param   User     $user
	 * @return  string   $content
	 */
	private function doDisplayBusinessCustomerContentInHtml( User $user ) {
		Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Start");
		
		// viewDetails has been pressed (2. step)
		if (isset($_POST[ 'viewDetails']) and $_POST[ 'viewDetails']) { 
			Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "ViewDetails has been pressed", 2);
			
			$IBAN = Crypt::decrypt($_POST[ 'loanIBAN' ]);
			$content = $this->displayLoanDetailsByIBAN( $IBAN );
		}
		// viewPaymentPlan has been pressed (2.step)
		else if (isset($_POST[ 'viewPaymentPlan']) and $_POST[ 'viewPaymentPlan']) {
			Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "ViewPaymentPlan has been pressed", 2);
			
			$IBAN = Crypt::decrypt($_POST[ 'loanIBAN' ]);
			$content = $this->displayLoanPaymentPlanByIBAN( $IBAN );
		}
		// user is first time in this page (1. step)
		else {
			Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Nothing has been pressed", 2);
			// get accepted loans
			$content = $this->displayActiveBankLoanAccounts( $user );
		}
		
		Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Return content $content");
		return $content;
	}
	
	/**
	 * Display active bank loan account information 
	 * (accept date, sum, IBAN and buttons for details and payment plan viewing).
	 * Helper method for doDisplayInHtml.
	 * 
	 * @access  private
	 * @param   User      $user
	 * @return  string    $content
	 */
	private function displayActiveBankLoanAccounts( User $user ) {
		Debug::debug(get_class(), "displayActiveBankLoanAccounts", "Start");
		$content = '';
		
		$activeBankLoanAccounts = $user->getActiveBankLoanAccounts();
		
		if (!empty($activeBankLoanAccounts)) {
			Debug::debug(get_class(), "displayActiveBankLoanAccounts", "ActiveBankLoanAccounts is not empty", 2);
			
			$content .= "<div id='transactions' class='margin20top'>
							<table>
								<tr class='bold'>
									<td>". gettext('Accept Date') ."</td>
									<td>". gettext('Sum') ."</td>
									<td>". gettext('Loan account IBAN') ."</td>
									<td>". gettext('Details') ."</td>
									<td>". gettext('Payment plan') ."</td>
								</tr>";
			
			$rows = 0;
			foreach ( $activeBankLoanAccounts as $key => $object ) {
				Debug::debug(get_class(), "displayActiveBankLoanAccounts", "Foreach", 3);
				$rows = $rows +1;
				
				// get loan details
				$loanDetails = $object->getBankLoanInfo();
				
				$acceptDate = $loanDetails->getAcceptDate();
				$acceptDateEURO = Format::formatISODateToEUROFormat($acceptDate);
				$loanIBAN = $object->getIBAN();
				$loanAmount = $loanDetails->getLoanAmount();
				
				$content .= "<tr";
							if ($rows%2 != 0) {
								$content .= " class='blueBg' ";
							}
							$content .= <<<EOT
							>
								<td>$acceptDateEURO</td>
								<td>$loanAmount</td>
								<td>$loanIBAN</td>
EOT;
					$content .= "<td>
										<form action='' method='post'>
											<p><input type='submit' name='viewDetails' value='". gettext('View') ."' />
											<input type='hidden' name='loanIBAN' value='". Crypt::encrypt($loanIBAN) ."' /></p>
										</form>	
									</td>
									<td>
										<form action='' method='post'>
											<p><input type='submit' name='viewPaymentPlan' value='". gettext('View') ."' />
											<input type='hidden' name='loanIBAN' value='". Crypt::encrypt($loanIBAN) ."' /></p>
										</form>	
									</td>
								</tr>";
			}
			$content .= "</table>
						</div><!-- /transactions -->";
		} else {
			Debug::debug(get_class(), "displayActiveBankLoanAccounts", "ActiveBankAccounts is empty", 2);
			$content = "<p>". gettext('You dont have bank loan accounts') ."</p>";
		}
		
		Debug::debug(get_class(), "displayActiveBankLoanAccounts", "Return content $content");
		return $content;
	}
	
	/**
	 * Display loan details by IBAN number.
	 * Helper method for doDisplayInHtml.
	 * 
	 * @access  private
	 * @param   string $IBAN
	 * @return  string $content
	 */
	private function displayLoanDetailsByIBAN( $IBAN ) {
		Debug::debug(get_class(), "displayLoanDetailsByIBAN", "Start");
		$content = '';
		
		if (DataValidator::isIBANValid( $IBAN )) {
			Debug::debug(get_class(), "displayLoanDetailsByIBAN", "IBAN is valid", 2);
			$loanAccount = new BankLoanAccount($IBAN);
			
			$loanAccount->dataMapper->fillBankLoanAccount($loanAccount);
			$loanInfo = $loanAccount->getBankLoanInfo();
			
			if (!empty($loanInfo)) {
				Debug::debug(get_class(), "displayLoanDetailsByIBAN", "LoanInfo is not empty", 2);
				// add loan info box to content
				$content .= $this->displayLoanInfoBox($loanInfo);
			}
			
			$loanAccount->dataMapper->fillTransactions( $loanAccount );
			$transactions = $loanAccount->getTransactions();
			
			if (!empty($transactions)) {
				Debug::debug(get_class(), "displayLoanDetailsByIBAN", "Transactions is not empty", 3);
				
				$content .= "<div id='transactions' class='margin20top'>
									<table>
										<tr class='bold'>
											<td>". gettext('Event Date') ."</td>
											<td>". gettext('Recipient name') ." /<br/>". gettext('Recipient bank account') ."</td>
											<td>". gettext('Payer name') ." /<br/>". gettext('Payer bank account') ."</td>
											<td>". gettext('Sum') ."</td>
											<td>". gettext('Message') ."</td>
										</tr>";
				
				$rows = 0;
				foreach ($transactions as $key => $Transaction) {
					Debug::debug(get_class(), "displayLoanDetailsByIBAN", "Foreach", 4);
					
					$rows = $rows + 1;
					$eventDate = $Transaction->getEventDate();
					$eventDate = Format::formatISODateToEUROFormat($eventDate);
					$recipientIBAN = $Transaction->getRecipientBankAccount();
					$recipientName = $Transaction->getRecipientName();
					$payerName = $Transaction->getPayerName();
					$payerBankAccount = $Transaction->getPayerBankAccount();
					$sum = $Transaction->getSum();
					$message = $Transaction->getMessage();
					
					$content .= "<tr";
					if ($rows%2 != 0) {
						$content .= " class='blueBg' ";
					}
					$content .= <<<EOT
					>
						<td>$eventDate</td>
						<td>$recipientName<br/>$recipientIBAN</td>
						<td>$payerName <br/> $payerBankAccount</td>
						<td>$sum</td>
						<td>$message</td>
					</tr>
EOT;
				}
				$content .= "</table>
							</div><!-- /transactions -->";
			} else {
				Debug::debug(get_class(), "displayLoanDetailsByIBAN", "Transactions is empty", 3);
				$content .= "<p class='margin20top bold'>". gettext('No transactions in this loan account yet') ."</p>";
			}
		}
		
		Debug::debug(get_class(), "displayLoanDetailsByIBAN", "Return content = $content");
		return $content;
	}
	
	/**
	 * Displays BankLoanInfo object details in html fieldset.
	 * Helper method for doDisplayInHtml.
	 * 
	 * @access private
	 * @param  BankLoanInfo $loanInfo
	 * @return string       $content
	 */
	private function displayLoanInfoBox( BankLoanInfo $loanInfo) {
		Debug::debug(get_class(), "displayLoanInfoBox", "Start");
		$loanTypes = $this->getLoanTypesInArray();
		
		$bankLoanAccount = $loanInfo->getLoanAccount();
		$bankLoanType = $loanTypes[ $loanInfo->getLoanType() ];
		$grantDate = $loanInfo->getGrantDate();
		$grantDate = Format::formatISODateToEUROFormat($grantDate);
		$acceptDate = $loanInfo->getAcceptDate();
		$acceptDate = Format::formatISODateToEUROFormat($acceptDate);
		$bankLoanSum = $loanInfo->getLoanAmount();
		$interestRate = number_format( $loanInfo->getInterestRate(), 3, '.', ' ');
		$interestMargin = number_format( $loanInfo->getInterestMargin(), 3, '.', ' ');
		$interestTotal = number_format( $interestRate + $interestMargin , 3, '.', ' ');
		
		$content = "<div class='info'>
						<fieldset>
							<label>". gettext('Bank loan account') ." </label>
							<span>$bankLoanAccount</span>
							<label>". gettext('Loan type') ." </label>
							<span>$bankLoanType</span>
							<label>". gettext('Grant date') ."</label>
							<span>$grantDate</span>
							<label>". gettext('Accept date') ."</label>
							<span>$acceptDate</span>
							<label>". gettext('Sum') ."</label>
							<span>$bankLoanSum</span>
							<label>". gettext('Interest rate') ."</label>
							<span>$interestRate</span>
							<label>". gettext('Interest margin') ."</label>
							<span>$interestMargin</span>
							<label>". gettext('Interest total') ."</label>
							<span>$interestTotal</span>
						</fieldset>
					</div>";
		
		return $content;
	}
	
	/**
	 * Displays specific loans payment plan in html table
	 * Helper method for doDisplayInHtml
	 * 
	 * @access private
	 * @param  string $IBAN
	 * @return string $content
	 */
	private function displayLoanPaymentPlanByIBAN( $IBAN ) {
		Debug::debug(get_class(), "displayLoanPaymentPlanByIBAN", "Start");
		$content = '';
		
		if (DataValidator::isIBANValid($IBAN)) {
			$loanAccount = new BankLoanAccount($IBAN);
		
			$loanAccount->dataMapper->fillBankLoanAccount($loanAccount);
			$loanInfo = $loanAccount->getBankLoanInfo();
			
			if (!empty($loanInfo)) {
				Debug::debug(get_class(), "displayLoanPaymentPlanByIBAN", "LoanInfo is not empty", 2);
				$content .= $this->displayLoanInfoBox($loanInfo);
			
				// Get loan repayment plan
				$loanRepayments = $this->getLoanRepaymentPlansInArray($loanInfo);
				
				if (!empty($loanRepayments)) {
					Debug::debug(get_class(), "displayLoanPaymentPlanByIBAN", "LoanRepayments is not empty" , 3);
					// Show payment plan
					$content .= "<table class='margin20top'>
									<tr>
										<th>#</th>
										<th>".gettext('Instalment')."</th>
										<th>".gettext('Interest')."</th>
										<th>".gettext('Repayment')."</th>
										<th>".gettext('Principal')."</th>
									</tr>
									";
					
					foreach($loanRepayments as $loanRepayment){
						Debug::debug(get_class(), "displayLoanPaymentPlanByIBAN", "Foreach", 4);
						
						static $number = 0;
						$number++;
						
						if($number%2==1) $content .= "<tr class='blueBg'>";
						else $content .= "<tr>";
						
						$content .= "
									<td>$number</td>
									<td>".number_format($loanRepayment['instalment'], 2, '.', ' ')."</td>
									<td>".number_format($loanRepayment['interest'], 2, '.', ' ')."</td>
									<td>".number_format($loanRepayment['repayment'], 2, '.', ' ')."</td>
									<td>".number_format($loanRepayment['remaining'], 2, '.', ' ')."</td>
								</tr>";
					}
					
					$content .= "</table>";
				}
			}
		}
		
		Debug::debug(get_class(), "displayLoanPaymentPlanByIBAN", "Return content $content");
		return $content;
	}
	
	/**
	 * Display loan repayment plan in html array
	 * 
	 * @access private
	 * @param  LoanInfo $loanInfo
	 * @return array    $loanRepaymentPlans
	 */
	private function getLoanRepaymentPlansInArray(BankLoanInfo $loanInfo){
		Debug::debug(get_class(), "getLoanRepaymentPlansInArray", "Start");
		$loanRepaymentPlans = array();
		
		// Format variables
		$interestRate = $loanInfo->getInterestRate();
		$interestMargin = $loanInfo->getInterestMargin();
		$interestType = $loanInfo->getInterestType(); 
		$loanType = $loanInfo->getLoanType();
		$loanAmount = $loanInfo->getLoanAmount();
		$loanTerm = $loanInfo->getLoanTerm();
		$instalment = $loanInfo->getInstalment();
		$repayment = $loanInfo->getRepayment();
		$repaymentInterval = $loanInfo->getRepaymentInterval();
		$acceptDate = $loanInfo->getAcceptDate();
		
		$loanRemaining = $loanAmount;
		$paidLoan = 0;
		
		// Get the loan interval time in days
		switch($repaymentInterval):
			case 'day':
				$time = 1;
				break;
			case 'week':
				$time = 7;
				break;
			case 'month':
				$time = 30;
				break;
		endswitch;
		
		// Take leap year into account creating denominator
		$denominator = 100 * 365 + date('L');
		
		// Count loan repayments
		// Annuity
		if($loanType == 'annuity'){
			
				// Interest rate for loan term
				$interestTotal = $interestRate + $interestMargin;
				$interestTotal = $interestTotal / ( $denominator / 100 * ( $loanTerm * $time ) );
				
				$interestFactor = 1 + ( ($interestTotal) / 100 );
				$numerator = pow( $interestFactor, $loanTerm) * ( $interestTotal ) / 100;
				$delimiter =  pow( $interestFactor, $loanTerm) - 1;
				
				$annuity = $numerator / $delimiter * $loanAmount;
				//$annuity = $annuity / $denominator / 100 * ($loanTerm * $time ); 
				
				// The whole loan to be paid
				$paidLoan = $loanTerm * $annuity;
				$interestAmount = $paidLoan - $loanAmount;
				
				$interest = $interestAmount / $loanTerm;
				$instalment = $annuity - $interest;
				$repayment = $annuity;
					
				for($i=1; $i<=$loanTerm; $i++){
					
					if($repayment > $loanRemaining) $instalment = $loanRemaining;
					$loanRemaining -= $instalment;
					
					$loanRepaymentPlans[] = array(	"instalment" => $instalment
													, "interest" => $interest
													, "repayment" => $repayment
													, "remaining" => $loanRemaining );
				}
				
				return $loanRepaymentPlans;
		} else {
			while($loanRemaining > 0){
				static $i = 0;
				$i++;
				// Break if too many repayments
				if($i>360) break;
				
				$interest = ( $loanRemaining * ( $interestRate + $interestMargin ) * $time ) / $denominator;
				
				// Fixed instalment
				if($loanType == 'fixedInstalment'){
					$repayment = $instalment + $interest;
				}
				// Fixed repayment
				elseif($loanType == 'fixedRepayment'){
					$instalment = $repayment - $interest;
				}
				
				if($repayment > $loanRemaining) $instalment = $loanRemaining;
			
				$repayment = $instalment + $interest;
				
				$loanRemaining -= $instalment;
				$paidLoan += $repayment;
				
				$loanRepaymentPlans[] = array(	"instalment" => $instalment
												, "interest" => $interest
												, "repayment" => $repayment
												, "remaining" => $loanRemaining );
												
			}
			
			return $loanRepaymentPlans;
		}
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
	
	private function doDisplayInstructorContentInHtml( User $user ) {
		Debug::debug(get_class(), "doDisplayInstructorContentInHtml", "Start");
		// TODO: Instructor content
	}
}

?>