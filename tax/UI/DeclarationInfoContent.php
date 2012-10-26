<?php
/**
 *  DeclarationInfoContent.php
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
 * DeclarationInfoContent.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-09-14
 */

class DeclarationInfoContent extends Content {

	protected function doDisplayInHtml( User $userObject ) {
		$dueDate = date('d.m.Y', strtotime("+1 months", strtotime(date('Y-m-12'))));
		
		$content = "<h1>".gettext('Unprompted tax declarations')."</h1>";

		$content .= "<p>".gettext('Value added tax, withholding tax and employers social security contributions are unprompted taxes that are declared for tax authorities via seasonal income tax declaration.')."</p>";
		
		$content .= "<h2>".gettext('Declaration dates')."</h2>";
		
		$content .= "<h3>".gettext('Month as the declaration period')."</h3>";
		$content .= "<p>".gettext('The seasonal income tax declaration is due on 12. day of the month that the target period tax or payment declaration is due according the law.')."</p>";
		
		$content .= "<div class='textArea'>
					<span class='bold'>".gettext('The next general due date is ')."$dueDate.</span> "
					.gettext('The next target period value added tax and employer contributions are due on this date.')."
					</div>";
	
		return $content;
	}
	
}

?>