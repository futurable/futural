<?php
/**
 *  Header.php
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
 * Header is for the html header information.
 * 
 * @package   UI
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-05-23
 */
class Header {
	
	public function __construct() {
		
	}
	
	public function displayInHtml() {
		
		print <<<EOT
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Futural Bank</title>
	
	<!-- favicon -->
	<link rel=”shortcut icon” href=”images/favicon.ico” type=”image/x-icon” />
				
	<!-- styles -->
	<link rel="stylesheet" type="text/css" href="../CommonServices/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/FuturalBank.css" />
	
	<!-- open links to new tab -->
	<script type="text/javascript" src="js/external.js"></script>
	<!-- disable unwanted enter pushing -->
	<script type="text/javascript" src="js/disable_enter.js"></script>
	
	<!-- jquery UI -->
	<link type="text/css" href="css/jquery-ui.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src="../jquery-ui/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="../jquery-ui/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="../jquery-ui/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="../jquery-ui/ui/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="../jquery-ui/ui/i18n/jquery.ui.datepicker-fi.js"></script>
	<script type="text/javascript" src="../jquery-ui/ui/i18n/jquery.ui.datepicker-en-GB.js"></script>


	<!-- favicon -->
	<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
EOT;

print CommonFunctions::getDisclaimerDiv();

print <<<EOT
	<div id='container'>
		<div id='header'>
		
		</div><!-- /header -->
EOT;


	}
}

?>