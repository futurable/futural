<?php
/**
 *  MonthlySummaryContent.php
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
 * MonthlySummaryContent.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-21
 */

class MonthlySummaryContent extends Content {

	protected function doDisplayInHtml( User $userObject ) {
		$content = "<h1>". gettext('Tax account transactions - monthly summary') ."</h1>";

		$taxAccount = new TaxAccount( $userObject->getCurrentCompany()->getReferenceNumber() );
		
		// User has selected a transaction
		if(isset($_POST['viewTransaction']) and !empty($_POST['viewTransaction'])){
			// Get all transactions made on selected month
			$targetMonth = $_POST['targetMonth'];

			$month = ucfirst($this->getMonthName( date('m', $targetMonth) ));
			$content .= "<h2>$month ".date('Y')."</h2>";
			
			$startDate = date('Y-m-d', $targetMonth);
			$endDate = date('Y-m-t', $targetMonth);
			$startDateEURO = Format::formatISODateToEUROFormat($startDate);;
			$endDateEURO = Format::formatISODateToEUROFormat($endDate);
			
			$startSaldo = Format::formatDecimal( $taxAccount->getSaldoByDate( $startDate) );
			$endSaldo =  Format::formatDecimal( $taxAccount->getSaldoByDate( $endDate) );
			
			$transactions = $taxAccount->getTransactionsByTimeRange($startDate, $endDate);
			if (!empty($transactions)) {
				
			// Sorting by date
			$sortAlgorithm = array(get_class(), 'sortObjectArrayByCreateDateDescending');
			uasort( $transactions, $sortAlgorithm );
			
				$temp = "<table id='TaxForm'>
								<tr class='greenBG bold'>
									<td>". gettext('Date') ."</td>
									<td>". gettext('Transaction / message') ."</td>
									<td class='alignRight'>". gettext('Amount') ."</td>
								</tr>";
				
				// Start saldo
				$temp .= "<tr>
								<td class='bold' colspan='2'>".gettext('Saldo')." $endDateEURO</td>
								<td class='bold alignRight'>$endSaldo</td>
							</tr>";
	
				// Transaction summary variables
				$charges = 0;
				$credits = 0;
				
				foreach ($transactions as $key => &$value) {
					$date = $value->getCreateDate();
					$date = Format::formatISODateToEUROFormat($date);
					$sum = ( $value->getSum() >= 0 ? "+".$value->getSum() : $value->getSum() );
					
					if($sum < 0) $charges += $sum;
					else $credits += $sum;
					
					$temp .= "<tr>
									<td>$date</td>
									<td>". $value->getOneDescription('sum') ."</td>
									<td class='alignRight'>$sum</td>
								</tr>";
				}
				
				// End saldo
				$temp .= "<tr>
								<td class='bold' colspan='2'>".gettext('Saldo')." $startDateEURO</td>
								<td class='bold alignRight'>$startSaldo</td>
							</tr> 
						</table>";
				
				// Summary box
				$total = $credits + $charges;
				
				$content .= "<div class='textArea'>
					<p>".gettext('Charges')."<span class='summaryTotal'>".Format::formatDecimal($charges)."</span></p>
					<p>".gettext('Credits')."<span class='summaryTotal'>+".Format::formatDecimal($credits)."</span></p>
					<p class='bold'>".gettext('Transactions total')."<span class='summaryTotal'>".Format::formatDecimal($total)."</span></p>
				</div>".$temp;
				
			} else {
				$content .= "<p>". gettext('There are no transactions') .".</p>";
			}
			
			// Page-spesific navigation
			$content .= "<p>
				<a class='link' href='?category=AccountEvents&amp;page=AccountTransactions'>".gettext('All transactions')."</a> |
				<a class='link' href='?category=AccountEvents&amp;page=MonthlySummary'>".gettext('Select month')."</a></p>";
			
		}
		// No selected transaction
		else{
			$content .= "
			<table id='TaxForm'>
				<tr class='greenBG bold'>
					<th colspan='2'>".gettext('Month')."</th>
					<th>".gettext('Saldo')."</th>
					<th></th>
				</tr>";

			$firstMonth = strtotime("2011-08-01");
			$currentMonth = strtotime(date('Y-m-1'));
			
			while($firstMonth <= $currentMonth){
				$formattedMonth = date('d.m.Y', $currentMonth);
				$date = date('Y-m-t', $currentMonth);
				$saldoDate = date('t.m.Y', $currentMonth);
				
				$content .= "
					<tr>
						<td>$formattedMonth</td>
						<td>".gettext('Saldo')." $saldoDate</td>
						<td>".Format::formatDecimal($taxAccount->getSaldoByDate($date), 2)."</td>
						<td>
							<form action='' method='post'>
								<p>
								<input type='hidden' name='targetMonth' value='$currentMonth'/>
								<input class='buttonLikeLink' type='submit' name='viewTransaction' value='".gettext('Transactions')."'/>
								</p>
							</form>
						</td>
					</tr>";
				
				$currentMonth = strtotime("-1 month", $currentMonth);
			}
			
			$content .= "</table>";
		}
		
		return $content;
	}
	
}

?>