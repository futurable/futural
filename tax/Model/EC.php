<?php
/**
 *  EC.php
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
require_once 'Data/ECDataMapper.php';

/**
 * EC.php
 * 
 * @package   Model
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-21
 */
class EC extends Transaction {
	
	private $tax601; // TODO: Ennakonpidätyksen alaiset palkat ja muut suoritukset
	private $tax602; // TODO: Toimitettu ennakonpidätys
	private $tax605; // TODO: Lähdeveron alaiset palkat ja muut suoritukset 
	private $tax606; // TODO: Lähdevero palkoista yms.
	private $tax609; // TODO: Sosiaaliturvamaksun alaiset palkat
	private $tax610; // TODO: Maksettava työnantajan sosiaaliturvamaksu
	private $tax608; // returnable/payable tax
	
	public $dataMapper;
	
	public function __construct() {
		parent::__construct();
		
		$this->setDescriptions();
		$this->dataMapper = new ECDataMapper();
	}
	
	/**
	 * Fill EC object from array.
	 * @see Transaction::fillObjectFromArray()
	 */
	public function fillObjectFromArray( Transaction $object, $array ) {
		Debug::debug(get_class(), "fillObjectFromArray", "Start");
		parent::fillObjectFromArray($object, $array);
		
		if ( $object instanceof EC and is_array($array) ) {
			Debug::debug(get_class(), "fillObjectFromArray", "Parameter array is array", 2);
			
			if ( isset($array[ 'tax601' ]) and (!empty($array[ 'tax601'] ) or $array[ 'tax601' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax601 is in array", 3);
				$this->setTax601( $array[ 'tax601' ] );
			}
			if ( isset($array[ 'tax602' ]) and (!empty($array[ 'tax602'] ) or $array[ 'tax602' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax602 is in array", 3);
				$this->setTax602( $array[ 'tax602' ] );
			}
			if ( isset($array[ 'tax605' ]) and (!empty($array[ 'tax605'] ) or $array[ 'tax605' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax605 is in array", 3);
				$this->setTax605( $array[ 'tax605' ] );
			}
			if ( isset($array[ 'tax606' ]) and (!empty($array[ 'tax606'] ) or $array[ 'tax606' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax606 is in array", 3);
				$this->setTax606( $array[ 'tax606' ] );
			}
			if ( isset($array[ 'tax608' ]) and (!empty($array[ 'tax608'] ) or $array[ 'tax608' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax608 is in array", 3);
				$this->setTax608( $array[ 'tax608' ] );
				$this->setSum( $array[ 'tax608' ] );
			}
			if ( isset($array[ 'tax609' ]) and (!empty($array[ 'tax609'] ) or $array[ 'tax609' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax609 is in array", 3);
				$this->setTax609( $array[ 'tax609' ] );
			}
			if ( isset($array[ 'tax610' ]) and (!empty($array[ 'tax610'] ) or $array[ 'tax610' ] === '0') ) {
				Debug::debug(get_class(), "fillObjectFromArray", "tax610 is in array", 3);
				$this->setTax610( $array[ 'tax610' ] );
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
		
		if ( isset($this->tax601) and DataValidator::isNumericValid($this->tax601) === false) {
			Debug::debug(get_class(), "validate", "Tax601 is not integer");
			$validated[ 'tax601' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax602) and DataValidator::isNumericValid($this->tax602) === false) {
			Debug::debug(get_class(), "validate", "Tax602 is not integer");
			$validated[ 'tax602' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax605) and DataValidator::isNumericValid($this->tax605) === false) {
			Debug::debug(get_class(), "validate", "Tax605 is not integer");
			$validated[ 'tax605' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax606) and DataValidator::isNumericValid($this->tax606) === false) {
			Debug::debug(get_class(), "validate", "Tax606 is not integer");
			$validated[ 'tax606' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax609) and DataValidator::isNumericValid($this->tax609) === false) {
			Debug::debug(get_class(), "validate", "Tax609 is not integer");
			$validated[ 'tax609' ] = gettext( 'Please use numeric values!' );
		}
		if ( isset($this->tax610) and DataValidator::isNumericValid($this->tax610) === false) {
			Debug::debug(get_class(), "validate", "Tax610 is not integer");
			$validated[ 'tax610' ] = gettext( 'Please use numeric values!' );
		}
		if (isset($array[ 'declarationID' ])) {
			Debug::debug(get_class(), "fillObjectFromArray", "declarationID is in array", 3);
			$this->setDeclarationID( $array[ 'declarationID' ] );
		}
		
		if (empty($validated)) {
			$validated = true;
		}
		
		return $validated;
	}
	
	/**
	 * Display EC object in html form (table rows)
	 * Display possible value and error message too.
	 * 
	 * Has 3 different scenes:
	 * - empty form
	 * - field with precompleted information 
	 * - field with precompleted information (variableValue) and error messages (from $errors array)
	 * 
	 * @access public
	 * @param  string $fieldText
	 * @param  string $fieldName
	 * @param  string $variableName
	 * @param  string $variableValue
	 * @param  array  $errors
	 * @return string $content
	 */
	public function displayObjectWithPossibleErrorsInForm( $errors = false ) {
		$content ='';
		
		// normal rows
		$content .= $this->getFormInputField($this->getOneDescription('601'), '601', 'tax601', $this->getTax601(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('602'), '602', 'tax602', $this->getTax602(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('605'), '605', 'tax605', $this->getTax605(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('606'), '606', 'tax606', $this->getTax606(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('609'), '609', 'tax609', $this->getTax609(), $errors);
		$content .= $this->getFormInputField($this->getOneDescription('610'), '610', 'tax610', $this->getTax610(), $errors);
		
		$content .= "<tr class='greenBG'>
						<td></td>
						<td colspan='2' class='bold'>". $this->getOneDescription('608') ."</td>
						<td>". $this->getTax608() ."</td>
						<td><input type='submit' value='". gettext('Count') ."' name='count' /></td>
					</tr>";
		
		return $content;
	}
	
/**
	 * Display object in form with existing object values and input field for new object values.
	 * When entering error array, display possible errors too.
	 * 
	 * @access public
	 * @param  EC 	  $existingObject
	 * @param  array  $errors
	 * @return string $content         content in html format
	 */
	public function displayObjectWithInputsAndPossibleExistingInfoAndErrorsInForm( EC $existingObject, $errors = false ) {
		$content = '';
			
		// normal rows
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('601'), '601', 'tax601', 
						$existingObject->getTax601(), $this->getTax601(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('602'), '602', 'tax602', 
						$existingObject->getTax602(), $this->getTax602(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('605'), '605', 'tax605', 
						$existingObject->getTax605(), $this->getTax605(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('606'), '606', 'tax606', 
						$existingObject->getTax606(), $this->getTax606(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('609'), '609', 'tax609', 
						$existingObject->getTax609(), $this->getTax609(), $errors);
		$content .= $this->getFormInputFieldWithValue($this->getOneDescription('610'), '610', 'tax610', 
						$existingObject->getTax610(), $this->getTax610(), $errors);
		
		$content .= "<tr class='greenBG'>
						<td></td>
						<td colspan='2' class='bold'>". $this->getOneDescription('608') ."</td>
						<td>". $existingObject->getTax608() ."</td>
						<td>". $this->getTax608() ."</td>
						<td><input type='submit' value='". gettext('Count') ."' name='count' /></td>
					</tr>";
		
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
		
		$content .= $this->getTextField($this->getOneDescription('601'), "601", $this->getTax601());
		$content .= $this->getTextField($this->getOneDescription('602'), "602", $this->getTax602());
		$content .= $this->getTextField($this->getOneDescription('605'), "605", $this->getTax605());
		$content .= $this->getTextField($this->getOneDescription('606'), "606", $this->getTax606());
		$content .= $this->getTextField($this->getOneDescription('609'), '609', $this->getTax609() );
		$content .= $this->getTextField($this->getOneDescription('610'), '610', $this->getTax610() );
		
		// special row with green bg and bolded text
		$content .= "<tr class='greenBG'>
					<td></td>
					<td colspan='2' class='bold'>". $this->getOneDescription('sum') ."</td>
					<td>". $this->getSum() ."</td>
					<td></td>
				</tr>";
		
		return $content;
	}
	
	/**
	 * Set descriptions to descriptions array.
	 * Used because of the gettext method.
	 */
	private function setDescriptions() {
		// TODO: englanniksi
		$this->descriptions = array( "601" => gettext("Ennakonpidätyksen alaiset palkat ja muut suoritukset")
								, "602" => gettext("Toimitettu ennakonpidätys")
								, "605" => gettext("Lähdeveron alaiset palkat ja muut suoritukset")
								, "606" => gettext("Lähdevero palkoista yms.")
								, "609" => gettext("Sosiaaliturvamaksun alaiset palkat")
								, "610" => gettext("Maksettava työnantajan sosiaaliturvamaksu")
								, "608" => gettext("Returnable/payable tax")
								, "sum" => gettext("Returnable/payable tax") );
								
	}
	
	/**
	 * Count sum for EC 
	 * Sum up notable fields (301, 302, 303, 305, 306 and 318) and decrease tax307.
	 */
	public function countSum() {
		$sum = $this->tax602 + $this->tax606 + $this->tax610;
		
		return $sum;
	}
	
	// getters and setters
	
	public function getTax601() {
		if (isset($this->tax601)) {
			return $this->tax601;
		}
	}
	
	public function setTax601( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax601 = $tax;
	}
	
	public function getTax602() {
		if (isset($this->tax602)) {
			return $this->tax602;
		}
	}
	
	public function setTax602( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax602 = $tax;
	}
	
	public function getTax605() {
		if (isset($this->tax605)) {
			return $this->tax605;
		}
	}
	
	public function setTax605( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax605 = $tax;
	}
	
	public function getTax606() {
		if (isset($this->tax606)) {
			return $this->tax606;
		}
	}
	
	public function setTax606( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax606 = $tax;
	}

	public function getTax609() {
		if (isset($this->tax609)) {
			return $this->tax609;
		}
	}
	
	public function setTax609( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax609 = $tax;
	}
	
	public function getTax610() {
		if (isset($this->tax610)) {
			return $this->tax610;
		}
	}
	
	public function setTax610( $tax ) {
		$tax = Format::formatDecimal($tax);
		$this->tax610 = $tax;
	}
	
	public function getTax608() {
		if (isset($this->tax608)) {
			return $this->tax608;
		}
	}
	
	public function setTax608( $sum ) {
		$sum = Format::formatDecimal($sum);
		$this->tax608 = $sum;
	}
	
	public function setSum( $sum ) {
		if (DataValidator::isNumericValid($sum)) {
			$sum = Format::formatDecimal($sum);
			$this->sum = $sum;
			$this->tax608 = $sum;
		}
	}
	
	public function getObjectVariables(){
		return get_object_vars($this);
	}
	
	public function toString() {
		print "<p>EC <br/>
				Tax601: $this->tax601 <br/>
				Tax602: $this->tax602 <br/>
				Tax605: $this->tax605 <br/>
				Tax606: $this->tax606 <br/>
				Tax609: $this->tax609 <br/>
				Tax610: $this->tax610 <br/>
				Tax608: $this->tax608 <br/>
				SUM: $this->sum <br/>
				TargetPeriod: $this->targetPeriod <br/>
				ReferenceNumber: $this->referenceNumber <br/>
				Author: $this->author </p>";
	}
}
?>