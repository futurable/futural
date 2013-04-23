<?php
/**
 *  index.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Jarmo Kortetjärvi <jarmo.kortetjarvi@futurable.fi>
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

require_once 'CommonServices/CommonFunctions.php';

/**
 * The main menu index for Futural
 * 
 * @package   futural
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-12-14
 */
		
$metaData =
'<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';

$styleData =
"<style type='text/css'>

</style>";

$headData = 
"<head>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
	<title>Futural</title>
	
	<!-- favicon -->
	<link rel=\"shortcut icon\" href=\"images/favicon.ico\" type=\"image/x-icon\" />
				
	<!-- styles -->
	<link rel=\"stylesheet\" type=\"text/css\" href=\"CommonServices/css/normalize.css\" />
	<link rel=\"stylesheet\" type=\"text/css\" href=\"futural.css\" />

	<!-- favicon -->
	<link rel=\"shortcut icon\" href=\"images/favicon.ico\" />
		
</head>
<body>";

echo $metaData.$headData;
echo CommonFunctions::getDisclaimerDiv();

echo "
<div id='container'>
	<div id='centered'>
		<a href='bank' class='menuButton'><img src='bank/images/logo.png' alias='bank'/></a>
		<a href='tax' class='menuButton'><img src='tax/images/logo.png' alias='tax'/></a>
	</div>
</div><!-- /container -->";

echo CommonFunctions::getStartupDiv();

echo "</body>
</html>";
?>