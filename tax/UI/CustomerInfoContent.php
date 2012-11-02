<?php
/**
 *  CustomerInfoContent.php
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
 * CustomerInfoContent.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-31
 */

class CustomerInfoContent extends Content {
	
	public function __construct() {
		parent::__construct();
	}
	
	protected function doDisplayInHtml( User $userObject ) {
		$formattedBusinessID = Format::formatBusinessID( $userObject->getCurrentCompany()->getBusinessID() );
		$formattedIBAN = Format::formatIBAN( "FI0797029900110011" );
		
		$info = "<h2>".gettext('Customer information')."</h2>";
		
		$info .= "<h3>".gettext('Basic information')."</h3>";
		
		$info .= "<div class='textArea'><table>
					<tr>
						<td class='bold maxWidth200'>".gettext('Name')."</td>
						<td>".$userObject->getCurrentCompany()->getCompanyName()."</td>
					</tr>
					<tr>
						<td class='bold maxWidth200'>".gettext('Business ID')."</td>
						<td>$formattedBusinessID</td>
					</tr>
				</table></div>";
		
		$info .= "<h3>".gettext('Reporting information')."</h3>
			<p>".gettext('Current declaration period information').".</p>
		
			<div class='textArea'>
				<table>
					<tr>
						<td class='bold maxWidth200'>".gettext('VAT declarations')."</td>
						<td>".gettext('Monthly')."</td>
					</tr>
					<tr>
						<td class='bold maxWidth200'>".gettext('Employer contributions')."</td>
						<td>".gettext('Monthly')."</td>
					</tr>
				</table>
			</div>
		";
		
		$info .= "<h3>".gettext('Payment information')."</h3>";
		
		$info .= "<p>".gettext('Reference number must always be used when making payment to tax account').".</p>";
		
		$info .= "<div class='textArea'>
				<table>
					<tr>
						<td class='bold maxWidth200'>".gettext('Tax account payments customer-spesific reference number')."</td>
						<td>".$userObject->getCurrentCompany()->getReferenceNumber()."</td>
					</tr>
					<tr>
						<td class='bold maxWidth200'>".gettext('Bank account number for tax account payments')."</td>
						<td colspan='2'>
							<table>
								<tr>
									<th>".gettext('Bank')."</th>
									<th>IBAN</th>
									<th>BIC</th>
								</tr>
								<tr>
									<td>Oivapankki</td>
									<td class='noWrap'>$formattedIBAN</td>
									<td>OIVAFIT0</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
		</div>";
		
		return $info;
	}
	
}
?>