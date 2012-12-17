<?php
/**
 *  BankLoanApplicationContent.php
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

require_once 'Model/BankLoanInfo.php';
require_once 'CommonServices/Crypt.php';

/**
 * BankLoanApplicationContent.php
 * Class for loan application content
 * 
 * @package   UI
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-11-07
 */
class BankLoanApplicationContent extends Content {
	public function __construct(){
		parent::__construct();
	}
	
	public function doDisplayInHtml( User $userObject ) {
		Debug::debug(get_class(), "doDisplayInHtml", "Start");
		
		// check user role
		$userRole = $userObject->getRole();
		
		// Get required loan variables
		$variables = $this->getLoanVariables();
		foreach($variables as $key => $value){
			${$key} = $value;
		}
		
		$repaymentIntervalTextsJSON = json_encode($repaymentIntervalTexts);
		$content = "<script type=\"text/javascript\">var repaymentIntervalTexts = jQuery.parseJSON('$repaymentIntervalTextsJSON')</script>";
		$content .= '<script type="text/javascript" src="js/BankLoanApplication.js"></script>';
		
		if ( strcmp(trim($userRole), 'opiskelija') === 0 ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Profil = $userRole", 2);
			// Student role content
			$content .= $this->doDisplayBusinessCustomerContentInHtml( $userObject );
		
		} else if ( strcmp(trim($userRole), 'Admin profil') === 0 ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Profil = $userRole", 2);
			// Admin role content
			$content .= $this->doDisplayAdminContentInHtml( $userObject );
			
		}
		
		return $content;
	}

	/** Applicating a new loan
	 *
	 *	1.0 Current loan applications overview
	 *		1.1 Loan application overview
	 *			-> Go to 2.1
	 *	2.0 New loan application
	 *		2.1 Loan amount, interest type, repayment interval
	 *			-> On successful data validation go to 2.2, else go to 2.1
	 *		2.2. Repayment, instalment or loan term (depending on interest type)
	 *			-> On successful data validation go to 3.1, else go to 2.2
	 *	3.0 New loan application overview
	 *		3.1 Loan application overview
	 *			-> On successful data validation go to 4.1, else error
	 *	4.0 Save new loan application
	 *		4.1 Save loan application
	 */
	
	/**
	 * Get HTML-formatted content for business customers
	 * 
	 * @access  private
	 * @return  mixed   $content
	 */
	private function doDisplayBusinessCustomerContentInHtml( User $user ) {
		Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Start");
		
		$content = "<h1>".gettext('Loan applications')."</h1>";
			
		if(isset($loanStatusUpdate)){
			$content .= "<p>$loanStatusUpdate</p>";
		}
		
		/** 1.0 Current loan applications overview **/
		if( !isset($_POST['newLoanApplication']) || isset($_POST['cancel']) ){
			// 1.1 Loan application overview
			$content .= $this->displayLoanApplicationStatusInHTMLFormat($user);
			$content .= "<div class='floatRight'><p><form action='' method='post' id='newLoanApplicationForm' name='newLoanApplicationForm'>
							<input type='submit' name='newLoanApplication' value='".gettext('Make a new loan application')."' />
						</form></p></div>";
		}
		/** 2.0 New loan application **/
		elseif( isset($_POST['newLoanApplication']) and !empty($_POST['newLoanApplication']) ){
			Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "POST has no checkLoanApplication variable.", 2);
			
			// Form for loan application
			$loanApplication = new BankLoanInfo();
			$form = $this->displayLoanApplicationFormUsingObject($user, $loanApplication);
			$loanCounter = $this->displayLoanCounterFrame();
			$paymentPlan = $this->displayPaymentPlanFrame();
		
			/** 3.0 New loan application overview **/
			if (isset($_POST[ 'checkLoanApplication' ]) and $_POST[ 'checkLoanApplication' ]) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "POST has checkLoanApplication variable.", 2);
			
				$loanApplication->fillObjectFromArray ( $loanApplication, $_POST );
				$validated = $loanApplication->validateBankLoanInfo();
				if($validated === true){
					$form = $this->displayLoanApplicationInformationUsingObject($loanApplication);
				}
				else{
					$form = $this->displayLoanApplicationFormUsingObject($user, $loanApplication, $validated);
				}
			}
			
			$content = '<script type="text/javascript" src="js/BankLoanApplicationLoanCounter.js"></script>';
			$content .= $form;
			$content .= $loanCounter.$paymentPlan;
		}
		/*
		// Display new loan application
		if( isset($_POST['newLoanApplication']) AND !empty($_POST['newLoanApplication']) AND !isset($_POST['cancel']) ){
			// Create loan application object
			$loanApplication = new BankLoanInfo();
			
			// Display loan application summary
			if (isset($_POST[ 'checkLoanApplication' ]) && $_POST[ 'checkLoanApplication' ]) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "POST has checkLoanApplication variable.", 2);
				
				$loanApplication->fillObjectFromArray ( $loanApplication, $_POST );
				$validated = $loanApplication->validateBankLoanInfo();
				if($validated === true){
					$form = $this->displayLoanApplicationInformationUsingObject($loanApplication);
				}
				else{
					$form = $this->displayLoanApplicationInformationUsingObject($loanApplication, $validated);
				}
				
				$content = $form;
			}
			// Save loan application
			else if (isset($_POST[ 'saveLoanApplication' ]) and $_POST[ 'saveLoanApplication' ] ) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "saveLoanApplication button is pressed", 2);
				$content = $this->displaySaveLoanApplication();
			}
			// Display new loan application
			else {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "POST has no checkLoanApplication variable.", 2);
				
				// Form for loan application
				$form = $this->displayLoanApplicationFormUsingObject($user, $loanApplication);
				
				$content = $form;
			}
		}
		// Display all loan applications
		else{
			// User requested deletion of the loan application
			if(isset($_POST['deleteLoan']) && isset($_POST['loanID'])){
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Deleting loan", 3);
				$loanID = Crypt::decrypt($_POST['loanID']);
				
				$loanApplication = new BankLoanInfo();
				$loanApplication->setLoanID($loanID);
				$loanApplication->setStatus('removed');
				
				// Save new status
				$successful = $loanApplication->dataMapper->update( $loanApplication );
				
				if($successful === true) $loanStatusUpdate = gettext('The loan application deleted succesfully');
				else $loanStatusUpdate = gettext('Error while deleting the loan application.')."<br/>".gettext('Please try again later');
			}
			// User requested declination of the loan application
			if(isset($_POST['declineLoan']) && isset($_POST['loanID'])){
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Declining loan", 3);
				$loanID = Crypt::decrypt($_POST['loanID']);
				
				$loanApplication = new BankLoanInfo();
				$loanApplication->setLoanID($loanID);
				$loanApplication->setStatus('declined');
				
				// Save new status
				$successful = $loanApplication->dataMapper->update( $loanApplication );
				
				if($successful === true) $loanStatusUpdate = gettext('The loan application declined succesfully');
				else $loanStatusUpdate = gettext('Error while declining the loan application.')."<br/>".gettext('Please try again later');
			}
			// User requested acception of the loan application
			if(isset($_POST['acceptLoan']) && isset($_POST['loanID'])){
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Accepting loan", 3);
				$loanID = Crypt::decrypt($_POST['loanID']);
				
				$loanApplication = new BankLoanInfo();
				$loanApplication->setLoanID($loanID);
				$loanApplication->setStatus('active');
				
				// Save new status
				$successful = $loanApplication->dataMapper->update( $loanApplication );
				
				if($successful === true) $loanStatusUpdate = gettext('Loan application accepted succesfully');
				else $loanStatusUpdate = gettext('Error while accepting loan application.')."<br/>".gettext('Please try again later');
			}
		*/
			
		return $content;
	}
	
	/**
	 * Get HTML-formatted content for admins
	 * 
	 * @access  private
	 * @return  mixed   $content
	 */
	private function doDisplayAdminContentInHtml( User $user ) {
		$content = "<p>".gettext('Admin loan applications view').".</p>";
		return $content;
	}
	
	/**
	 * Get HTML-formatted loan application form
	 * 
	 * @access  private
	 * @param	User	$user
	 * @return  mixed   $form
	 */
	private function displayLoanApplicationFormUsingObject(User $user, BankLoanInfo $bankLoanInfo, $errors = false){
		
		$form = "<h1>".gettext("New loan application")."</h1>";
		
		$form .= "
		<div class='form' id='loanApplicationDiv'>
			<form action='' method='post' id='loanApplicationForm'>
				<fieldset>
					<legend>".gettext("Make a loan application")."</legend>";
		
		// Get required arrays
		$variables = $this->getLoanVariables();
		foreach($variables as $key => $value){
			${$key} = $value;
		}
		
		$errors = (isset($errors) AND !empty($errors) AND is_array($errors)) ? $errors : array();
		
		// Create form
		$form .= $this->getFormHiddenInputField('userId', $user->getId() );
		$form .= $this->getFormHiddenInputField('loanApplicant', $user->getCompany() );
		$form .= $this->getFormHiddenInputField('newLoanApplication', "true" );
		
		// Repayment
		$form .= $this->getFormInputElement( gettext("Amount of loan"), "loanAmount", gettext("Insert the amount of the loan you want to apply"), $errors);
		// Loan type
		$form .= $this->getFormSelectElement( gettext("Loan type"), $loanTypes, "loanType", gettext("Select the loan repayment type"), $errors );
		// Loan repayment
		$form .= $this->getFormInputElement( gettext('Repayment'), 'repayment', gettext("Select the repayment amount"), $errors );
		// Loan instalment
		$form .= $this->getFormInputElement( gettext('Instalment'), 'instalment', gettext("Select the instalment amount"), $errors );
		// Loan term
		$form .= "<div class='loanTermSelect'>";
		$form .= $this->getFormSelectElement( gettext("Loan term"), $loanTerms, 'loanTerm', gettext("Select the loan length"), $errors );
		$form .= $this->getFormSelectElement( gettext("Loan term"), $repaymentIntervalTexts, 'loanTermUnit', gettext("Select the loan length"), $errors );
		$form .= "</div><!-- / loanTermSelect -->";
		// Loan repayment interval
		$form .= $this->getFormSelectElement( gettext("Interval of repayment"), $repaymentIntervals, "repaymentInterval", gettext("Select how often you would like to make repayments"), $errors );
		// Interest type
		$form .= $this->getFormSelectElement( gettext("Interest type"), $interestTypes, "interestType", gettext("Select the interest type you want to use"), $errors );
		
		$form .= "
				</fieldset>
					<div class='floatRight'><p>
						<input type='submit' value='".gettext('Cancel')."' name='cancel' />
						<input type='submit' value='".gettext('Continue')."' name='checkLoanApplication' />
					</p></div>
			</form>
		</div><!-- /form -->";
		
		return $form;
	}
	
	/**
	 * Get HTML-formatted loan application summary
	 * 
	 * @access  private
	 * @param 	BankLoanInfo $object
	 * @param	string	$errors
	 * @return  mixed   $form
	 */
	private function displayLoanApplicationInformationUsingObject(BankLoanInfo $object){
		// Create loan ID
		$loanID = uniqid('FUTUB');
		
		// Get required arrays
		$variables = $this->getLoanVariables();
		foreach($variables as $key => $value){
			${$key} = $value;
		}
		
		// Loan term description
		switch( $object->getRepaymentInterval() ){
			case 'day':
				$loanTermDescription = gettext('days');
				break;
			case 'week':
				$loanTermDescription = gettext('weeks');
				break;
			case 'month':	
				$loanTermDescription = gettext('months');
				break;
			default:
				$loanTermDescription = null;
		}
		
		$errorArray = (isset($errorArray) AND !empty($errorArray) AND is_array($errorArray)) ? $errorArray : array();
		
		$form = "
		<div id='form'>
			<form action='' method='post'>
				<fieldset>
					<legend>".gettext("Confirm loan application information")."</legend>";
		
			// Hidden fields
			$form .= $this->getFormHiddenInputField( 'userId', $object->getAuthor() );
			$form .= $this->getFormHiddenInputField( 'loanApplicant', $object->getLoanApplicant() );
			$form .= $this->getFormHiddenInputField( 'loanID', $loanID );
			$form .= $this->getFormHiddenInputField( 'newLoanApplication', "true" );
			
			$form .= $this->getFormHiddenInputField('loanAmount', $object->getLoanAmount() );
			$form .= $this->getFormLabelField(gettext('Amount of loan'), number_format( $object->getLoanAmount(), 2, ",", " " )." &euro;" , 'loanAmount');
			
			$form .= $this->getFormHiddenInputField('loanType', $object->getLoanType());
			$form .= $this->getFormLabelField(gettext('Loan type'), $loanTypes[ $object->getLoanType() ], 'loanType');
			
			if($object->getRepayment() > 0){
				$form .= $this->getFormHiddenInputField('repayment', $object->getRepayment());
				$form .= $this->getFormLabelField(gettext('Repayment'), number_format( $object->getRepayment(), 2, ",", " " )." &euro;" , 'repayment');
			}

			if($object->getInstalment() > 0){
				$form .= $this->getFormHiddenInputField('instalment', $object->getInstalment());
				$form .= $this->getFormLabelField(gettext('Instalment'), number_format( $object->getInstalment(), 2, ",", " " )." &euro;" , 'instalment');
			}
			
			$form .= $this->getFormHiddenInputField('repaymentInterval', $object->getRepaymentInterval());
			$form .= $this->getFormLabelField(gettext('Interval of repayment'), $repaymentIntervals[ $object->getRepaymentInterval() ], 'repaymentInterval');
			
			if($object->getLoanTerm()){
				$form .= "<div id='loanTermFields'>";
				$form .= $this->getFormHiddenInputField('loanTerm', $object->getLoanTerm());
				$form .= $this->getFormLabelField(gettext('Loan Term'), $object->getLoanTerm(), 'loanTerm');
				$form .= "<span id='loanTermDescription'>$loanTermDescription</span></div><!-- / loanTermFields--><span id='loanTermWarning' class='incorrect'></span>";
			}
				
			$form .= $this->getFormHiddenInputField('interestType', $object->getInterestType());
			$form .= $this->getFormLabelField(gettext('Interest type'), $interestTypes[ $object->getInterestType() ], 'interestType');			
		
		$form .= "
				</fieldset>
					<div class='floatRight'><p>
						<input type='submit' value='".gettext('Modify')."' name='modify' />
						<input type='submit' value='".gettext('Confirm')."' name='saveLoanApplication' />
					</p></div>
			</form>
		</div><!-- /form -->";
		return $form;
	}

	/**
	 * Save loan application
	 * 
	 * @access  private
	 * @return  mixed   $form
	 */
	private function displaySaveLoanApplication() {
		Debug::debug(get_class(), "displaySaveLoanApplication", "Start");
		$content = NULL;
		$loanApplication = new BankLoanInfo();
		$loanApplication->fillObjectFromArray( $loanApplication, $_POST );
		
		// Save loan application
		$successful = $loanApplication->dataMapper->save( $loanApplication );
		
		if ($successful === true) {
			Debug::debug(get_class(), "displaySaveLoanApplication", "Successful = $successful", 2);
			$content = "<p>".gettext('Loan application is saved.')."</p>
						<p><a href='?page=LoanApplication'>".gettext('Go to loan applications')."</a> ".gettext('or')." <a href='Index.php'>".gettext('return to front page')."</a></p>";
		} else {
			Debug::debug(get_class(), "displaySaveLoanApplication", "Saving loan application not successful", 2);
			$content = "<p>".gettext('An error occured! Please try again in a moment.')."</p>";
		}
		
		Debug::debug(get_class(), "displaySaveLoanApplication", "Return content = $content");
		return $content;
	}

	/**
	 * Get all loan applications in HTML-formatted table
	 * 
	 * @access  private
	 * @param	User	$user
	 * @return  mixed   $form
	 */
	private function displayLoanApplicationStatusInHTMLFormat(User $user){
		Debug::debug(get_class(), "displayLoanApplicationStatusInHTMLFormat", "Start");
		// Get loan applications in array
		$user->fillCustomerLoanApplications();
		$loanApplicationArray = $user->getLoanApplications();
		
		if( count($loanApplicationArray) > 0){
			Debug::debug(get_class(), "displayLoanApplicationStatusInHTMLFormat", "Loan applications found", 2);
			// Get required arrays
			$variables = $this->getLoanVariables();
			foreach($variables as $key => $value){
				${$key} = $value;
			}
			
			$table = "
				<table>
					<tr>
						<th>".gettext('Amount of loan')."</th>
						<th>".gettext('Loan type')."</th>
						<th>".gettext('Repayment info')."</th>
						<th>".gettext('Interest type')."</th>
						<th>".gettext('Repayment interval')."</th>
						<th>".gettext('Loan term')."</th>
						<th>".gettext('Loan status')."</th>
					</tr>";
			
			foreach($loanApplicationArray as $key => $object){
				$loanAmount = number_format($object->getLoanAmount(), 2, ',', ' ')." &euro;";
				$loanType = $loanTypes[ $object->getLoanType() ];
				$interestType = $interestTypes[ $object->getInterestType() ];
				$repaymentInterval = $repaymentIntervals[ $object->getRepaymentInterval() ];
				$loanStatus = $loanStatusArray[ $object->getStatus() ];
				$loanTerm = $object->getLoanTerm()." ";
				
				// Get loan type -spesific information
				switch($object->getLoanType()){
					case 'fixedRepayment':
						$loanTypeInfo = number_format($object->getRepayment(), 2, ',', ' ')." &euro;";
						break;
					case 'fixedInstalment':
						$loanTypeInfo = number_format($object->getInstalment(), 2, ',', ' ')." &euro;";
						break;
					case 'annuity':
						$loanTypeInfo = $object->getEndDate();
						break;
				}
				
				if($loanTerm > 0){
					// Get loan term -spesific information
					switch($object->getRepaymentInterval()){
						case 'day':
							$loanTerm .= gettext('days');
							break;
						case 'week':
							$loanTerm .= gettext('weeks');
							break;
						case 'month':
							$loanTerm .= gettext('months');
							break;
					}
				}
				
				// Crypt loan ID
				$cryptedID = Crypt::encrypt($object->getLoanID());
				$tempStatus = $object->getStatus()."Status";
				
				// Remove-button for loans
				if( $object->getStatus() == 'open' || $object->getStatus() == 'denied' ){
					
					$removeForm = "
						<form action='' method='post'>
							<p>
							<input type='hidden' name='loanID' value='$cryptedID'/>
							<input type='submit' class='deleteLoan' name='deleteLoan' value='".gettext('Delete')."' />
							</p>
						</form>";
					
					$loanStatus = "<span class='$tempStatus'>$loanStatus</span> $removeForm";
				}
				// Buttons for accepting or declining granted loan
				elseif( $object->getStatus() == 'granted' ){
					
					$acceptForm = "
						<form action='' method='post'>
							<p>
							<input type='hidden' name='loanID' value='$cryptedID'/>
							<input type='submit' name='acceptLoan' class='acceptLoan' value='".gettext('Accept')."' />
							<input type='submit' name='declineLoan' class='declineLoan' value='".gettext('Decline')."' />
							</p>
						</form>";
					
					$loanStatus = "<span class='$tempStatus'>$loanStatus</span> $acceptForm";
				}
				
				$table .= "
					<tr>
						<td>$loanAmount</td>
						<td>$loanType</td>
						<td>$loanTypeInfo</td>
						<td>$interestType</td>
						<td>$repaymentInterval</td>
						<td>$loanTerm</td>
						<td>$loanStatus</td>
					</tr>";
			}
			$table .= "</table>";
			
			return $table;
		}
		// No loan applications found
		else {
			Debug::debug(get_class(), "displayLoanApplicationStatusInHTMLFormat", "Loan applications not found", 2);
			$return = "<p>".gettext('No open loan applications').".<br/></p>";
			
			return $return;
		}
	}
	
	/**
	 * Get frame for jquery loan counter
	 */
	private function displayLoanCounterFrame(){
		$frame = "
		<div id='loanCounterFrame'>
			<div id='loanCounter'>
				<h3>".gettext("Loan counter")."</h3>
				<table id='loanCounterTable'>
						<tr>
							<th>".gettext("Loan amount")."</th>
							<th>".gettext("Interest")."</th>
							<th>".gettext("Real Amount")."</th>
							<th>".gettext("Instalment")."</th>
							<th>".gettext("Loan term")."</th>
						</tr>
						<tr>
							<td id='loanAmountTd'>0</td>
							<td id='interestAmountTd'>0</td>
							<td id='realAmountTd'>0</td>
							<td id='repaymentTd'>0</td>
							<td id='termTd'>0</td>
						</tr>
				</table>	
			</div><!-- / loanCounter-->
		</div><!-- / loanCounterFrame-->";
	
		return $frame;
	}
	
	/**
	 * Get frame for jquery payment plan
	 */
	private function displayPaymentPlanFrame(){
		$frame = "
		<div id='paymentPlanFrame'>
			<div id='paymentPlan'>
				<h3>".gettext("Payment plan")."</h3>
				<table id='paymentPlanTable'>
						<tr>
							<th>#</th>
							<th>".gettext("Instalment")."</th>
							<th>".gettext("Interest")."</th>
							<th>".gettext("Repayment")."</th>
							<th>".gettext("Principal")."</th>
						</tr>
				</table>
			</div><!-- / loanCounter-->
		</div><!-- / paymentPlanFrame-->";
	
		return $frame;
	}
	/**
	 * Get variables for loans
	 * 
	 * @access  private
	 * @return  array   	$variables
	 */
	private function getLoanVariables(){
		Debug::debug(get_class(), "getLoanVariables", "Start");
		
		// Create arrays
		// Repayment
		$loanTypes = $this->getLoanTypesInArray();
							
		$interestTypes = array(	"fixed" => gettext("Fixed interest")
								, "euribor1" => gettext("1 month euribor")
								, "euribor3" => gettext("3 month euribor"));
		
		// Loan repayment intervals
		$repaymentIntervals = array (		"day" => gettext("Day")
										, 	"week" => gettext("Week")
										, 	"month" => gettext("Month")
										, 	"year" => gettext("Year") );
		
		// Loan repayment interval texts
		$repaymentIntervalTexts = array (	"day" => gettext("days")
										, 	"week" => gettext("weeks")
										, 	"month" => gettext("months")
										, 	"year" => gettext("years") );
		
		// Loan terms
		$loanTerms = array_combine(range(5,30), range(5,30));
		
		// Loan status
		$loanStatusArray = array(	"open" => gettext("Open")
									, "granted" => gettext("Granted")
									, "denied" => gettext("Denied")
									, 'active' => gettext("Active")
									, 'declined' => gettext("Declined")
									, 'paid' => gettext("Paid")
									, 'passive' => gettext("Passive")
									, 'paused' => gettext("Paused")
									, 'removed' => gettext("Removed") );
		
		$variables = array(	'loanTypes' => $loanTypes
							, 'interestTypes' => $interestTypes
							, 'repaymentIntervals' => $repaymentIntervals
							, 'repaymentIntervalTexts' => $repaymentIntervalTexts
							, 'loanTerms' => $loanTerms
							, 'loanStatusArray' => $loanStatusArray );
		
		Debug::debug(get_class(), "getLoanVariables", "Return variables");
		return $variables;
	}
	
}
?>