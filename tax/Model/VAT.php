<?php
/**
 *  VAT.php
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

require_once 'Transaction.php';
require_once 'Data/VATDataMapper.php';

/**
 * VAT.php
 * 
 * @package   Model
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-21
 */
class VAT extends Transaction {
	
	private $tax301; // tax 23%
	private $tax302; // tax 13%
	private $tax303; // tax 9%
	private $tax305; // tax from products from EU
	private $tax306; // tax from services from EU
	private $tax318; // tax from construction services (reverse charge)
	private $tax307; // deductible tax
	private $tax308; // -+ tax
	private $tax309; // sales, 0%
	private $tax311; // product sales to EU
	private $tax312; // service sales to EU
	private $tax313; // product purchase from EU
	private $tax314; // service purchase from EU
	private $tax319; // sales from construction services (reverse charge)
	private $tax320; // purchases from construction services (reverce charge)
	
	public $dataMapper;
	
	public function __construct() {
		parent::__construct();
		
		$this->setDescriptions();
		$this->dataMapper = new VATDataMapper();
	}
	
	/**
	 * Fill VAT object from array.
	 * @see Transaction::fillObjectFromArray()
	 */
	public function fillObjectFromArray( Transaction $object, $array ) {
		Debug::debug(get_class(), "fillObjectFromArray", "Start");
		parent::fillObjectFromArray($object, $array);
		
		if ( $object instanceof VAT and is_array($array) ) {
			Debug::debug(get_class(), "fillObjectFromArray", "Parameter array is array", 2);
			
			if ( isset($array[ 'tax301' ]) and (!empty($array[ 'tax301'] ) or $array[ 'tax301' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax301 is in array", 3);
				$this->setTax301( $array[ 'tax301' ] );
			}
			if ( isset($array[ 'tax302' ]) and (!empty($array[ 'tax302'] ) or $array[ 'tax302' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax302 is in array", 3);
				$this->setTax302( $array[ 'tax302' ] );
			}
			if ( isset($array[ 'tax303' ]) and (!empty($array[ 'tax303'] ) or $array[ 'tax303' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax303 is in array", 3);
				$this->setTax303( $array[ 'tax303' ] );
			}
			if ( isset($array[ 'tax305' ]) and (!empty($array[ 'tax305'] ) or $array[ 'tax305' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax305 is in array", 3);
				$this->setTax305( $array[ 'tax305' ] );
			}
			if ( isset($array[ 'tax306' ]) and (!empty($array[ 'tax306'] ) or $array[ 'tax306' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax306 is in array", 3);
				$this->setTax306( $array[ 'tax306' ] );
			}
			if ( isset($array[ 'tax318' ]) and (!empty($array[ 'tax318'] ) or $array[ 'tax318' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax318 is in array", 3);
				$this->setTax318( $array[ 'tax318' ] );
			}
			if ( isset($array[ 'tax307' ]) and (!empty($array[ 'tax307'] ) or $array[ 'tax307' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax307 is in array", 3);
				$this->setTax307( $array[ 'tax307' ] );
			}
			if ( isset($array[ 'tax308' ]) and (!empty($array[ 'tax308'] ) or $array[ 'tax308' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax308 is in array", 3);
				$this->setTax308($array[ 'tax308' ]);
				$this->setSum( $array[ 'tax308' ] );
			}
			
			if ( isset($array[ 'tax309' ]) and (!empty($array[ 'tax309'] ) or $array[ 'tax309' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax309 is in array", 3);
				$this->setTax309( $array[ 'tax309' ] );
			}
			if ( isset($array[ 'tax311' ]) and (!empty($array[ 'tax311'] ) or $array[ 'tax311' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax311 is in array", 3);
				$this->setTax311( $array[ 'tax311' ] );
			}
			if ( isset($array[ 'tax312' ]) and (!empty($array[ 'tax312'] ) or $array[ 'tax312' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax312 is in array", 3);
				$this->setTax312( $array[ 'tax312' ] );
			}
			if ( isset($array[ 'tax313' ]) and (!empty($array[ 'tax313'] ) or $array[ 'tax313' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax313 is in array", 3);
				$this->setTax313( $array[ 'tax313' ] );
			}
			if ( isset($array[ 'tax314' ]) and (!empty($array[ 'tax314'] ) or $array[ 'tax314' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax314 is in array", 3);
				$this->setTax314( $array[ 'tax314' ] );
			}
			if ( isset($array[ 'tax319' ]) and (!empty($array[ 'tax319'] ) or $array[ 'tax319' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax319 is in array", 3);
				$this->setTax319( $array[ 'tax319' ] );
			}
			if ( isset($array[ 'tax320' ]) and (!empty($array[ 'tax320'] ) or $array[ 'tax320' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax320 is in array", 3);
				$this->setTax320( $array[ 'tax320' ] );
			}
		}
	}
	
	/**
	 * Validate VAT object.
	 * @see Transaction::validate()
	 */
	public function validate() {
		Debug::debug(get_class(), "validate", "Start");
		$validated = '';
		
		if ( isset($this->tax301) and DataValidator::isNumericValid($this->tax301) === false) {
			Debug::debug(get_class(), "validate", "Tax301 is not integer");
			$validated[ 'tax301' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax302) and DataValidator::isNumericValid($this->tax302) === false) {
			Debug::debug(get_class(), "validate", "Tax302 is not integer");
			$validated[ 'tax302' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax303) and DataValidator::isNumericValid($this->tax303) === false) {
			Debug::debug(get_class(), "validate", "Tax303 is not integer");
			$validated[ 'tax303' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax305) and DataValidator::isNumericValid($this->tax305) === false) {
			Debug::debug(get_class(), "validate", "Tax305 is not integer");
			$validated[ 'tax305' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax306) and DataValidator::isNumericValid($this->tax306) === false) {
			Debug::debug(get_class(), "validate", "Tax306 is not integer");
			$validated[ 'tax306' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax318) and DataValidator::isNumericValid($this->tax318) === false) {
			Debug::debug(get_class(), "validate", "Tax318 is not integer");
			$validated[ 'tax318' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax307) and DataValidator::isNumericValid($this->tax307) === false) {
			Debug::debug(get_class(), "validate", "Tax307 is not integer");
			$validated[ 'tax307' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax309) and DataValidator::isNumericValid($this->tax309) === false) {
			Debug::debug(get_class(), "validate", "Tax309 is not integer");
			$validated[ 'tax309' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax311) and DataValidator::isNumericValid($this->tax311) === false) {
			Debug::debug(get_class(), "validate", "Tax311 is not integer");
			$validated[ 'tax311' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax312) and DataValidator::isNumericValid($this->tax312) === false) {
			Debug::debug(get_class(), "validate", "Tax312 is not integer");
			$validated[ 'tax312' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax313) and DataValidator::isNumericValid($this->tax313) === false) {
			Debug::debug(get_class(), "validate", "Tax313 is not integer");
			$validated[ 'tax313' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax314) and DataValidator::isNumericValid($this->tax314) === false) {
			Debug::debug(get_class(), "validate", "Tax314 is not integer");
			$validated[ 'tax314' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax319) and DataValidator::isNumericValid($this->tax319) === false) {
			Debug::debug(get_class(), "validate", "Tax319 is not integer");
			$validated[ 'tax319' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax320) and DataValidator::isNumericValid($this->tax320) === false) {
			Debug::debug(get_class(), "validate", "Tax320 is not integer");
			$validated[ 'tax320' ] = gettext( 'Please use numeric values!' );
		}
		
		if (empty($validated)) {
			$validated = true;
		}
		
		return $validated;
	}
	
	/**
	 * Display VAT object in html form (table rows)
	 * Display possible value and error message too.
	 * 
	 * Has 3 different scenes:
	 * - empty form
	 * - field with precompleted information 
	 * - field with precompleted information (variableValue) and error messages (from $errors array)
	 * 
	 * @access private
	 * @param  string $fieldText
	 * @param  string $fieldName
	 * @param  string $variableName
	 * @param  string $variableValue
	 * @param  array  $errors
	 * @return string $content         content in html format
	 */
	public function displayObjectWithPossibleErrorsInForm( $errors = false ) {
		$content = '';
		
		// special rows with first <td> is empty
		$content .= $this->getSpecialFormInputField( $this->getOneDescription('301'), '301', 'tax301', $this->getTax301(), $errors );
		$content .= $this->getSpecialFormInputField( $this->getOneDescription('302'), '302', 'tax302', $this->getTax302(), $errors );
		$content .= $this->getSpecialFormInputField( $this->getOneDescription('303'), '303', 'tax303', $this->getTax303(), $errors );
			
		// normal rows
		$content .= $this->getFormInputField($this->getOneDescription('305'), '305', 'tax305', $this->getTax305(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('306'), '306', 'tax306', $this->getTax306(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('318'), '318', 'tax318', $this->getTax318(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('307'), '307', 'tax307', $this->getTax307(), $errors);
		
		$content .= "<tr class='greenBG'>
						<td class='orange bold'>308</td>
						<td colspan='2' class='bold'>". $this->getOneDescription('308') ."</td>
						<td>". $this->getTax308() ."</td>
						<td><input type='submit' value='". gettext('Count') ."' name='count' /></td>
					</tr>";
		
		$content .= $this->getFormInputField($this->getOneDescription('309'), '309', 'tax309', $this->getTax309(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('311'), '311', 'tax311', $this->getTax311(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('312'), '312', 'tax312', $this->getTax312(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('313'), '313', 'tax313', $this->getTax313(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('314'), '314', 'tax314', $this->getTax314(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('319'), '319', 'tax319', $this->getTax319(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('320'), '320', 'tax320', $this->getTax320(), $errors);
		
		return $content;
	}
	
	/**
	 * Display object in form with existing object values and input field for new object values.
	 * When entering error array, display possible errors too.
	 * 
	 * @access private
	 * @param  VAT 	  $existingObject
	 * @param  array  $errors
	 * @return string $content         content in html format
	 */
	public function displayObjectWithInputsAndPossibleExistingInfoAndErrorsInForm( VAT $existingObject, $errors = false ) {
		$content = '';
		
		// special rows with first <td> is empty
		$content .= $this->getSpecialFormInputFieldWithValue( $this->getOneDescription('301'), '301', 'tax301', 
						$existingObject->getTax301(), $this->getTax301(), $errors );
		$content .= $this->getSpecialFormInputFieldWithValue( $this->getOneDescription('302'), '302', 'tax302', 
						$existingObject->getTax302(), $this->getTax302(), $errors );
		$content .= $this->getSpecialFormInputFieldWithValue( $this->getOneDescription('303'), '303', 'tax303', 
						$existingObject->getTax303(), $this->getTax303(), $errors );
			
		// normal rows
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('305'), '305', 'tax305', 
						$existingObject->getTax305(), $this->getTax305(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('306'), '306', 'tax306', 
						$existingObject->getTax306(), $this->getTax306(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('318'), '318', 'tax318', 
						$existingObject->getTax318(), $this->getTax318(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('307'), '307', 'tax307', 
						$existingObject->getTax307(), $this->getTax307(), $errors);
		
		$content .= "<tr class='greenBG'>
						<td class='orange bold'>308</td>
						<td colspan='2' class='bold'>". $this->getOneDescription('308') ."</td>
						<td>". $existingObject->getTax308() ."</td>
						<td>". $this->getTax308() ."</td>
						<td><input type='submit' value='". gettext('Count') ."' name='count' /></td>
					</tr>";
		
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('309'), '309', 'tax309', 
						$existingObject->getTax309(), $this->getTax309(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('311'), '311', 'tax311', 
						$existingObject->getTax311(), $this->getTax311(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('312'), '312', 'tax312', 
						$existingObject->getTax312(), $this->getTax312(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('313'), '313', 'tax313', 
						$existingObject->getTax313(), $this->getTax313(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('314'), '314', 'tax314', 
						$existingObject->getTax314(), $this->getTax314(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('319'), '319', 'tax319', 
						$existingObject->getTax319(), $this->getTax319(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('320'), '320', 'tax320', 
						$existingObject->getTax320(), $this->getTax320(), $errors);
		
		return $content;
	}
	
	/**
	 * Display object summary in html format.
	 * Show object information in html table. User can not modify this information.
	 *
	 * @access public
	 * @return string  $content   content in html format
	 */
	public function displayObjectSummaryInHtml() {
		$content = '';
		
		$content .= $this->getSpecialTextField($this->getOneDescription('301'), "301", $this->getTax301());
		$content .= $this->getSpecialTextField($this->getOneDescription('302'), "302", $this->getTax302());
		$content .= $this->getSpecialTextField($this->getOneDescription('303'), "303", $this->getTax303());
		$content .= $this->getTextField($this->getOneDescription('305'), "305", $this->getTax305());
		$content .= $this->getTextField($this->getOneDescription('306'), "306", $this->getTax306());
		$content .= $this->getTextField($this->getOneDescription('318'), "318", $this->getTax318());
		$content .= $this->getTextField($this->getOneDescription('307'), "307", $this->getTax307());
		
		// special row with green bg and bolded text
		$content .= "<tr class='greenBG'>
					<td class='bold'>308</td>
					<td colspan='2' class='bold'>". $this->getOneDescription('308') ."</td>
					<td>". $this->getTax308() ."</td>
					<td></td>
				</tr>";
		
		$content .= $this->getTextField($this->getOneDescription('309'), '309', $this->getTax309() );
		$content .= $this->getTextField($this->getOneDescription('311'), '311', $this->getTax311() );
		$content .= $this->getTextField($this->getOneDescription('312'), '312', $this->getTax312() );
		$content .= $this->getTextField($this->getOneDescription('313'), '313', $this->getTax313() );
		$content .= $this->getTextField($this->getOneDescription('314'), '314', $this->getTax314() );
		$content .= $this->getTextField($this->getOneDescription('319'), '319', $this->getTax319() );
		$content .= $this->getTextField($this->getOneDescription('320'), '320', $this->getTax320() );
		
		return $content;
	}
	
	/**
	 * Display one special table row. First <td> is empty.
	 * Display possible value and error message too.
	 * 
	 * Has 3 different scenes:
	 * - empty form
	 * - field with precompleted information 
	 * - field with precompleted information (variableValue) and error messages (from $errors array)
	 * 
	 * @access private
	 * @param  string $fieldText
	 * @param  string $fieldName
	 * @param  string $variableName
	 * @param  string $variableValue
	 * @param  array $errors
	 * @return string $content         content in html format
	 */
	private function getSpecialFormInputField( $fieldText, $fieldName, $variableName, $variableValue, $errors = false ) {
		$content = '';
		$variableNameTemp = ucfirst($variableName);
		
		if (is_array($errors) and isset($errors[ $variableName ])) {
			$content .= "<tr class='incorrect'>
							<td colspan='3' class='noBorder'></td>
							<td colspan='2' class='noBorder'>". $errors[ $variableName ] ."</td>
						</tr>";
		}
			
		$content .=	"<tr>
						<td></td>
						<td class='orange bold'>$fieldName</td>
						<td>$fieldText</td>
						<td><input type='text' size='10' maxlength='13' name='$variableName' value='$variableValue' /></td>
						<td></td>
					</tr>";
		
		return $content;
	}
	
	/**
	 * Display one special table row. First <td> is empty.
	 * Display possible value and error message too.
	 * 
	 * Has 3 different scenes:
	 * - empty form
	 * - field with precompleted information 
	 * - field with precompleted information (variableValue) and error messages (from $errors array)
	 * 
	 * @access private
	 * @param  string $fieldText
	 * @param  string $fieldName
	 * @param  string $variableName
	 * @param  string $existingObjectsValue
	 * @param  string $variableValue
	 * @param  array  $errors
	 * @return string $content         content in html format
	 */
	private function getSpecialFormInputFieldWithValue( $fieldText, $fieldName, $variableName, $existingObjectsValue, $variableValue, $errors = false ) {
		$content = '';
		$variableNameTemp = ucfirst($variableName);
		
		if (is_array($errors) and isset($errors[ $variableName ])) {
			$content .= "<tr class='incorrect'>
							<td colspan='4' class='noBorder'></td>
							<td colspan='2' class='noBorder'>". $errors[ $variableName ] ."</td>
						</tr>";
		}
			
		$content .=	"<tr>
						<td></td>
						<td class='orange bold'>$fieldName</td>
						<td>$fieldText</td>
						<td>$existingObjectsValue</td>
						<td><input type='text' size='10' maxlength='13' name='$variableName' value='$variableValue' /></td>
						<td></td>
					</tr>";
		
		return $content;
	}
	
	/**
	 * Display one special table row (text). First <td> is empty.
	 * 
	 * @access private
	 * @param string  $fieldText
	 * @param string  $fieldName
	 * @param string  $value
	 * @return string $content      content in html format
	 */
	private function getSpecialTextField( $fieldText,$fieldName, $value ) {
		$content = '';
		if (!empty($value)) {
			$content =	"<tr>
							<td></td>
							<td>$fieldName</td>
							<td>$fieldText</td>
							<td>$value</td>
							<td></td>
						</tr>";
		}
		
		return $content;
	}
	
	/**
	 * Count sum for VAT 
	 * Sum up notable fields (301, 302, 303, 305, 306 and 318) and decrease tax307.
	 */
	public function countSum() {
		$sum = $this->tax301 + $this->tax302 + $this->tax303 + $this->tax305 + $this->tax306 + $this->tax318 - $this->tax307;
		
		return $sum;
	}
	
	/**
	 * Set descriptions to descriptions array.
	 * Used because of the gettext method.
	 */
	private function setDescriptions() {

		$this->descriptions = array( "301" => gettext('23% tax')
								, "302" => gettext('13% tax')
								, "303" => gettext('9% tax')
								, "305" => gettext('Tax from products from EU')
								, "306" => gettext('Tax from services from EU')
								, "318" => gettext('Tax from construction services (reverse charge)')
								, "307" => gettext('Deductible tax')
								, "308" => gettext('Returnable/payable tax')
								, "sum" => gettext('Returnable/payable tax')
								, "309" => gettext('Sales, 0% tax')
								, "311" => gettext('Product sales to EU')
								, "312" => gettext('Service sales to EU')
								, "313" => gettext('Product purchase from EU')
								, "314" => gettext('Service purchase from EU')
								, "319" => gettext('Sales from construction services (reverse charge)')
								, "320" => gettext('Purchases from construction services (reverce charge)') );
	}
	
	// getters and setters
	
	public function getTax301() {
		if (isset($this->tax301)) {
			return $this->tax301;
		}
	}
	
	public function setTax301( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax301 = $tax;
	}
	
	public function getTax302() {
		if (isset($this->tax302)) {
			return $this->tax302;
		}
	}
	
	public function setTax302( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax302 = $tax;
	}
	
	public function getTax303() {
		if (isset($this->tax303)) {
			return $this->tax303;
		}
	}
	
	public function setTax303( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax303 = $tax;
	}
	
	public function getTax305() {
		if (isset($this->tax305)) {
			return $this->tax305;
		}
	}
	
	public function setTax305( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax305 = $tax;
	}
	
	public function getTax306() {
		if (isset($this->tax306)) {
			return $this->tax306;
		}
	}
	
	public function setTax306( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax306 = $tax;
	}
	
	public function getTax318() {
		if (isset($this->tax318)) {
			return $this->tax318;
		}
	}
	
	public function setTax318( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax318 = $tax;
	}
	
	public function getTax307() {
		if (isset($this->tax307)) {
			return $this->tax307;
		}
	}
	
	public function setTax307( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax307 = $tax;
	}
	
	public function getTax308() {
		if (isset($this->tax308)) {
			return $this->tax308;
		}
	}
	
	public function setTax308( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax308 = $tax;
	}
	
	public function getTax309() {
		if (isset($this->tax309)) {
			return $this->tax309;
		}
	}
	
	public function setTax309( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax309 = $tax;
	}
	
	public function getTax311() {
		if (isset($this->tax311)) {
			return $this->tax311;
		}
	}
	
	public function setTax311( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax311 = $tax;
	}
	
	public function getTax312() {
		if (isset($this->tax312)) {
			return $this->tax312;
		}
	}
	
	public function setTax312( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax312 = $tax;
	}
	
	public function getTax313() {
		if (isset($this->tax313)) {
			return $this->tax313;
		}
	}
	
	public function setTax313( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax313 = $tax;
	}
	
	public function getTax314() {
		if (isset($this->tax314)) {
			return $this->tax314;
		}
	}
	
	public function setTax314( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax314 = $tax;
	}
	
	public function getTax319() {
		if (isset($this->tax319)) {
			return $this->tax319;
		}
	}
	
	public function setTax319( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax319 = $tax;
	}
	
	public function getTax320() {
		if (isset($this->tax320)) {
			return $this->tax320;
		}
	}
	
	public function setTax320( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax320 = $tax;
	}
	
	public function setSum( $sum ) {
		if (DataValidator::isNumericValid($sum)) {
			$sum = Format::formatDecimal($sum);
			$this->sum = $sum;
			$this->tax308 = $sum;
		}
	}
	
	public function getObjectVariables(){
		return get_object_vars($this);
	}
	
	public function toString() {
		print "<p>VAT <br/>
				Tax301: $this->tax301 <br/>
				Tax302: $this->tax302 <br/>
				Tax303: $this->tax303 <br/>
				Tax305: $this->tax305 <br/>
				Tax306: $this->tax306 <br/>
				Tax318: $this->tax318 <br/>
				Tax307: $this->tax307 <br/>
				Tax308: $this->tax308 <br/>
				Tax309: $this->tax309 <br/>
				Tax311: $this->tax311 <br/>
				Tax312: $this->tax312 <br/>
				Tax313: $this->tax313 <br/>
				Tax314: $this->tax314 <br/>
				Tax319: $this->tax319 <br/>
				Tax320: $this->tax320 <br/>
				TargetPeriod: $this->targetPeriod <br/>
				ReferenceNumber: $this->referenceNumber <br/>
				Author: $this->author </p>";
	}
}
?>