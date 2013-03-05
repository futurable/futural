<?php
/**
 *  Transaction.php
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
 * Transaction.php
 * 
 * @package   Model
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-21
 */
abstract class Transaction {
	protected $targetPeriod;
	protected $referenceNumber;
	protected $author;
	protected $declarationID;
	protected $sum;
	protected $createDate;
	protected $descriptions;
	
	public function __construct() {
		
	}
	
	/**
	 * Fill Transaction object from array.
	 * Check if parameter array has key with same name than objects attribute. If so, fills that attribute.
	 * 
	 * This function is called in sub classes and they accomplish object filling.
	 * 
	 * @access public
	 * @param Transaction $object
	 * @param array $array
	 */
	public function fillObjectFromArray( Transaction $object, $array ) {
		Debug::debug(get_class(), "fillObjectFromArray", "Start");
		
		if (is_array($array)) {
			Debug::debug(get_class(), "fillObjectFromArray", "Parameter array is array.", 2);
			
			if (isset($array[ 'targetPeriod' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "targetPeriod is in array", 3);
				$this->setTargetPeriod( $array[ 'targetPeriod' ] );
			}
			if (isset($array[ 'referenceNumber' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "referenceNumber is in array", 3);
				$this->setReferenceNumber( $array[ 'referenceNumber' ] );
			}
			if (isset($array[ 'author' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "author is in array", 3);
				$this->setAuthor( $array[ 'author' ] );
			}
			if (isset($array[ 'declarationID' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "declarationID is in array", 3);
				$this->setDeclarationID( $array[ 'declarationID' ] );
			}
			if (isset($array[ 'createDate' ])) {
				Debug::debug(get_class(), "fillObjectFromArray", "createDate is in array", 3);
				$this->setCreateDate( $array[ 'createDate' ] );
			}
		}
	}
	
	/**
	 * Validate Transaction object.
	 * Actual implementation is in sub classes.
	 * 
	 * @access public
	 */
	public abstract function validate();
	
	/**
	 * Display one form row.
	 * Display possible value and error message too.
	 * 
	 * Has 3 different scenes:
	 * - empty form
	 * - field with precompleted information 
	 * - field with precompleted information (variableValue) and error messages (from $errors array)
	 * 
	 * Example without error or value:
	 * <tr>
	 *	  <td class='orange bold'>305</td>
	 *	  <td>Vero tavaraostoista muista EU-maista</td>
	 *	  <td><input type='text' size='10' maxlength='13' name='tax301' value='' /></td>
	 *	  <td></td>
	 * </tr>
	 * 
	 * @param string $fieldText
	 * @param string $fieldName
	 * @param string $variableName
	 * @param string $variableValue
	 * @param array $errors
	 */
	protected function getFormInputField( $fieldText, $fieldName, $variableName, $variableValue = false, $errors = false ) {
		$content = '';
		$variableNameTemp = ucfirst($variableName);
		
		if (is_array($errors) and isset($errors[ $variableName ])) {
		$content .= "<tr class='incorrect'>
						<td colspan='3' class='noBorder'></td>
						<td colspan='2' class='noBorder'>". $errors[ $variableName ] ."</td>
					</tr>";
		}
		
		$content .=	"<tr>
						<td class='orange bold'>$fieldName</td>
						<td colspan='2'>$fieldText</td>
						<td><input type='text' size='10' maxlength='13' name='$variableName' value='$variableValue' /></td>
						<td></td>
					</tr>";
		
		return $content;
	}
	
	/**
	 * Display one form row when there is also exsiting object in form.
	 * Display possible value and error message too.
	 * 
	 * Has 3 different scenes:
	 * - empty form
	 * - field with precompleted information 
	 * - field with precompleted information (variableValue) and error messages (from $errors array)
	 * 
	 * Example without error or precompleted value:
	 * <tr>
	 *     <td class='orange bold'>305</td>
	 *     <td colspan='2'>Vero tavaraostoista muista EU-maista</td>
	 *     <td>28.00</td>
	 *     <td><input type='text' size='10' maxlength='13' name='tax305' value='' /></td>
	 *     <td></td>
	 * </tr>
	 * 
	 * @param string $fieldText
	 * @param string $fieldName
	 * @param string $variableName
	 * @param string $existingObjectsValue
	 * @param string $variableValue
	 * @param array  $errors
	 */
	protected function getFormInputFieldWithValue( $fieldText, $fieldName, $variableName, $existingObjectsValue, $variableValue, $errors = false ) {
		$content = '';
		$variableNameTemp = ucfirst($variableName);
		
		if (is_array($errors) and isset($errors[ $variableName ])) {
			$content .= "<tr class='incorrect'>
							<td colspan='4' class='noBorder'></td>
							<td colspan='2' class='noBorder'>". $errors[ $variableName ] ."</td>
						</tr>";
		}
			
		$content .=	"<tr>
						<td class='orange bold'>$fieldName</td>
						<td colspan='2'>$fieldText</td>
						<td>$existingObjectsValue</td>
						<td><input type='text' size='10' maxlength='13' name='$variableName' value='$variableValue' /></td>
						<td></td>
					</tr>";
		
		return $content;
	}
	
	/**
	 * Display one table row (text).
	 * 
	 * @access protected
	 * @param  string $fieldText
	 * @param  string $fieldName
	 * @param  string $value
	 * @return string $content     content on html format
	 */
	protected function getTextField( $fieldText,$fieldName, $value ) {
		$content = '';
		if (!empty($value)) {
			$content =	"<tr>
							<td>$fieldName</td>
							<td colspan='2'>$fieldText</td>
							<td>$value</td>
							<td></td>
						</tr>";
		}
		
		return $content;
	}
	
/**
	 * Display Transactions declaration header information in html format.
	 * 
	 * @access public
	 * @param  Transaction $vat
	 * @param  User        $user
	 * @return string      $content    content in html
	 */
	public function displayObjectSummaryHeaderInHtml(Transaction $transaction, User $user) {
		$content = "<div class='textArea'>\n
						<table id='declarationInfo'>\n
							<tr class='bold'>\n
								<td>". gettext('kausivero') ."</td>\n
								<td>". gettext('Tax payer') ."</td>\n
								<td>". gettext('Notifier') ."</td>\n
							</tr>\n
							<tr>\n
								<td>". gettext('Value added tax') ."</td>\n
								<td>". $user->getCurrentCompany()->getCompanyName() ."</td>\n
								<td>". $user->getName() ."</td>\n
							</tr>\n
							<tr>\n
								<td></td>\n
								<td>". $user->getCurrentCompany()->getBusinessId() ."</td>\n
								<td></td>\n
							</tr>\n
							<tr class='bold'>\n
								<td>". gettext('Declaration period') ."</td>\n
								<td>". gettext('Target season') ."</td>\n
								<td></td>\n
							</tr>\n
							<tr>\n
								<td>". gettext('Month') ."</td>\n
								<td>". $transaction->getTargetPeriod() ."</td>\n
								<td></td>\n
							</tr>\n
						</table>
					</div><!-- /textArea -->";
		
		return $content;
	}
	
	
	// setters and getters
	public function getTargetPeriod() {
		if (isset($this->targetPeriod)) {
			return $this->targetPeriod;
		}
	}
	
	public function setTargetPeriod( $period ) {
		// TODO: tarkista periodi
		$this->targetPeriod = $period;
	}
	
	public function getReferenceNumber() {
		if (isset($this->referenceNumber)) {
			return $this->referenceNumber;
		}
	}
	
	public function setReferenceNumber( $referenceNumber ) {
		if(DataValidator::isReferenceNumberValid($referenceNumber)){
			$this->referenceNumber = $referenceNumber;
		}
	}
	
	public function getAuthor() {
		if (isset($this->author)) {
			return $this->author;
		}
	}
	
	public function setAuthor( $author ) {
		if(is_string($author)){
			$this->author = $author;
		}
	}
	
	public function getDeclarationID() {
		if (isset($this->declarationID)){
			return $this->declarationID;
		}
	}
	
	public function setDeclarationID( $declarationID ){
		if(DataValidator::isStringValid($declarationID, 18)){
			$this->declarationID = $declarationID;
		}
	}

	public function getSum() {
		if (isset($this->sum)) {
			return $this->sum;
		}
	}
	
	public function setSum( $sum ) {
		if (DataValidator::isNumericValid($sum)) {
			$this->sum = $sum;
		}
	}
	
	public function getDescriptions() {
		if (isset($this->descriptions)) {
			return $this->descriptions;
		}
	}
	
	public function getOneDescription( $key ) {
		if (isset($this->descriptions) 
			and (DataValidator::isPositiveIntValid($key) or DataValidator::isStringValid( $key ))) {
			return $this->descriptions[ $key ];
		}
	}
	
	public function getCreateDate() {
		if (isset($this->createDate)) {
			return $this->createDate;
		}
	}
	
	public function setCreateDate( $date ){
		if (DataValidator::isDateISOSyntaxValid($date) or DataValidator::isDateEUROSyntaxValid($date)) {
			$this->createDate = $date;
		} 
	}
	
}

?>