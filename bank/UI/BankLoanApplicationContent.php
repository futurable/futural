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
 * @version   2011-06-15
 */
class BankLoanApplicationContent extends Content {
	public function __construct(){
		parent::__construct();
	}
	
	public function doDisplayInHtml( User $userObject ) {
		Debug::debug(get_class(), "doDisplayInHtml", "Start");
		
		// check user role
		$userRole = $userObject->getRole();
		
		$content = "
		<script type='text/javascript'>
			/* Tooltips */
			$(function() {
				$( document ).tooltip();
			});
				
			function hideFields(){
				var selectedType = document.getElementsByName('loanType').item(0).value;
				
				if( selectedType != 'fixedRepayment' ){
					document.getElementById('repayment').style.display = 'none';
					document.getElementsByName('repayment').item(0).value = '';
				}
				else document.getElementById('repayment').style.display = 'block';
				
				if( selectedType != 'fixedInstalment' ){
					document.getElementById('instalment').style.display = 'none';
					document.getElementsByName('instalment').item(0).value = '';
				}
				else document.getElementById('instalment').style.display = 'block';			
			}
			
			function getLoanTermLabel(){
				var loanTermLabel = document.getElementById('loanTermDescription');
				var loanTermSelected = document.getElementsByName('repaymentInterval').item(0).selectedIndex;
				//var loanTermDescription = document.getElementsByName('repaymentInterval').item(0).options[loanTermSelected].text;
				
				if(loanTermSelected == '0'){
					var loanTermDescription = '".gettext('days')."';
				}
				else if(loanTermSelected == '1'){
					var loanTermDescription = '".gettext('weeks')."';
				}
				else if(loanTermSelected == '2'){
					var loanTermDescription = '".gettext('months')."';
				}
				
				loanTermLabel.innerHTML = loanTermDescription;
			}
			
			function getLoanTermWarning(){
				// Check if there's text in loan repayment info fields
				var loanTermWarning = document.getElementById('loanTermWarning');
				var loanRepaymentField = document.getElementsByName('repayment').item(0).value;
				var loanInstalmentField = document.getElementsByName('instalment').item(0).value;
				var loanTermField = document.getElementsByName('loanTerm').item(0);
				
				if(loanRepaymentField != '' || loanInstalmentField != ''){
					var loanTermWarningText = '<p>".gettext('When repayment or instalment is given, loan term will be ignored.')."</p>';
					loanTermField.disabled = 'disabled';
					loanTermWarning.innerHTML = loanTermWarningText;
				}
				else{
					loanTermWarning.innerHTML = '';
					loanTermField.disabled = false;
				}
			}
			
			window.onload=function hideFieldsStart(){
				hideFields();
				getLoanTermLabel();
			};
		</script>";
		
		if ( strcmp(trim($userRole), 'opiskelija') === 0 ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Profil = $userRole", 2);
			// Student role content
			$content .= $this->doDisplayBusinessCustomerContentInHtml($userObject );
				
		} else if ( strcmp(trim($userRole), 'Admin profil') === 0 ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Profil = $userRole", 2);
			// Admin role content
			$content .= $this->doDisplayAdminContentInHtml($userObject);
			
		}
		
		return $content;
	}

	/**
	 * Get HTML-formatted content for business customers
	 * 
	 * @access  private
	 * @return  mixed   $content
	 */
	private function doDisplayBusinessCustomerContentInHtml( User $user ) {
		Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "Start");
		
		// Display new loan application
		if( isset($_POST['newLoanApplication']) && !empty($_POST['newLoanApplication']) && !isset($_POST['cancel']) ){
			// Display loan application summary
			if (isset($_POST[ 'checkLoanApplication' ]) && $_POST[ 'checkLoanApplication' ]) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "POST has checkLoanApplication variable.", 2);
				
				$loanApplication = new BankLoanInfo();
				$loanApplication->fillObjectFromArray ( $loanApplication, $_POST );
				$validated = $loanApplication->validateBankLoanInfo();
				
				if($validated === true){
					$form = $this->displayLoanApplicationInformationUsingObject($loanApplication);
				}
				else{
					$form = $this->displayLoanApplicationInformationUsingObjectWithErrors($loanApplication, $validated);
				}
				
				$content = $form;
				
			}
			// Save loan application
			else if (isset($_POST[ 'saveLoanApplication' ]) and $_POST[ 'saveLoanApplication' ] ) {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "saveLoanApplication button is pressed", 2);
				$content = $this->displaySaveLoanApplication();
			}
			// Display loan application
			else {
				Debug::debug(get_class(), "doDisplayBusinessCustomerContentInHtml", "POST has no checkLoanApplication variable.", 2);
				
				// Form for loan application
				$form = $this->displayLoanApplicationFormInHTMLFormat($user);
				
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
				
				if($successful === true) $loanStatusUpdate = gettext('Loan application deleted succesfully');
				else $loanStatusUpdate = gettext('Error while deleting loan application.')."<br/>".gettext('Please try again later');
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
				
				if($successful === true) $loanStatusUpdate = gettext('Loan application declined succesfully');
				else $loanStatusUpdate = gettext('Error while declining loan application.')."<br/>".gettext('Please try again later');
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
			
			$content = "<h1>".gettext('Loan applications')."</h1>";
			
			if(isset($loanStatusUpdate)){
				$content .= "<p>$loanStatusUpdate</p>";
			}
			
			// Display users loan applications
			$content .= $this->displayLoanApplicationStatusInHTMLFormat($user);
			$content .= "<p><form action='' method='POST'><input type='submit' name='newLoanApplication' value='".gettext('Make a new loan application')."' /></form></p>";
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
	private function displayLoanApplicationFormInHTMLFormat(User $user){
		
		// Required JavaScipt functions
		$loanTypeJS['onchange'] = 'hideFields()';
		$loanIntervalJS['onchange'] = 'getLoanTermLabel()';
		$loanRepaymentJS['onkeyup'] = 'getLoanTermWarning()';
		
		$form = "
		<div id='form'>
			<form action='' method='post' id='loanApplicationForm'>
				<fieldset>
					<legend>".gettext("Make a loan application")."</legend>";
		
		// Get required arrays
		$variables = $this->getLoanVariables();
		foreach($variables as $key => $value){
			${$key} = $value;
		}
		
		// Create form
		$form .= $this->getFormHiddenInputField('userId', $user->getId() );
		$form .= $this->getFormHiddenInputField('loanApplicant', $user->getCompany() );
		$form .= $this->getFormHiddenInputField('newLoanApplication', "true" );
		
		// Repayment
		$form .= $this->getFormInputElement( gettext("Amount of loan"), "loanAmount", gettext("Insert the amount of the loan you want to apply"));
	
		$form .= $this->getFormDropDownMenuWithArrayKeyAsOptionValue( gettext("Loan type"), $loanTypes, "loanType", $loanTypeJS );
		
		$form .= $this->getFormInputElement( gettext("Repayment"), "repayment", gettext("Insert the planned repayment amount"));
		$form .= $this->getFormInputElement( gettext("Instalment"), "instalment", gettext("Insert the planned instalment amount"));
		
		// Loan length
		$form .= $this->getFormDropDownMenuWithArrayKeyAsOptionValue( gettext("Interval of repayment"), $repaymentIntervals, "repaymentInterval", $loanIntervalJS );
		
		$form .= "<div id='loanTermFields'>";
		$form .= $this->getFormDropDownMenu( gettext("Loan term"), $loanTerms, "loanTerm" );
		$form .= "<span id='loanTermDescription'></span></div><br/><!-- / LoanTermFields --><span id='loanTermWarning' class='incorrect'></span>";
		
		$form .= $this->getFormDropDownMenuWithArrayKeyAsOptionValue( gettext("Interest type"), $interestTypes, "interestType" );
				
		/*/ Loan term options
		$loanTermOptions = null;
		foreach($loanTerms as $value){
			$loanTermOptions .= "<option>$value</option>\n";
		}
		
		$form .= "<label>".gettext('Loan term')."</label><span><select class='floatLeft' name='loanTerm'>$loanTermOptions</select><span id='loanTermDescription'></span></span>";
		*/
		
		$form .= "
				</fieldset>
					<p>
					<input type='submit' value='".gettext('Cancel')."' name='cancel' />
					<input type='submit' value='".gettext('Continue')."' name='checkLoanApplication' />
					</p>
				
			</form>
		</div><!-- /form -->";
		
		return $form;
	}
	
	/**
	 * Get HTML-formatted loan application summary
	 * 
	 * @access  private
	 * @param 	BankLoanInfo $object
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
		
		$form = "
		<div id='form'>
			<form action='' method='post'>
				<fieldset>
					<legend>".gettext("Confirm loan application information")."</legend>";
		
			$form .= $this->getFormHiddenInputField('userId', $object->getAuthor() );
			$form .= $this->getFormHiddenInputField('loanApplicant', $object->getLoanApplicant() );
			$form .= $this->getFormHiddenInputField('loanID', $loanID );
			$form .= $this->getFormHiddenInputField('newLoanApplication', "true" );
			
			$form .= $this->getFormHiddenInputField('loanAmount', $object->getLoanAmount());
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
				<p>
				<input type='submit' value='".gettext('Cancel')."' name='cancel' />
				<input type='submit' value='".gettext('Confirm')."' name='saveLoanApplication' />
				</p>
			</form>
		</div><!-- /form -->";
		return $form;
	}
	
	/**
	 * Get HTML-formatted loan application summary with errors
	 * 
	 * @access  private
	 * @param 	BankLoanApplication $object
	 * @param	array	$errorArray
	 * @return  mixed   $form
	 */
	private function displayLoanApplicationInformationUsingObjectWithErrors(BankLoanInfo $object, $errorArray){
		
		if(is_array($errorArray)){
			// Get required arrays
			$variables = $this->getLoanVariables();
			foreach($variables as $key => $value){
				${$key} = $value;
			}
			
			// Required JavaScipt functions
			$loanTypeJS['onchange'] = 'hideFields()';
			$loanIntervalJS['onchange'] = 'getLoanTermLabel()';
			$loanRepaymentJS['onkeyup'] = 'getLoanTermWarning()';
			
			$form = "
			<div id='form'>
				<form action='' method='post' id='loanApplicationForm'>
					<fieldset>
						<legend>".gettext("Check loan application information")."</legend>";
			
				$form .= $this->getFormHiddenInputField('userId', $object->getAuthor() );
				$form .= $this->getFormHiddenInputField('loanApplicant', $object->getLoanApplicant() );
				$form .= $this->getFormHiddenInputField('loanID', $object->getLoanID() );
				$form .= $this->getFormHiddenInputField('newLoanApplication', "true" );
				
				$form .= $this->getFormInputField(gettext('Amount of loan'), 'loanAmount', $errorArray );
				
				$form .= $this->getFormDropDownMenuWithArrayKeyAsOptionValue( gettext("Loan type"), $loanTypes, "loanType", $loanTypeJS );
				$form .= $this->getFormInputField(gettext('Repayment'), 'repayment', $errorArray, $loanRepaymentJS );
				$form .= $this->getFormInputField(gettext('Instalment'), 'instalment', $errorArray, $loanRepaymentJS );
				
				// Loan length
				$form .= $this->getFormDropDownMenuWithArrayKeyAsOptionValue( gettext("Interval of repayment"), $repaymentIntervals, "repaymentInterval", $loanIntervalJS );
				
				$form .= "<div id='loanTermFields'>";
				$form .= $this->getFormDropDownMenu( gettext("Loan term"), $loanTerms, "loanTerm" );
				$form .= "<span id='loanTermDescription'></span></div><!-- / loanTermFields--><span id='loanTermWarning' class='incorrect'></span>";
				
				$form .= $this->getFormDropDownMenuWithArrayKeyAsOptionValue( gettext("Interest type"), $interestTypes, "interestType" );
								
			$form .= "
					</fieldset>
					<p>
					<input type='submit' value='".gettext('Cancel')."' name='cancel'/>
					<input type='submit' value='".gettext('Continue')."' name='checkLoanApplication' />
					</p>
				</form>
			</div><!-- /form -->";
			return $form;
		}
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
		
		// Loan length
		$repaymentIntervals = array (	"day" => gettext("Day")
										, "week" => gettext("Week")
										, "month" => gettext("Month") );
		$loanTerms = range(5, 25);
		
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
							, 'loanTerms' => $loanTerms
							, 'loanStatusArray' => $loanStatusArray );
		
		Debug::debug(get_class(), "getLoanVariables", "Return variables");
		return $variables;
	}
	
}
?>