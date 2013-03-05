<?php
/**
 *  VATDeclarationContent.php
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

require_once 'Model/VAT.php';

/**
 * VATDeclarationContent.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-22
 */

class VATDeclarationContent extends Content {
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * Display VAT Declaration content
	 * @see Content::doDisplayInHtml()
	 */
	protected function doDisplayInHtml( User $userObject ) {
		Debug::debug(get_class(), "doDisplayInHtml", "Start");
		
		$content = "<h1>". gettext('Declaration - Value added tax declaration') ."</h1>\n";
		
		// user has pressed "Count" or "Correct declaration"
		if ( (isset($_POST['count']) and $_POST['count']) or 
			(isset($_POST['correct']) and $_POST['correct']) ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Count/Correct pressed", 2);
			
			$vat = new VAT();
			if ( isset($_POST['correct']) and $_POST['correct'] ) {
				Debug::debug(get_class(), "doDisplayInHtml", "Correct pressed", 3);
				$vat = unserialize( base64_decode( $_POST[ 'object' ] ) );
			} else {
				Debug::debug(get_class(), "doDisplayInHtml", "Correct is not pressed", 3);
				$vat->fillObjectFromArray($vat, $_POST);
			}
			
			$validated = $vat->validate();
			
			// if validated is true, count tax308 and print form with object info
			if ($validated === true) {
				Debug::debug(get_class(), "doDisplayInHtml", "Validated = $validated", 3);
				// count tax sum (returnable/payable)
				$tax308 = $vat->countSum();
				$vat->setTax308($tax308);
				
				$content .= $this->displayFormContent($vat);
			} 
			// validated is not true, print form with object info and errors
			else {
				Debug::debug(get_class(), "doDisplayInHtml", "Validated = $validated", 3);
				$content .= $this->displayFormContent($vat, $validated);
			} 
		} 
		// user has pressed "Continue"
		else if ( (isset($_POST['continue']) and $_POST['continue']) ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Continue pressed", 2);
			
			$vat = new VAT();
			$vat->fillObjectFromArray($vat, $_POST);
			
			// count tax308
			$tax308 = $vat->countSum();
			$vat->setTax308($tax308);
			
			$validated = $vat->validate();
			
			if ($validated === true) {
				$content .= $this->displayObjectSummaryAndForm($vat, $userObject);
			} else {
				$content .= $this->displayFormContent($vat, $validated);
			}
		}
		// else if user has pressed save
		else if ( (isset($_POST['save']) and $_POST['save']) ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Save pressed", 2);
			// save object
			$vat = new VAT();
			$vat = unserialize( base64_decode( $_POST[ 'object' ] ) );
			
			$successful = $vat->dataMapper->save( $vat );
			
			if ($successful === true) {
				Debug::debug(get_class(), "doDisplayInHtml", "Successful = $successful", 3);
				$content .= "<p class='bold'>". gettext('Kausiveroilmoitus on vastaanotettu') ."</p>";
			} else {
				Debug::debug(get_class(), "doDisplayInHtml", "Successful = $successful", 3);
				$content .= "<p>". gettext('Something wrong. Please try again later.') ."</p>";
			}
		}
		// first time
		else {
			Debug::debug(get_class(), "doDisplayInHtml", "Nothing pressed", 2);
			$vat = new VAT();
			$content .= $this->displayFormContent($vat);
		}
		
		return $content;
	}
	
	/**
	 * Display VAT Declaration form.
	 * Has 3 different scenes:
	 * - empty form
	 * - form with precompleted information (from VAT object)
	 * - form with precompleted information (from VAT object) and error messages (from $errors array)
	 * 
	 * @param VAT $vat
	 * @param array $errors
	 */
	private function displayFormContent(VAT $vat, $errors = false) {
		
		$content = "
			<div id='form'>
				<form action='' method='post'>";
		$content .= $this->getDeclarationMonthsContent();
		$content .= "<table id='TaxForm'>
						<tr class='greenBG'>
							<td colspan='3'></td>
							<td>". gettext('Euros') ."</td>
							<td></td>
						</tr>
						<tr>
							<td colspan='5'>". gettext('TODO: Vero kotimaan myynnistä verokannoittain') ."</td>
						</tr>"; 
		
		if (is_array($errors)) {
			// vat displays itself with precompleted information and possible error messages
			$content .= $vat->displayObjectWithPossibleErrorsInForm( $errors );
		} else {
			// vat displays itself in empty form
			$content .= $vat->displayObjectWithPossibleErrorsInForm();
		}

		// buttons
		$content .= "</table>
						<div id='bottonButtons'>
							<p class='leftButton'>&nbsp;</p>
							<p class='middleButton'><input type='submit' name='cancel' value='". gettext('Cancel') ."' class='buttonLikeLink'/></p>
							<p class='rightButton'><input type='submit' name='continue' value='". gettext('Continue') ."' /></p>
						</div>
					</form>
				</div><!-- /form -->
				";
		
		return $content;
	}
	
	/**
	 * Display object summary in html format.
	 * Show object information in html table. User can not modify this information.
	 * This summary has form too. Form includes serialized object.
	 * 
	 * @param VAT $vat
	 * @param User $user
	 */
	private function displayObjectSummaryAndForm(VAT $transaction, User $user) {
		// Set declarationID
		$transaction->setDeclarationID(uniqid('VEROT'));
		
		$content = "<div id='form'>";
		
		$content .= "<p class='bold'>". gettext('VAT declaration information') ."</p>
					<p>". gettext('Check that information is correct before sending the declaration.') . " " .
					gettext('If needed you can change the information.') ."</p>";

		$content .= $transaction->displayObjectSummaryHeaderInHtml($transaction, $user);
		$content .= "<table id='TaxForm'>";
		$content .= "<tr class='greenBG'>
							<td colspan='3'></td>
							<td>". gettext('Euros') ."</td>
							<td></td>
						</tr>
						<tr>
							<td colspan='5'>". gettext('TODO: Vero kotimaan myynnistä verokannoittain') ."</td>
						</tr>";
		
		$content .= $transaction->displayObjectSummaryInHtml();
		
		$content .= "</table>";
		
		// add author and reference number
		$transaction->setAuthor($user->getId());
		$transaction->setReferenceNumber($user->getCurrentCompany()->getReferenceNumber());
		$serializedVAT = base64_encode(serialize($transaction));
				
		$content .= "
				<form action='' method='post'>
					<div id='bottonButtons'>
						<p><input type='hidden' name='object' value='$serializedVAT' /></p>
						<p class='leftButton'><input type='submit' name='correct' value='". gettext('Correct declaration') ."' /></p>
						<p class='middleButton'><input type='submit' name='cancel' value='". gettext('Cancel') ."' class='buttonLikeLink'/></p>
						<p class='rightButton'><input type='submit' name='save' value='". gettext('Save') ."' /></p>
					</div>
				</form>
			</div><!-- /form -->";
		
		return $content;
	}
}
?>