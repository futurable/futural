<?php
/**
 *  Navigation.php
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
 * Navigation.php
 * 
 * @package   UI
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-06-06
 */
class Navigation {
	private $currentNavigation;
	private $currentPageObjectName;
	
	/**
	 * Contructor for Navigation
	 * Navigation depends on user role.
	 * 
	 * @access 	public
	 * @param   User    $user
	 */
	public function __construct( User $user) {
		Debug::debug(get_class(), "__construct", "Start");
		
		$this->currentNavigation = $this->getCorrectNavigationArrayByRole( $user->getRole() );
		$this->currentPageObjectName = $this->findCurrentPageObjectName();
	}
	
	/**
	 * Return correct navigation array depending on user's role.
	 * 
	 * @access  private
	 * @param   string 	$role
	 * @return  array   $navigationArray
	 */
	private function getCorrectNavigationArrayByRole( $role ) {
		Debug::debug(get_class(), "getCorrectNavigationArrayByRole", "Start");
		$navigationArray = null;
		
		if ( strcmp(trim($role), 'Admin profil') === 0 ) {
			Debug::debug(get_class(), "getCorrectNavigationArrayByRole", "Role is $role", 2);
			$navigationArray = $this->getNavigationArrayAdmin();
					
		} else if ( strcmp(trim($role), 'opiskelija') === 0 ) {
			Debug::debug(get_class(), "getCorrectNavigationArrayByRole", "Role is $role", 2);
			$navigationArray = $this->getNavigationArrayBusinessCustomer();
			
		} else if ( strcmp(trim($role), 'ohjaaja') === 0 ) {
			Debug::debug(get_class(), "getCorrectNavigationArrayByRole", "Role is $role", 2);
			$navigationArray = $this->getNavigationArrayInstructor();
		}
		
		Debug::debug(get_class(), "getCorrectNavigationArrayByRole", "Return navigation array: $navigationArray");
		return $navigationArray;
	}
	
	/**
	 * Return navigation elements for admins
	 * 
	 * @access  private
	 * @return  array   $navigationArrayAdmin
	 */
	private function getNavigationArrayAdmin(){
		Debug::debug(get_class(), "getNavigationArrayAdmin", "Start");
		
		$navigationArrayAdmin = array( "FrontPage" => gettext("Front page")
									, "NewAccount" => gettext("Open new account")
									, "UpdateAccount" => gettext("Account information")
									, "NewPayment" => gettext("New transaction")
									, "LoanApplication" => gettext("Loan applications")
									, "PassiveAccounts" => gettext("Passive accounts")
									, "BankTransactions" => gettext("Transactions")
									, "Logout" => gettext("Log out"));
		
		Debug::debug(get_class(), "getNavigationArrayAdmin", "Return admin navigation");
		return $navigationArrayAdmin;
	}
	
	/**
	 * Return navigation elements for business customers
	 * 
	 * @access  private
	 * @return  array   $navigationArrayBusinessCustomer
	 */
	private function getNavigationArrayBusinessCustomer(){
		Debug::debug(get_class(), "getNavigationArrayBusinessCustomer", "Start");
		
		$navigationArrayBusinessCustomer = 	array( "FrontPage" => gettext("Front page")
											, "NewPayment" => gettext("New transaction")
											, "DuePayment" => gettext("Payments for due")
											, "BankTransactions" => gettext("Transactions")
											, "Loans" => gettext("Loans")
											, "LoanApplication" => gettext("Loan applications")
											, "SEPAPayment" => gettext("SEPA payments")
											, "Logout" => gettext("Log out"));
		
		Debug::debug(get_class(), "getNavigationArrayBusinessCustomer", "Return business customer navigation");
		return $navigationArrayBusinessCustomer;
	}
	
	/**
	 * Return navigation elements for instructors
	 * 
	 * @access  private
	 * @return  array   $navigationArrayAdmin
	 */
	private function getNavigationArrayInstructor(){
		Debug::debug(get_class(), "getNavigationArrayInstructor", "Start");
		
		$navigationArrayInstructor = array( "FrontPage" => gettext("Front page")
											, "BankTransactions" => gettext("Transactions")
											, "DuePayment" => gettext("Payments for due")
											, "Loans" => gettext("Loans")
											, "Logout" => gettext("Log out"));
		
		Debug::debug(get_class(), "getNavigationArrayInstructor", "Return instructor navigation");
		return $navigationArrayInstructor;
	}
	
	/**
	 * Finds current object's name.
	 * 
	 * If page is set in $_GET, ensure it is found in currentNavigation array.
	 * If page is not set in $_GET or it is not found in currentNavigation array,
	 * currentPageObject is the first object in currentNavigatin array.
	 * 
	 * @access  public
	 * @return  string  $currentPageObjectName
	 */
	public function findCurrentPageObjectName() {
		Debug::debug(get_class(), "getCurrentPageObjectName", "Start");
		$currentPageObjectName = null;
		
		// if GET has page information and it exists in the currentNavigation array
		if ( isset($_GET['page']) and array_key_exists( $_GET[ 'page' ], $this->currentNavigation) ) {
			Debug::debug(get_class(), "getCurrentPageObjectName", "GET has page information", 2);
			
			$currentPageObjectName = $_GET[ 'page' ];
			
		} else {
			Debug::debug(get_class(), "getCurrentPageObjectName", "GET has not page information or it is not correct", 2);
			
			// take first key of $pageArray
			$firstObject = key( $this->currentNavigation );
			$currentPageObjectName = $firstObject;
		}
		
		Debug::debug(get_class(), "getCurrentPageObjectName", "Return currentPageObjectName $currentPageObjectName");
		return $currentPageObjectName;
	}
	
	/**
	 * Display navigation in html
	 */
	public function displayInHtml() {
		Debug::debug(get_class(), "displayInHtml", "Start");
		
		$navi = '';
		
		foreach( $this->currentNavigation as $page => $linkName ) {
			$active = $this->getActiveLink( $page );
			$isActive = ($active) ? "class='active'": "";
			
			$confirmJS = "onclick=\"return confirmBack('".gettext('Are you sure you want to log out?')."');\"";
			$isLogout = ($page=='Logout') ? $confirmJS : "";
			
			// Navigation using images
			//$navigationElement = $this->makeNavigationItemAsImage($page, $active);
			//$navi .= "<li><a href='?page=$page'><img src='$navigationElement' alt='$linkName'/></a></li>\n";
			
			$navi .= "<li><a $isActive $isLogout href='?page=$page'>$linkName</a></li>\n";
		}
		
		print <<<EOT
		<div id='navigation'>
			<ul id='navi'>
				$navi
			</ul><!-- /navi -->
		</div><!-- /navigation -->
EOT;
	}
	
	/**
	 * Return current page objects name.
	 * 
	 * @access public 
	 */
	public function getCurrenPageObjectName() {
		return $this->currentPageObjectName;
	}
	
	/**
	 * Research which navigation link is active
	 * If link is active return class='active'	
	 * 
	 * @access public
	 * @param string $active (pageId)
	 * @return bool $activeLink
	 */
	public function getActiveLink( $active ) {
		$activeLink = false;
		if ( is_string( $active) and $active === $this->currentPageObjectName ) {
			$activeLink = true;
		}
		return $activeLink;
	}
	
	/**
	 * Make navigation item as image if not exist
	 * 
	 * @access  public
	 * @param  	string	$elementName		The name of the wanted image element
	 * @param  	bool	$isElementActive	True if element is active, default false
	 * @return  string  $navigationElement	Navigation image file name
	 */
	private function makeNavigationItemAsImage($elementName, $isElementActive = false){
		Debug::debug(get_class(), "makeNavigationItemAsImage", "Start");
		$navigationElement = null;
		
		// Image locations
		$imageLocation = "images/navigation/";
		
		/*
		 * For pre-drawn picture
		 *
		
		$passiveButton = $imageLocation."passiveButton.png";
		$activeButton = $imageLocation."activeButton.png";
		
		// Check that input images exist
		if(!file_exists($passiveButton)){
			Debug::debug(get_class(), "makeNavigationItemAsImage", "Image for passive button not found. Exiting", 2);
			return false;
		}
		if(!file_exists($activeButton)){
			Debug::debug(get_class(), "makeNavigationItemAsImage", "Image for active button not found. Exiting", 2);
			return false;
		}
		//*/
		
		// Input image location
		if($isElementActive){
			//$buttonInput = $activeButton;
			$state = 'active';
			$colorArray = array('r'=>51, 'g'=>51, 'b'=>51);
		}
		else{
			//$buttonInput = $passiveButton;
			$state = 'passive';
			$colorArray = array('r'=>128, 'g'=>79, 'b'=>3);
		}
		
		// Output image location
		$lang = getenv("LC_ALL")."_";
		$buttonOutput = $imageLocation.$lang.$elementName."_$state.png";
			
		// Check if button already exists
		if(file_exists($buttonOutput)){
			Debug::debug(get_class(), "makeNavigationItemAsImage", "Button already exists", 2);
			$navigationElement = $buttonOutput;
		}
		else {
			Debug::debug(get_class(), "makeNavigationItemAsImage", "Button not found. Creating button", 2);
			
			// Required variables
			$font = '';
			$fontSize = 16;
			$wordwrap = 30; // The amount of letters in one row of the element
			
			// Get possible navigation element names
			$navigationArray = $this->getNavigationArray();
			
			if(array_key_exists($elementName, $navigationArray)){
				Debug::debug(get_class(), "makeNavigationItemAsImage", "Requested element found in array", 3);
				$text = wordwrap($navigationArray[$elementName], $wordwrap);
				
				// A bounding box for the text
				$dims = imagettfbbox($fontSize, 0, $font, $text);
				
				// Make some easy to handle dimension vars from the results of imagettfbbox
				// since positions aren't measures in 1 to whatever, we need to
				// do some math to find out the actual width and height
				$width = $dims[4] - $dims[6]; 	// Upper-right x minus upper-left x 
				$height = $dims[3] - $dims[5]; 	// Lower-right y minus upper-right y
				
				// Create image
				// From image
				//$image = imagecreatefrompng($buttonInput);
				
				$image = imageCreateTrueColor(abs($dims[2]) + abs($dims[0] +10), abs($dims[7]) + abs($dims[1]) + 5);
				imagesavealpha($image, true);
				imagealphablending($image, false);
				
				// Transparent background
				$BGcolor = imagecolorallocatealpha($image, 0, 0, 0, 127);
				
				// Solid background color
				//$BGcolor = imagecolorallocate($image, 187, 204, 255);
				
				imagefill($image, 0, 0, $BGcolor);
				
				// Color for the text;
				$fontColor = imagecolorallocate($image, $colorArray['r'], $colorArray['g'], $colorArray['b']);
				
				// x,y coords for imagettftext defines the baseline of the text: the lower-left corner
				// so the x coord can stay as 0 but you have to add the font size to the y to simulate
				// top left boundary so we can write the text within the boundary of the image
				$x = 2; 
				$y = 2+$fontSize;
				imagettftext($image, $fontSize, 0, $x, $y, $fontColor, $font, $text);
				
				// Output image to a file
				imagepng($image, $buttonOutput, 9);
				$navigationElement = $buttonOutput;
				
				// Delete the image resource 
				imagedestroy($image);
			}
			else{
				Debug::debug(get_class(), "makeNavigationItemAsImage", "Requested element not found in array. Exiting", 3);
				$navigationElement = false;
			}
		}
		
		Debug::debug(get_class(), "makeNavigationItemAsImage", "Return navigation element");
		return $navigationElement;
	}
	
	/**
	 * Get navigation array with code as key and translation as value	
	 * 
	 * @access public
	 * @return array	$navigationArray
	 */
	private function getNavigationArray(){
		$navigationArray = array(
			"FrontPage" => gettext("Front page")
			, "NewAccount" => gettext("Open new account")
			, "UpdateAccount" => gettext("Account information")
			, "NewPayment" => gettext("New transaction")
			, "LoanApplication" => gettext("Loan applications")
			, "PassiveAccounts" => gettext("Passive accounts")
			, "BankTransactions" => gettext("Transactions")
			, "Logout" => gettext("Log out")
			, "Loans" => gettext("Loans")
			, "DuePayment" => gettext("Payments for due")
			, "SEPAPayment" => gettext("SEPA payments")
		);
		
		return $navigationArray;
	}
	
	public function toString() {
		print "<p class='toString'>
				Navigation <br/>
				Current object: $this->currentPageObjectName <br/>
				CurrentNavigationArray: ";
				foreach ($this->currentNavigation as $key => $value) {
					print "[$key] => $value ";
				}
		print "</p>";
	}
}
?>