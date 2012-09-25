<?php
/**
 *  LoginPageContent.php
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

/**
 * Login page text content.
 *
 * @package   UI
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-05-25
 */
class LoginContent extends Content {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function doDisplayLogin() {
		Debug::debug(get_class(), "doDisplayLogin", "Start");
		
		$username = (isset($_POST['username']) && !empty($_POST['username'])) ? $_POST['username'] : "";
		
		// draw login form
		print "<div id='loginContent'>
			\n<h1 class='bold'>" . gettext('Login to Futural Bank'). "</h1>
			\n<form action='Index.php' method='post'>
				<p>" . gettext('Username'). " <br/>
				<input type='text' name='username' value='$username'/></p>
				<p>" . gettext('Password'). " <br/>
				<input type='password' name='password' /></p>
				
				<p><input type='submit' value='" . gettext('Login') . "' name='login' /></p>
			</form>";
		
		if(isset($_POST['login'])){
			print "<p class='incorrect'>".gettext('Username or password was incorrect').".</p>";
		}
		
		if(isset($_GET['timeout']) and $_GET['timeout'] == true){
			print "<p class='incorrect'>".gettext('You were logged out due inactivity').".</p>";
		}
		
		
		print "</div><!-- /loginContent -->";
	}
	
	public function doDisplayInHtml( User $userObject ) {
		
	}
}
?>