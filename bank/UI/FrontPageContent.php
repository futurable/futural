<?php
/**
 *  FrontPageContent.php
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
 * Front page text content.
 *
 * @package   UI
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-05-25
 */
class FrontPageContent extends Content {
	
	public function __construct(){
		parent::__construct();
	}
	
	protected function doDisplayInHtml( User $userObject ) {
		$content = '<h1>'. gettext('Welcome to Futural Bank!') .'</h1>';
		// tarkistetaan rooli
		$role = $userObject->getRole();
		
		if ( strcmp(trim($role), 'opiskelija') === 0 ) {
			$content .= "<p>". gettext('This is the front page for Futural Bank')."</p>";
		} else if ( strcmp(trim($role), 'ohjaaja') === 0 ) {
			$content = "Tämä on ohjaajan etusivu";
		} else if ( strcmp(trim($role), 'Admin profil') === 0 ) {
			$content =  "Tämä on adminin etusivu";
		}
		return $content;
	}
}

?>