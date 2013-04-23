<?php
/**
 *  SelectCompanyContent.php
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
 * SelectCompanyContent.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-31
 */

class SelectCompanyContent extends Content {
	
	public function __construct(){
		parent::__construct();
	}
	
	protected function doDisplayInHtml( User $userObject ) {
		$content = "<h2>". gettext('Customer selection') ."</h2>\n
					<p>".gettext('Select customer to manage')."</p>
					<table id='companies'>\n
						<tr class='greenBG bold'>
							<td>". gettext('BusinessID') ."</td>
							<td>". gettext('Company name') ."</td>
							<td>". gettext('Access rights') ."</td>
						</tr>";
		
		// get users companies
		$companies = $userObject->getCompanies();
		
		if (is_array($companies)) {
			$accessInfo = gettext('Browsing the tax account and making seasonal tax declarations');
			
			foreach ($companies as $businessID => &$companyName) {
				$formattedBusinessID = Format::formatBusinessID( $businessID );
				
				$content .= <<<EOT
					<tr>
						<td>
							<form method='post' action='Index.php' >

								<p>
									<input type='submit' value='$businessID' name='chosenCompany' class='buttonLikeLink'/>
									<input type='hidden' value='$businessID' name='businessID' />
									<input type='hidden' value='$companyName' name='companyName' />
								</p>

							</form>
						</td>
						<td>$companyName</td>
						<td>$accessInfo</td>
					</tr>
EOT;
			}
		}
		$content .= "</table>";
		
		return $content;
	}
}
?>