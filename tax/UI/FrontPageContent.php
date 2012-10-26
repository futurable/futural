<?php
/**
 *  FrontPageContent.php
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
 * FrontPageContent.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-20
 */

class FrontPageContent extends Content {
	
	public function __construct(){
		parent::__construct();
	}
	
	protected function doDisplayInHtml( User $userObject ) {
		$content = '<h1>'.$userObject->getCurrentCompany()->getCompanyName().' - '.gettext('Tax account status') .'</h1>';
		// tarkistetaan rooli
		$role = $userObject->getRole();
		
		if ( strcmp(trim($role), 'opiskelija') === 0 ) {
			$content .= "<h2>".gettext('Saldo status')."</h2>";
			
			// Format variables
			$taxAccount = new TaxAccount( $userObject->getCurrentCompany()->getReferenceNumber() );
			$date = date('d.m.Y');
			$saldo = Format::formatDecimal( $taxAccount->getSaldo() );
			$dayName = $this->getWeekDayName(date('N'));
			
			$content .= "<div class='textArea'>
				<p class='bold'>".gettext('Tax account saldo')." ( $dayName $date ) <span class='margin20left'>$saldo</span>
				<a class='link margin10left' href='?category=AccountEvents&amp;page=AccountTransactions'>".gettext('Transactions')."</a></p>
			</div>";

		} else if ( strcmp(trim($role), 'ohjaaja') === 0 ) {
			$content = "This is the front page of the instructor.";
		} else if ( strcmp(trim($role), 'Admin profil') === 0 ) {
			$content =  "This is the front page of the admin.";
		}
		return $content;
	}
}

?>