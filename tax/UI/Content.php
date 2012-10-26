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

require_once 'CommonServices/DataValidator.php';
require_once 'CommonServices/Format.php';
require_once 'LoginContent.php';
require_once 'SelectCompanyContent.php';
require_once 'FrontPageContent.php';
require_once 'TransactionsContent.php';
require_once 'MonthlySummaryContent.php';
require_once 'DeclarationInfoContent.php';
require_once 'CustomerInfoContent.php';
require_once 'VATDeclarationContent.php';
require_once 'ECDeclarationContent.php';
require_once 'CorrectDeclarationContent.php';

/**
 * Content.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-21
 */
abstract class Content {
	
	private $id;
	private $content;
	
	private static $contentTypes = array( "Login" => "LoginContent"
								, "SelectCompany" => "SelectCompanyContent"
								, "FrontPage" => "FrontPageContent"
								, "AccountTransactions" => "TransactionsContent"
								, "VATDeclaration" => "VATDeclarationContent"
								, "ECDeclaration" => "ECDeclarationContent"
								, "MonthlySummary" => "MonthlySummaryContent"
								, "DeclarationInfo" => "DeclarationInfoContent"
								, "CustomerInfo" => "CustomerInfoContent"
								, "CorrectDeclaration" => "CorrectDeclarationContent");
								
	private $declarationMonths;
	
	/**
	 * Contructor for Content
	 */
	public function __construct() {
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
			
			$object = new $contentType();
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
						<a href='$fi' class='link'>FI</a>
						<a href='$en' class='link'>EN</a><br/>
				</div>";
		
		print "<div id='loginBox'>	
				<p class='bold'>". $user->getName() . " - <a href='?page=Logout' class='orange link'>". gettext('Logout') ."</a></p>";
			
		// Only print company name if company is selected
		if(is_object($user->getCurrentCompany()) ){
			$companyName = $user->getCurrentCompany()->getCompanyName();
			
			print "<p class='bold'>$companyName - 
					<a href='?page=SelectCompany' class='orange link'>". gettext('Choose company') ."</a></p>";
		}
		
		print "</div><div id='content'>\n" . 
		
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
	
	protected function getDeclarationMonthsContent() {
		$content = "
			<div class='textArea'>\n
				<table id='months'>\n
					<tr class='bold'>\n
						<td>". gettext('Declaration period') ."</td>\n
						<td>". gettext('Target season') ."</td>\n
					</tr>\n
				
					<tr>\n
						<td>". gettext('Month') ."</td>
						<td>
							<select name='targetPeriod'>";
		
		foreach ($this->getDeclarationMonths() as $value) {
			$monthName = $this->getMonthName( date("m", strtotime($value)) );
			$year = date("Y", strtotime($value));
			
			// if user has selected some of the months already
			if (isset($_POST['targetPeriod']) and $_POST['targetPeriod'] === $value) {
				$content .= "<option value='$value' selected='selected'>$year - $monthName </option>\n";
			} else {
				$content .= "<option value='$value'>$year - ". gettext($monthName) ."</option>\n";
			}
		}
		
		$content .= <<<EOT
							</select>
						</td>
					</tr>
				</table>
			</div>		
EOT;

		return $content;
	}
	
	/**
	 * Display one form row.
	 * Display possible value and error message too.
	 * 
	 * Has 3 different scenes:
	 * - empty form
	 * - field with precompleted information 
	 * - field with precompleted information (variableValue) and error messages (from $errors array)
	 * 
	 * @param string $fieldText
	 * @param string $fieldName
	 * @param string $variableName
	 * @param string $variableValue
	 * @param array $errors
	 */
	protected function getFormInputFieldInArray( $fieldText, $fieldName, $variableName, $variableValue, $errors = false ) {
		$content = '';
		$variableNameTemp = ucfirst($variableName);
		
		if (is_array($errors) and isset($errors[ $variableName ])) {
		$content .= "<tr class='incorrect'>
						<td colspan='3' class='noBorder'></td>
						<td colspan='2' class='noBorder'>". $errors[ $variableName ] ."</td>
					</tr>";
		}
		
		$content .=			"<tr>
								<td class='orange bold'>$fieldName</td>
								<td colspan='2'>$fieldText</td>
								<td><input type='text' size='10' maxlength='13' name='$variableName' value='$variableValue' /></td>
								<td></td>
							</tr>";
		
		return $content;
	}
	
	
	
	
	
	/**
	 * Static function for getting translated month name by it's number
	 * @access 	protected
	 * @param	int		$month		Month number (1-12)
	 * @return 	string	$monthName
	 */
	protected function getMonthName( $month ){
		$monthName = null;
		$month = intval($month);
		
		if( DataValidator::isPositiveIntValid($month) and $month <= 12 ){
			$months = array(
				1 => gettext('January')
				, 2 => gettext('February')
				, 3 => gettext('March')
				, 4 => gettext('April')
				, 5 => gettext('May')
				, 6 => gettext('June')
				, 7 => gettext('July')
				, 8 => gettext('August')
				, 9 => gettext('September')
				, 10 => gettext('October')
				, 11 => gettext('November')
				, 12 => gettext('December')
			);
			
			if(array_key_exists($month, $months)){
				$monthName = $months[$month];
			}
		}
		
		return $monthName;
	}
	
	/**
	 * Static function for getting translated week day name by it's number
	 * @access 	protected
	 * @param	int		$weekDay	Week day number (1-7)
	 * @return 	string	$dayName
	 */
	protected function getWeekDayName( $weekDay ){
		$dayName = null;
		$weekDay = intval($weekDay);
		
		if( DataValidator::isPositiveIntValid($weekDay) and $weekDay <= 7 ){
			
			$weekDays = array(
				1 => gettext('Monday')
				, 2 => gettext('Tuesday')
				, 3 => gettext('Wednesday')
				, 4 => gettext('Thursday')
				, 5 => gettext('Friday')
				, 6 => gettext('Saturday')
				, 7 => gettext('Sunday')
			);
			
			if(array_key_exists($weekDay, $weekDays)){
				$dayName = $weekDays[$weekDay];
			}
		}
		
		return $dayName;
	}
	
	/**
	 * Sorting method for sorting objects array by date.
	 * Sorts object descending by date.
	 * Use this method with uasort! 
	 * (uasort( arrayToBeSorted, sortingAlgorithm), more info: http://php.net/manual/en/function.uasort.php)
	 * 
	 * @access protected
	 * @param Transaction $object1
	 * @param Transaction $object2
	 */
	protected function sortObjectArrayByDate( Transaction $object1, Transaction $object2 ) {
	
		if ( $object1->getTargetPeriod() < $object2->getTargetPeriod() ) {
			return 1;
		} else if ( $object1->getTargetPeriod() > $object2->getTargetPeriod() ) {
			return -1;
		} else {
			return 0;
		}
	}
	
	/**
	 * Sorting method for sorting objects array by creation date.
	 * Sorts object descending by date.
	 * Use this method with uasort! 
	 * (uasort( arrayToBeSorted, sortingAlgorithm), more info: http://php.net/manual/en/function.uasort.php)
	 * 
	 * @access protected
	 * @param Transaction $object1
	 * @param Transaction $object2
	 */
	protected function sortObjectArrayByCreateDateDescending( Transaction $object1, Transaction $object2 ) {
	
		if ( $object1->getCreateDate() < $object2->getCreateDate() ) {
			return 1;
		} else if ( $object1->getCreateDate() > $object2->getCreateDate() ) {
			return -1;
		} else {
			return 0;
		}
	}
	
	/**
	 * Sorting method for sorting objects array by creation date.
	 * Sorts object ascending by date.
	 * Use this method with uasort! 
	 * (uasort( arrayToBeSorted, sortingAlgorithm), more info: http://php.net/manual/en/function.uasort.php)
	 * 
	 * @access protected
	 * @param Transaction $object1
	 * @param Transaction $object2
	 */
	protected function sortObjectArrayByCreateDateAscending( Transaction $object1, Transaction $object2 ) {
	
		if ( $object1->getCreateDate() < $object2->getCreateDate() ) {
			return -1;
		} else if ( $object1->getCreateDate() > $object2->getCreateDate() ) {
			return 1;
		} else {
			return 0;
		}
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
	
	public function getDeclarationMonths() {
		if (!isset($this->declarationMonths)) {
			/*
			$declarationMonthNow = new DateTime();
			$yearAgo = date("Y-m-d", strtotime("-1 year"));
			$declarationMonthYearAgo = new DateTime($yearAgo);
			$interval = new DateInterval("P1M"); // 1 month
			
			foreach (new DatePeriod($declarationMonthYearAgo, $interval, $declarationMonthNow ) as $month) {
				$this->declarationMonths[] = $month->format('Y-m');
			}*/
			$declarationMonth = date("Y-m");
			$this->declarationMonths[] = $declarationMonth;
			
			$interval = 12;
			for ($round = 1; $round <= $interval; $round++) {
				$declarationMonth = date("Y-m", strtotime("-1 month", strtotime($declarationMonth)));
				$this->declarationMonths[] = $declarationMonth;
			}
			
		}
		return $this->declarationMonths;
	}
	
	public function setDeclarationMonths( $months ) {
		if (is_array( $months )) {
			$this->declarationMonths = $months;
		}
	}
	
	public function toString() {
		print "<p class='toString'>
				Content <br/>
				Content id: $this->id
				</p>";
	}
}
?>