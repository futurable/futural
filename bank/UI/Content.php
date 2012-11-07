<?php
/**
 *  Content.php
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

require_once '../CommonServices/DataValidator.php';
require_once 'LoginContent.php';
require_once 'FrontPageContent.php';
require_once 'NewTransactionContent.php';
require_once 'NewAccountContent.php';
require_once 'BankTransactionsContent.php';
require_once 'BankLoanApplicationContent.php';
require_once 'DuePaymentContent.php';
require_once 'SEPAPaymentContent.php';
require_once 'BankLoanContent.php';
require_once 'PageNotFoundContent.php';

/**
 * Content.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-11-07
 */
abstract class Content {
	
	private $id;
	private $content;
	private $bankName;
	private $bankBIC;
	private $bankBranchCode;
	
	private static $contentTypes = array( "Login" => "LoginContent"
								, "FrontPage" => "FrontPageContent"
								, "Transactions" => "BankTransactionsContent"
								, "NewPayment" => "NewTransactionContent"
								, "NewAccount" => "NewAccountContent"
								, "LoanApplication" => "BankLoanApplicationContent"
								, "BankTransactions" => "BankTransactionsContent" 
								, "DuePayment" => "DuePaymentContent"
								, "SEPAPayment" => "SEPAPaymentContent"
								, "Loans" => "BankLoanContent");
	
	/**
	 * Contructor for Content
	 */
	public function __construct() {
		$this->setBankSettings();
	}
	
	private function setBankSettings(){
		// Open settings file and set it to variable
		$handle = file_get_contents("bank/Conf/conf-bankSettings.xml", true);
		$settings = new SimpleXMLElement($handle);
		
		// initialize attributes
		$this->setBankName((string)$settings->Name);
		$this->setBankBIC((string)$settings->BIC);
		$this->setBankBranchCode((string)$settings->BranchCode);
	}
	
	/**
	 * Static function that open content by current page id.
	 * 
	 * @access  public
	 * @param   string  $currentPage
	 * @return  Content $object
	 */
	public static function openContentObjectById ( $currentPage ) {
		Debug::debug(get_class(), "openContentObjectById", "Start");
		
		$object = null;
		
		if (is_string($currentPage)) {
			Debug::debug(get_class(), "openContentObjectById", "Current page is string ($currentPage)", 2);
			// get Content object type
			$contentType = self::getContentType( $currentPage );
			
			if(class_exists($contentType)){
				$object = new $contentType();
			}
			else{
				$object = new PageNotFound();
			}
		}
		
		Debug::debug(get_class(), "openContentObjectById", "Return object");
		return $object;
	}
	
	/**
	 * Get content object type.
	 * Check content type from contentTypes array.
	 * 
	 * @access  private
	 * @param   string   $type
	 * @return  string   $contentType
	 */
	private static function getContentType( $type ) {
		Debug::debug(get_class(), "getContentType", "Start");
		$contentType = NULL;
		
		if (is_string($type)) {
			Debug::debug(get_class(), "getContentType", "Type ($type) is string", 2);
			
			if (array_key_exists($type, self::$contentTypes)) {
				Debug::debug(get_class(), "getContentType", "Type ($type) is in contentType array", 3);
				$contentType = self::$contentTypes[ $type ];
			}
		}
		Debug::debug(get_class(), "getContentType", "Return contentType $contentType");
		return $contentType;
	}
	
	/**
	 * Display content in html.
	 * 
	 * @param User $user
	 */
	public function displayInHtml( User $user ) {
		Debug::debug(get_class(), "displayInHtml", "Start");
		
		// GET-variables
		$vars = "?".CommonFunctions::getCommandString()."lang=";
		$fi = $vars."fi";
		$en = $vars."en";

		print 	"<div id='langBox'>
						<a href='$fi'>FI</a>
						<a href='$en'>EN</a><br/>
				</div>";
		
		print "<div id='loginBox'>	
				<p>".gettext('Signed in').":<br/>"
				. $user->getName() . " / " . $user->getCompanyName() .
				"</p>
				</div>";
		
		print "<div id='content'>\n" . 
		
		$this->doDisplayInHtml( $user ) .	
		
		"\n</div><!-- /content -->\n";
	}
	
	/**
	 * Abstract function for displaying real child class content.
	 * 
	 * @access protected
	 * @param  DatabaseConnect $databaseConnect
	 * @param  User            $user
	 */
	protected abstract function doDisplayInHtml( User $user );
	
	/**
	 * Return text label with hidden field for form in html format.
	 * 
	 * @access protected
	 * @param  string $fieldDefinition
	 * @param  string $value
	 * @param  string $hiddenFieldName
	 * @return string $text
	 */
	protected function getFormTextLabelWithHiddenInput( $labelDefinition, $value, $hiddenFieldName ) {
		$text = '';
		
		if (is_string($labelDefinition) and is_string($value) and is_string($hiddenFieldName)) {
			$text = <<<EOT
				<label>$labelDefinition: </label>
				<span> $value </span>
				<input type='hidden' name='$hiddenFieldName' value='$value' />
EOT;
		}
		
		return $text;
	}
	
	/**
	 * Return drop down menu (select) for form in html format.
	 * Do not enable multiple selections.
	 * 
	 * @access protected
	 * @param  string 	$labelDefinition
	 * @param  array  	$optionArray
	 * @param  string 	$selectMenuName
	 * @param  array	$javaScript 		default false
	 * @return string $text
	 */
	protected function getFormDropDownMenu( $labelDefinition, $optionArray, $selectMenuName, $javaScript = false) {
		$text = '';
		
		if (is_string($labelDefinition) and is_array($optionArray) and is_string($selectMenuName)) {
			$text = <<<EOT
				<label>$labelDefinition: </label>
				<span>
EOT;

			$text .= "<select name='$selectMenuName'";
			
			// Add JavaScript to select
			if(is_array($javaScript)){
				foreach($javaScript as $key => $value){
					$text .= " $key = '$value'";
				}
			}
			
			$text .= ">";
					
			foreach ( $optionArray as $key => $value ) {
				// if form is posted and this value is selected, set selected
				if (isset($_POST[ $selectMenuName ]) && $_POST[ $selectMenuName ] == "$value") {
					$text .= "<option selected='selected'>$value</option>";
				} else {
					$text .= "<option>$value</option>";
				}
			}					
			$text .= <<<EOT
					</select>
				</span>
EOT;
		}
		
		return $text;
	}
	
	/**
	 * Return drop down menu (select) for form in html format.
	 * Use array keys as option values
	 * Do not enable multiple selections.
	 * 
	 * @access protected
	 * @param  string 	$labelDefinition
	 * @param  array  	$optionArray
	 * @param  string 	$selectMenuName
	 * @param  array	$javaScript 		default false
	 * @return string 	$text
	 */
	protected function getFormDropDownMenuWithArrayKeyAsOptionValue( $labelDefinition, $optionArray, $selectMenuName, $javaScript = false ) {
		$text = '';
		
		if (is_string($labelDefinition) and is_array($optionArray) and is_string($selectMenuName)) {
			$text = <<<EOT
				<label>$labelDefinition: </label>
				<span> 
EOT;

			$text .= "<select name='$selectMenuName'";
			
			// Add JavaScript to select
			if(is_array($javaScript)){
				foreach($javaScript as $key => $value){
					$text .= " $key = '$value'";
				}
			}
			
			$text .= ">";

			foreach ( $optionArray as $key => $value ) {
				// if form is posted and this value is selected, set selected
				if (isset($_POST[ $selectMenuName ]) && $_POST[ $selectMenuName ] == "$key") {
					$text .= "<option value='$key' selected='selected'>$value</option>";
				} else {
					$text .= "<option value='$key'>$value</option>";
				}
			}					
			$text .= <<<EOT
					</select>
				</span>
EOT;
		}
		
		return $text;
	}
	
	/**
	 * Return input field for form in html format.
	 * 
	 * @access protected
	 * @param  string  $labelDefinition
	 * @param  string  $inputFieldName
	 * @param  array   $errors         	- possible errors (when form is validated)
	 * @param  array   $javaScript  	- possible javaScript
	 * @param  integer $size
	 * @param  integer $maxlength
	 * @return string  $text
	 */
	protected function getFormInputField( $labelDefinition, $inputFieldName, $errors = false, $javaScript = false, 
										  $size = false, $maxlength = false ) {
		$text = '';
		
		if (is_string($labelDefinition) and is_string($inputFieldName)) {
			$text = <<<EOT
				<div class='$inputFieldName'>
				<label>$labelDefinition: </label>
				<span><input type='text' name='$inputFieldName' id='$inputFieldName' 
EOT;

			// if variable is posted (form is posted), print the value too
			if (isset($_POST[ $inputFieldName ])) {
				$text .= "value='". $_POST[ $inputFieldName ] ."' ";
			}
			// if errors is array and there is key named same as input field name, print class=incorrect
			if (is_array($errors) and isset($errors[ $inputFieldName ])) {
				$text .= "class='incorrect' ";
			}
			// if js is array, print js things
			if (is_array($javaScript)) {
				foreach($javaScript as $key => $value){
					$text .= " $key = '$value'";
				}
			}
			// if size is given and it is numeric
			if ( $size !== false and is_numeric($size)) {
				$text .= "size='$size' ";
			}
			// is maxlength is given and it is numeric
			if ( $maxlength !== false and is_numeric($maxlength)) {
				$text .= "maxlength='$maxlength' ";
			}
			$text .= "/>";
			
			if (is_array($errors) and isset($errors[ $inputFieldName])) {
				$text .= $errors[ $inputFieldName ];
			}
			
			$text .= "</span></div><!-- / $inputFieldName -->";
		}
		return $text;
	}
	
	/**
	 * Get disabled form field
	 * @param 	string 	$labelDefinition
	 * @param 	string 	$inputFieldName
	 * @param 	array 	$errors				possible form errors
	 * @return 	string	$input
	 */
	protected function getFormDisabledInputField( $labelDefinition, $inputFieldName, $value, $errors = false){
		$input = '';
		
		if (is_string($labelDefinition) and is_string($inputFieldName)) {
			
			$input .= "\n
			<div id='$inputFieldName'>
			<label>$labelDefinition: </label>
			<span><input type='text' disabled='disabled' name='$inputFieldName' ";
			
			$input .= "value='$value' ";
			
			// if errors is array and there is key named same as input field name, print class=incorrect
			if (is_array($errors) and isset($errors[ $inputFieldName ])) {
				$input .= "class='incorrect' ";
			}
			if (is_array($errors) and isset($errors[ $inputFieldName])) {
				$input .= $errors[ $inputFieldName ];
			}
			
			$input .= "</span></div><!-- / $inputFieldName -->";
		}
		return $input;
	}
	
	/**
	 * Return hidden input field for form in html format.
	 * 
	 * @access protected
	 * @param  string  $inputFieldName
	 * @param  string  $value
	 * @return string  $text
	 */
	protected function getFormHiddenInputField( $inputFieldName, $value ) {
		$text = '';
		
		if (is_string($inputFieldName) and is_string($value)) {
			$text = "<input type='hidden' name='$inputFieldName' value='$value' />";
		}
		return $text;
	}
	
	/**
	 * Return label for hidden input field in html format.
	 * 
	 * @access protected
	 * @param  string  $labelText
	 * @param  string  $value
	 * @return string  $text
	 */
	protected function getFormLabelField( $labelDefinition, $value ) {
		$text = '';
		
		if(is_string($labelDefinition) && is_string($value)){
			$text .= "<label>$labelDefinition: </label>";
			$text .= "<span>$value</span>";
		}
		
		return $text;
	}
	
	/**
	 * Return textarea for form.
	 * 
	 * @access protected
	 * @param  string  $labelDefinition
	 * @param  string  $textareaName
	 * @param  integer $cols
	 * @param  integer $rows
	 * @return string  $text
	 */
	protected function getFormTextarea( $labelDefinition, $textareaName, $rows = false, $cols = false ) {
		$text = '';
		
		if (is_string($labelDefinition) and is_string($textareaName)) {
			$text = <<<EOT
				<label>$labelDefinition: </label>
				<span><textarea name='$textareaName' 
EOT;
			if ($rows !== false and is_numeric($rows)) {
				$text .= "rows='$rows' ";
			}
			if ($cols !== false and is_numeric($cols)) {
				$text .= "cols='$cols' ";
			}
			
			$text .= ">";
			// if variable is posted, print the value too
			if (isset($_POST[ $textareaName ])) {
				$text .= $_POST[ $textareaName ];
			}
			$text .= <<<EOT
</textarea></span>
EOT;
		}
		
		return $text;
	}
	
	/**
	 * Return label and input with calendar function.
	 * Require js-calendar (CommonServices/calendar) to work perfectly.
	 * 
	 * @access protected
	 * @param  string $labelDefinition
	 * @param  string $inputFieldName
	 * @param  string $errors      possible errors in array [inputFieldName] = ErrorMessage
	 * @return string $text        label and input in html format
	 */
	protected function getFormCalendarField( $labelDefinition, $inputFieldName, $errors = false ) {
		$text = '';
		
		if (is_string($labelDefinition) and is_string($inputFieldName )) {
			$text .= <<<EOT
				<label>$labelDefinition:</label>
					<span><input type='text' name='$inputFieldName' id='$inputFieldName' 
EOT;
			// if errors is array and there is key named same as input field name, print class=incorrect
			if (is_array($errors) and isset($errors[ $inputFieldName ])) {
				$text .= "class='incorrect' ";
			}
			// if variable is posted (form is posted), print the value too
			if (isset($_POST[ $inputFieldName ])) {
				$text .= "value='". $_POST[ $inputFieldName ] ."' ";
			}
			$text .= "/>";
			
			if (is_array($errors) and isset($errors[ $inputFieldName])) {
					$text .= $errors[ $inputFieldName ];
			}
			
			$text .= <<<EOT
				</span>
					<script type='text/javascript'>calendar.set('$inputFieldName');</script>
EOT;
		}
		return $text;
	}
	
	/**
	 * Return input field for form in html format.
	 *
	 * @access protected
	 * @param  string  $elementLabel
	 * @param  string  $inputElementID
	 * @param  string  $title
	 * @param  array   $errors         	- possible errors (when form is validated)
	 * @return string  $text
	 */
	protected function getFormInputElement( $elementLabel, $elementID, $title = false, $errors = false ) {
		$text = '';
	
		if (is_string($elementLabel) and is_string($elementID)) {
			$divID = $elementID."Div";
			
			$text = "
			<div class='$elementID' id='$divID'>\n
			\t<label>$elementLabel: </label>\n
			\t<input type='text' name='$elementID' id='$elementID'";
	
			// If title is set, print the value
			if(isset($title) and !empty($title)){
				$text .= " title='$title'";
			}
			// If variable is posted (form is posted), print the value too
			if (isset($_POST[ $elementID ])) {
				$text .= "value='". $_POST[ $elementID ] ."' ";
			}
			// If errors is array and there is key named same as input field name, print class=incorrect
			if (is_array($errors) and isset($errors[ $elementID ])) {
				$text .= "class='incorrect' ";
			}
	
			$text .= "/>\n";
	
			if (is_array($errors) and isset($errors[ $elementID])) {
				$text .= $errors[ $elementID ];
			}
	
			$text .= "</div><!-- / $divID -->\n\n";
		}
		return $text;
	}
	
	/**
	 * Return drop down menu (select) for form in html format.
	 * Use array keys as option values
	 * Do not enable multiple selections.
	 *
	 * @access protected
	 * @param  string 	$elementLabel
	 * @param  array  	$optionArray
	 * @param  string 	$elementID
	 * @param  string	$title 					default false
	 * @return string 	$text
	 */
	protected function getFormSelectElement( $elementLabel, $optionArray, $elementID, $title = false ) {
		$text = '';
		$divID = $elementID."Div";
		
		if (is_string($elementLabel) AND is_array($optionArray) AND is_string($elementID)) {
			$text = "<div class='$elementID' id='$divID'>\n \t<label>$elementLabel: </label>\n";
	
			$text .= "\t<select name='$elementID' id='$elementID'";
			if(isset($title) AND !empty($title)){
				$text .= " title='$title'";
			}
			$text .= ">\n";
	
			foreach ( $optionArray as $key => $value ) {
				$text .= "\t\t";
				// if form is posted and this value is selected, set selected
				if (isset($_POST[ $elementID ]) AND $_POST[ $elementID ] == "$key") {
					$text .= "<option value='$key' selected='selected'>$value</option>";
				} else {
					$text .= "<option value='$key'>$value</option>";
				}
				$text .= "\n";
			}
			$text .= "\t</select>\n";
			$text .= "</div><!-- / $divID -->\n\n";
		}
	
		return $text;
	}
	
	/**
	 * Return loan types in array
	 * Loan type code as key and translated loan type as value
	 * 
	 * @access protected
	 * @return array  $loanTypes
	 */
	protected function getLoanTypesInArray(){
		$loanTypes = array(	
			"fixedRepayment" => gettext("Fixed repayment")
			, "fixedInstalment" => gettext("Fixed Instalment")
			, "annuity" => gettext("Annuity (ARM)") 
		);
		
		return $loanTypes;
	}
	
	// getters and setters
	
	public function setId ( $id ) {
		if (is_string($id)) {
			Debug::debug(get_class(), "setId", "id is string");
			$this->id = $id;
		}
	}
	
	public function getId () {
		if (isset($this->id)) {
			return $this->id;
		}
	}
	
	public function setContent( $content ) {
		$this->content = $content;
	}
	
	public function getContent() {
		if (isset($this->content)) {
			return $this->content;
		}
	}

	private function setBankName($bankName){
		if(is_string($bankName)){
			$this->bankName = $bankName;
		}
	}
	public function getBankName(){
		if(isset($this->bankName)) return $this->bankName;
	}
	
	private function setBankBIC($bankBIC){
		if(DataValidator::isBICValid($bankBIC)){
			$this->bankBIC = $bankBIC;
		}
	}
	public function getBankBIC(){
		if(isset($this->bankBIC)) return $this->bankBIC;
	}
	
	private function setBankBranchCode($bankBranchCode){
		if(DataValidator::isPositiveIntValid($bankBranchCode)){
			$this->bankBranchCode = $bankBranchCode;
		}
	}
	public function getBankBranchCode(){
		if(isset($this->bankBranchCode)) return $this->bankBranchCode;
	}
	
	public function toString() {
		print "<p class='toString'>
				Content <br/>
				Content id: $this->id<br/>
				BankName: $this->bankName<br/>
				BIC: $this->bankBIC<br/>
				BranchCode: $this->bankBranchCode
				</p>";
	}
}
?>