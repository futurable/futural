<?php
/**
 *  TransactionsContent.php
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

require_once 'Model/TaxAccount.php';
require_once 'Model/Bank.php';
require_once 'CommonServices/Format.php';

/**
 * TransactionsContent.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-21
 */

class TransactionsContent extends Content {

	protected function doDisplayInHtml( User $userObject ) {
		$content = "<h1>". gettext('Tax account transactions - registered transactions') ."</h1>";

		$taxAccount = new TaxAccount( $userObject->getCurrentCompany()->getReferenceNumber() );
		$saldo = Format::formatDecimal($taxAccount->getSaldo(), 2);
		
		$transactions = $taxAccount->getTransactions();
		$day  = $this->getWeekDayName( date('N') );
		
		$content .= "<div class='textArea'><p class ='bold'>";
		$content .= gettext('Tax account saldo')." ($day ".date('d.m.Y').") $saldo</p>
					</div><!-- /textArea -->";
		
		if (!empty($transactions)) {
		
		// sorting by date
		$sortAlgorithm = array(get_class(), 'sortObjectArrayByDate');
		uasort( $transactions, $sortAlgorithm );
			
			$content .= "<table id='TaxForm'>
							<tr class='greenBG bold'>
								<td>". gettext('Date') ."</td>
								<td>". gettext('Transaction') ."</td>
								<td>". gettext('Sum') ."</td>
								<td>". gettext('TODO: maksamatta')."</td>
							</tr>";

			foreach ($transactions as $key => &$value) {
				$date = $value->getTargetPeriod();
				$date = Format::formatISODateToEUROFormat($date);
				$sum = ( $value->getSum() >= 0 ? "+".$value->getSum() : $value->getSum() );
				
				$content .= "<tr>
								<td>$date</td>
								<td>". $value->getOneDescription('sum') ."</td>
								<td>$sum</td>
								<td></td>
							</tr>";
			}
			$content .= "</table>";
			
		} else {
			$content .= "<p>". gettext('There are no transactions yet') .".</p>";
		}
		
		return $content;
	}
}

?>