<?php

/**
 *  Footer.php
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
 * Footer is for the html footer information.
 * 
 * @package   UI
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-17
 */
class Footer {
	
	public function __construct() {
		
	}
	
	public function displayInHtml() {
		Debug::debug(get_class(), "displayInHtml", "Start");
		
		print <<<EOT
\n<div id='footer'>
	
</div><!-- /footer -->
</div><!-- container/ -->
</body>
</html>
EOT;
	}
}

?>