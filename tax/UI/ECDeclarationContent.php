<?php
require_once 'Model/EC.php';

/**
 *  ECDeclarationContent.php
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

/**
 * ECDeclarationContent.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-21
 */

class ECDeclarationContent extends Content {
	
	public function __construct(){
		parent::__construct();
		
		
	}
	
	/**
	 * Display VAT Declaration content
	 * @see Content::doDisplayInHtml()
	 */
	protected function doDisplayInHtml( User $userObject ) {
		Debug::debug(get_class(), "doDisplayInHtml", "Start");
		
		$content = "<h1>". gettext('Declaration - Employer contributions declaration') ."</h1>\n";
		
		// user has pressed "Count" or "Correct declaration"
		if ( (isset($_POST['count']) and $_POST['count']) or 
			(isset($_POST['correct']) and $_POST['correct']) ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Count/Correct pressed", 2);
			
			$ec = new EC();
			if ( isset($_POST['correct']) and $_POST['correct'] ) {
				Debug::debug(get_class(), "doDisplayInHtml", "Correct pressed", 3);
				$ec = unserialize( base64_decode( $_POST[ 'object' ] ) );
			} else {
				Debug::debug(get_class(), "doDisplayInHtml", "Correct is not pressed", 3);
				$ec->fillObjectFromArray($ec, $_POST);
			}
			
			$validated = $ec->validate();
			
			// if validated is true, count sum and print form with object info
			if ($validated === true) {
				Debug::debug(get_class(), "doDisplayInHtml", "Validated = $validated", 3);
				// count sum (returnable/payable)
				$sum = $ec->getTax602() + $ec->getTax606() + $ec->getTax610();
				$ec->setTax608($sum);
				$content .= $this->displayFormContent($ec);
			} 
			// validated is not true, print form with object info and errors
			else {
				Debug::debug(get_class(), "doDisplayInHtml", "Validated = $validated", 3);
				$content .= $this->displayFormContent($ec, $validated);
			}	
		} 
		// user has pressed "Continue"
		else if ( (isset($_POST['continue']) and $_POST['continue']) ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Continue pressed", 2);
			
			$ec = new EC();
			$ec->fillObjectFromArray($ec, $_POST);
			
			// count sum
			$sum = $ec->getTax602() + $ec->getTax606() + $ec->getTax610();
				$ec->setTax608($sum);
			
			$validated = $ec->validate();
			
			if ($validated === true) {
				$content .= $this->displayObjectSummaryAndForm($ec, $userObject);
			} else {
				$content .= $this->displayFormContent($ec, $validated);
			}
		}
		// else if user has pressed save
		else if ( (isset($_POST['save']) and $_POST['save']) ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Save pressed", 2);
			// save object
			$ec = new EC();
			$ec = unserialize( base64_decode( $_POST[ 'object' ] ) );
			
			$successful = $ec->dataMapper->save( $ec );
			
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
			$ec = new EC();
			$content .= $this->displayFormContent($ec);
		}
		
		return $content;
	}
	
	/**
	 * Display EC Declaration form.
	 * Has 3 different scenes:
	 * - empty form
	 * - form with precompleted information (from VAT object)
	 * - form with precompleted information (from VAT object) and error messages (from $errors array)
	 * 
	 * @param EC $vat
	 * @param array $errors
	 */
	private function displayFormContent(EC $ec, $errors = false) {
		$content = "
			<div id='form'>
				<form action='' method='post'>";
		$content .= $this->getDeclarationMonthsContent();
		$content .= "<table id='TaxForm'>
						<tr class='greenBG'>
							<td colspan='3'></td>
							<td>". gettext('Euros') ."</td>
							<td></td>
						</tr>";
		
		if (is_array($errors)) {
			// vat displays itself with precompleted information and possible error messages
			$content .= $ec->displayObjectWithPossibleErrorsInForm( $errors );
		} else {
			// vat displays itself in empty form
			$content .= $ec->displayObjectWithPossibleErrorsInForm();
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
	private function displayObjectSummaryAndForm(EC $transaction, User $user) {
		// Set declarationID
		$transaction->setDeclarationID(uniqid('VEROT'));
		
		$content = "<div id='form'>";
		
		$content .= "<p class='bold'>". gettext('Employer contribution declaration information') ."</p>
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
		$serializedEC = base64_encode(serialize($transaction));
				
		$content .= "
				<form action='' method='post'>
					<div id='bottonButtons'>
						<p><input type='hidden' name='object' value='$serializedEC' /></p>
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