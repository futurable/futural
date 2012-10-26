<?php
/**
 *  CorrectDeclarationContent.php
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

require_once('CommonServices/Format.php');

/**
 * CorrectDeclarationContent.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-21
 */

class CorrectDeclarationContent extends Content {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Displays corrent declaration content in html format.
	 * 
	 * @see Content::doDisplayInHtml()
	 */
	protected function doDisplayInHtml( User $userObject ) {
		Debug::debug(get_class(), "doDisplayInHtml", "Start");
		
		$content = "<h1>". gettext('Declaration - correcting sent declarations') ."</h1>\n";
		
		// user has pressed OpenDeclaration button
		if (isset($_POST['openDeclaration']) and $_POST['openDeclaration']) {
			Debug::debug(get_class(), "doDisplayInHtml", "OpenDeclaration pressed", 2);
			
			$targetPeriod = $_POST[ 'targetPeriod' ];
			$objectType = $_POST[ 'objectType' ];
			
			// create new transaction and fill available info
			$newTransaction = new $objectType();
			$newTransaction->setTargetPeriod($targetPeriod);
			$newTransaction->setAuthor($userObject->getName());
			$newTransaction->setReferenceNumber($userObject->getCurrentCompany()->getReferenceNumber());
			
			$taxAccount = new TaxAccount( $userObject->getCurrentCompany()->getReferenceNumber() );
			$existingTransaction = $taxAccount->getChosenTransaction($targetPeriod, $objectType);
			
			// draw new transactions header
			$content .= $newTransaction->displayObjectSummaryHeaderInHtml($newTransaction, $userObject);
			// draw new transaction in form and show existing transactions information too
			$content .= $this->displayChosenTransactionInForm( $existingTransaction, $newTransaction );
		}
		// user has pressed "Count" or "Correct declaration"
		else if ( (isset($_POST['count']) and $_POST['count']) or 
				(isset($_POST['correct']) and $_POST['correct']) ) {
			Debug::debug(get_class(), "doDisplayInHtml", "Count/Correct pressed", 2);
			
			// existing object from DB
			$existingTransaction = unserialize( base64_decode( $_POST[ 'objectFromDB' ] ) );
			$newTransaction = unserialize( base64_decode( $_POST[ 'newObject' ] ) );
			
			if (isset($_POST['count']) and $_POST['count']) {
				Debug::debug(get_class(), "doDisplayInHtml", "Count pressed", 3);
				$newTransaction->fillObjectFromArray( $newTransaction, $_POST );
			} 
			
			// draw new transactions header
			$content .= $newTransaction->displayObjectSummaryHeaderInHtml($newTransaction, $userObject);
			
			// validate object
			$validated = $newTransaction->validate();
			
			// if validated is true, count tax308 and print form with object info
			if ($validated === true) {
				Debug::debug(get_class(), "doDisplayInHtml", "Validated = $validated", 3);
				// count tax sum (returnable/payable)
				$sum = $newTransaction->countSum();
				$newTransaction->setSum($sum);
				
				$content .= $this->displayChosenTransactionInForm($existingTransaction, $newTransaction);
			} 
			// validated is not true, print form with object info and errors
			else {
				Debug::debug(get_class(), "doDisplayInHtml", "Validated = $validated", 3);
				$content .= $this->displayChosenTransactionInForm($existingTransaction, $newTransaction, $validated);
			}
			
		} 
		// user has pressed continue button
		else if (isset($_POST['continue']) and $_POST['continue']) {
			Debug::debug(get_class(), "doDisplayInHtml", "Continue pressed", 2);
			
			// unserialize object from post
			$existingTransaction = unserialize( base64_decode( $_POST[ 'objectFromDB' ] ) );
			$newTransaction = unserialize( base64_decode( $_POST[ 'newObject' ] ) );
			
			// fill objects information from $_POST
			$newTransaction->fillObjectFromArray($newTransaction, $_POST);
			
			// set sum
			$sum = $newTransaction->countSum();
			$newTransaction->setSum($sum);
			
			// validate object
			$validated = $newTransaction->validate();
			
			if ($validated === true) {
				Debug::debug(get_class(), "doDisplayInHtml", "Validated = $validated", 3);
				$content .= "<div id='form'>";
				$content .= "<p class='bold'>". gettext('VAT declaration information') ."</p>";
				$content .= $this->displayObjectSummaryAndForm($existingTransaction, $newTransaction, $userObject);
				$content .= "</div><!-- /form -->";
			} 
			// validated is not true, print form with object info and errors
			else {
				Debug::debug(get_class(), "doDisplayInHtml", "Validated = $validated", 3);
				$content .= $this->displayChosenTransactionInForm($existingTransaction, $newTransaction);
			}
		}
		// user has pressed save
		else if (isset($_POST['save']) and $_POST['save']) {
			Debug::debug(get_class(), "doDisplayInHtml", "Save pressed", 2);
			// unserialize new object from post
			$newTransaction = unserialize( base64_decode( $_POST[ 'newObject' ] ) );
			
			$successful = $newTransaction->dataMapper->save($newTransaction);
			
			if ($successful === true) {
				$content .= "<p class='bold'>". gettext('Declaration is successful.') ."</p>";
			} else {
				$content .= "<p class='bold'>". gettext('Error while creating declaration. Please, try again') ."!</p>";
			}
		}
		// first time
		else {
			Debug::debug(get_class(), "doDisplayInHtml", "Nothing/cancel pressed", 3);
			$taxAccount = new TaxAccount( $userObject->getCurrentCompany()->getReferenceNumber() );
			$transactions = $taxAccount->getTaxTransactions();
			
			$content .= $this->displayAllTransactions( $transactions );
		}
		
		return $content;
	}
	
	/**
	 * Displays all transactions which comes in parameter array.
	 * 
	 * @access private
	 * @param  array   $transactions
	 * @return string  $content       content in html format
	 */
	private function displayAllTransactions( $transactions ) {
		Debug::debug(get_class(), "displayAllTransactions", "Start");
		$content = '';
		
		if (is_array($transactions) and !empty($transactions)) {
			Debug::debug(get_class(), "displayAllTransactions", "Transactions is array and is not empty", 2);
			
			// array for sorting
			$transactionSorted = array();
			
			// arrange transactions array so that it is multidimensional
			// like: [date][objectType][order][object]
			// example: [2011-09-12][VAT][0][VAT object]
			foreach ($transactions as $key => &$value) {
				$targetPeriod = $value->getTargetPeriod();
				$valuesClass = get_class($value);
				
				$transactionSorted[$targetPeriod][$valuesClass][] = $value;
			}
			// sort by first array key descending (latest month on top)
			krsort($transactionSorted);
		
			$content .= "<table id='TaxForm'>
							<tr class='greenBG bold'>
								<td>". gettext('Target period') ."</td>
								<td>". gettext('Sent') ."</td>
								<td colspan='2'>". gettext('Declaration') ."</td>
								</tr>";
			
			$currentTargetPeriod = "";
			$currentType = "";
			
			// print array
			foreach ($transactionSorted as $date => &$firstArray) {
				Debug::debug(get_class(), "displayAllTransactions", "Foreach 1", 3);
				
				$currentTargetPeriod = $date;
				$targetMonth = date("F", strtotime($date));
				$targetYear = date("Y", strtotime($date));
				
				foreach ($firstArray as $objectType => &$secondArray) {
					Debug::debug(get_class(), "displayAllTransactions", "Foreach 2", 4);
					$currentType = $objectType;
					
					// sort object array by object date
					$sortAlgorithm = array(get_class(), 'sortObjectArrayByCreateDateAscending');
					uasort( $secondArray, $sortAlgorithm);
					
					// this is the header row
					$content .= "<tr class='lightGreenBG'>
									<td colspan='3'>". gettext($targetMonth) ." $targetYear - ".gettext($currentType) ."</td>
									<td>
										<form method='post' action=''>
											<p>
												<input type='submit' value='". gettext('Make extra declaration') ."' 
													name='openDeclaration' class='buttonLikeLink' />
												<input type='hidden' name='targetPeriod' value='$currentTargetPeriod' />
												<input type='hidden' name='objectType' value='$currentType' />
											</p>
										</form>
									</td>
								</tr>";
					
					foreach ($secondArray as $key => $object) {
						Debug::debug(get_class(), "displayAllTransactions", "Foreach 3", 5);
						
						// this is the actual transaction information row
						$date = $object->getCreateDate();
						$date = Format::formatISODateToEUROFormat($date);
						
						$content .= "<tr>
										<td></td>
										<td>$date</td>
										<td colspan='2'>". gettext($currentType) ."</td>
									</tr>";
					}
				}
			}
			$content .= "</table>";
		} else {
			Debug::debug(get_class(), "displayAllTransaction", "Transactions is not array or is empty", 2);
			$content .= "<p>". gettext('There are no transactions yet') .".</p>";
		}
		
		return $content;
	}
	
	/**
	 * Display chosen transaction on from.
	 * Display new transaction with available info and input fields.
	 * Display existing transaction in text.
	 * 
	 * @access private
	 * @param  Transaction $existingTransaction
	 * @param  Transaction $newTransaction
	 * @param  array       $errors
	 * @return string      $content       content in html
	 */
	private function displayChosenTransactionInForm ( Transaction $existingTransaction, Transaction $newTransaction, $errors = false ) {
		$content = '';
		$content .= "<div id='form'>
						<form method='post' action='' >";
		$content .= "<table id='TaxForm'>
						<tr class='greenBG'>
							<td colspan='3'></td>
							<td>". gettext('Euros') ."</td>
							<td colspan='2'></td>
						</tr>
						<tr>
							<td colspan='6'>". gettext('TODO: Vero kotimaan myynnistä verokannoittain') ."</td>
						</tr>";
		
		if (is_array($errors)) {
			$content .= $newTransaction->displayObjectWithInputsAndPossibleExistingInfoAndErrorsInForm( $existingTransaction, $errors );
		} else {
			$content .= $newTransaction->displayObjectWithInputsAndPossibleExistingInfoAndErrorsInForm( $existingTransaction );
		}
		
		$serializedExistingTransaction = base64_encode(serialize($existingTransaction));
		$serializedNewTransaction = base64_encode(serialize($newTransaction));
		
		// buttons
		$content .= "</table><!-- /TaxForm -->
						<div id='bottonButtons'>
							<p>
								<input type='hidden' name='objectFromDB' value='$serializedExistingTransaction' />
								<input type='hidden' name='newObject' value='$serializedNewTransaction' />
							</p>";						
		$content .= "		<p class='leftButton'>&nbsp;</p>
							<p class='middleButton'><input type='submit' name='cancel' value='". gettext('Cancel') ."' class='buttonLikeLink'/></p>
							<p class='rightButton'><input type='submit' name='continue' value='". gettext('Continue') ."' /></p>
						</div>
					</form>
				</div><!-- /form -->
				";
		
		return $content;
	}
	
	/**
	 * Display object summary in html.
	 * Show object information in html table. User can not modify this information.
	 * This summary has form too. Form includes serialized objects.
	 * 
	 * @access private
	 * @param  Transaction $existingTransaction
	 * @param  Transaction $newTransaction
	 * @param  User        $user
	 * @return string      $content     content in html format
	 */
	private function displayObjectSummaryAndForm(Transaction $existingTransaction, Transaction $newTransaction, User $user) {
		// Set declarationID
		$newTransaction->setDeclarationID(uniqid('VEROT'));
		
		$content = "<p>". gettext('Check that information is correct before sending the declaration.') . " " .
					gettext('If needed you can change the information.') ."</p>";
				
		$content .= $newTransaction->displayObjectSummaryHeaderInHtml($newTransaction, $user);
		
		$content .= "<table id='TaxForm'>";
		$content .= "<tr class='greenBG'>
							<td colspan='3'></td>
							<td>". gettext('Euros') ."</td>
							<td></td>
						</tr>
						<tr>
							<td colspan='5'>". gettext('TODO: Vero kotimaan myynnistä verokannoittain') ."</td>
						</tr>";
		$content .= $newTransaction->displayObjectSummaryInHtml();
		$content .= "</table>";
		
		// serialize objects
		$serializedExistingTransaction = base64_encode(serialize($existingTransaction));
		$serializedNewTransaction = base64_encode(serialize($newTransaction));
		
		$content .= "
				<form action='' method='post'>
					<div id='bottonButtons'>
						<p>
							<input type='hidden' name='objectFromDB' value='$serializedExistingTransaction' />
							<input type='hidden' name='newObject' value='$serializedNewTransaction' />
						</p>
						<p class='leftButton'><input type='submit' name='correct' value='". gettext('Correct declaration') ."' /></p>
						<p class='middleButton'><input type='submit' name='cancel' value='". gettext('Cancel') ."' class='buttonLikeLink'/></p>
						<p class='rightButton'><input type='submit' name='save' value='". gettext('Save') ."' /></p>
					</div><!-- /bottonButtons -->
				</form>";
		
		return $content;
	}
}
?>
