<?php
/**
 *  Navigation.php
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
 * Navigation.php
 * 
 * @package   UI
 * @author    Annika Granlund, Jarmo Kortetjärvi
 * @copyright 2012 <annika.granlund@futurable.fi>, <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-30
 */
class Navigation {
	private $currentNavigation;
	private $currentPageObjectName;
	private $currentCategory;
	private $currentCompany;
	
	/**
	 * Contructor for Navigation
	 * Navigation depends on user role.
	 * 
	 * @access 	public
	 * @param   User    $user
	 */
	public function __construct( User $user) {
		Debug::debug(get_class(), "__construct", "Start");
		
		$this->currentCompany = $user->getCurrentCompany();

		$this->currentNavigation = $this->getCorrectNavigationArrayByRole( $user->getRole() );
		$this->currentPageObjectName = $this->findCurrentPageObjectName();
		$this->currentCategory = $this->findCurrentCategory();
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
		
		$navigationArrayAdmin = array( "SelectCompany" => $this->getNavigationElement('SelectCompany') 
									, "FrontPage" => $this->getNavigationElement('FrontPage'));
		
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
		
		$navigationArrayBusinessCustomer = 	array( "SelectCompany" => $this->getNavigationElement('SelectCompany')
												, "FrontPage" => $this->getNavigationElement('FrontPage')
												, "AccountEvents" => $this->getNavigationElement('AccountEvents')
												, "Declarations" => $this->getNavigationElement('Declarations')
												, "CustomerInfo" => $this->getNavigationElement('CustomerInfo'));
		
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
		
		$navigationArrayInstructor = array( "SelectCompany" => $this->getNavigationElement('SelectCompany')
											, "FrontPage" => $this->getNavigationElement('FrontPage'));
		
		Debug::debug(get_class(), "getNavigationArrayInstructor", "Return instructor navigation");
		return $navigationArrayInstructor;
	}
	
	/**
	 * Finds current object's name.
	 * 
	 * If page is set in $_GET, ensure it is found in currentNavigation array.
	 * If page is not set in $_GET or it is not found in currentNavigation array,
	 * currentPageObject is the first object in currentNavigation array.
	 * 
	 * @access  public
	 * @return  string  $currentPageObjectName
	 */
	private function findCurrentPageObjectName() {
		Debug::debug(get_class(), "getCurrentPageObjectName", "Start");
		$currentPageObjectName = null;

		// if GET has page information and it exists in the currentNavigation array
		if ( isset($_GET['page']) && 
				( 
				array_key_exists($_GET['page'], $this->currentNavigation) || 
				( isset($_GET['category']) && 
				 array_key_exists( $_GET['page'], $this->currentNavigation[ $_GET['category'] ]['subnavi'] ) )
				)
			) {
			Debug::debug(get_class(), "getCurrentPageObjectName", "GET has page information", 2);
			
			array_shift( $this->currentNavigation );
			$currentPageObjectName = $_GET[ 'page' ];
			
		} else {
			Debug::debug(get_class(), "getCurrentPageObjectName", "GET has not page information or it is not correct", 2);
			if( is_object($this->currentCompany) ){
				// Take the second key of $pageArray
				array_shift( $this->currentNavigation );
				$secondObject = key( $this->currentNavigation );
				$currentPageObjectName = $secondObject;
			}
			else{
				// Take first key of $pageArray
				$firstObject = key( $this->currentNavigation );
				$currentPageObjectName = $firstObject;
			}
		}
		
		Debug::debug(get_class(), "getCurrentPageObjectName", "Return currentPageObjectName $currentPageObjectName");
		return $currentPageObjectName;
	}
	
	/**
	 * Finds current category
	 * 
	 * @access  public
	 * @return  string  $currentCategory
	 */
	private function findCurrentCategory(){
		Debug::debug(get_class(), "findCurrentCategory", "Start");
		$currentCategory = null;
		
		if ( isset($_GET['category']) and array_key_exists( $_GET[ 'category' ], $this->currentNavigation) ) {
			Debug::debug(get_class(), "findCurrentCategory", "GET has category information", 2);
			
			$currentCategory = $_GET[ 'category' ];
		}
		else{
			Debug::debug(get_class(), "findCurrentCategory", "GET has no category information. Using null", 2);
			$currentCategory = null;
		}
		
		Debug::debug(get_class(), "findCurrentCategory", "Return currentCategory $currentCategory");
		return $currentCategory;
	}
	
	/**
	 * Display navigation in html
	 */
	public function displayInHtml() {
		Debug::debug(get_class(), "displayInHtml", "Start");
		$navi = '';

		if( is_object( $this->currentCompany ) ){
			$navi .= "\n<ul id='navi'>\n";
			foreach( $this->currentNavigation as $page => &$navigationElement ) {	
				$pageText = $navigationElement['page'];
				
				// Subnavigation exists
				if( array_key_exists('subnavi', $navigationElement)){
					$activeCategory = $this->getActiveCategory( $page );
					$activeCategoryClass = ( $activeCategory ? " class='activeCategory'" : false );
					
					$firstSubnaviElement = key( $navigationElement['subnavi'] );
					$navi .= "<li$activeCategoryClass><a href='?category=$page&amp;page=$firstSubnaviElement'>$pageText</a>";
					
					$navi .= "\n\t<ul>\n";
					foreach( $navigationElement['subnavi'] as $subPage => &$subPageText ){
						$activePage = $this->getActiveLink( $subPage );
						$activePageClass = ( $activePage ? " class='activePage'" : false );
						
						$navi .= "\t\t<li$activePageClass><a href='?category=$page&amp;page=$subPage'>$subPageText</a></li>\n";
					}
					$navi .= "\t</ul>\n";
				}
				// No subnavigation
				else{
					$activePage = $this->getActiveLink( $page );
					$activePageClass = ( $activePage ? " class='activeCategory'" : false );
					$navi .= "<li$activePageClass><a href='?page=$page'>$pageText</a>";
				}
				
				$navi .= "</li>\n";
			}
			$navi .= "</ul><!-- /navi -->";
		}
		
		print <<<EOT
		<div id='navigation'>
			$navi
		</div><!-- /navigation -->
EOT;
	}
	
	/**
	 * Return current page objects name.
	 * 
	 * @access public 
	 */
	public function getCurrentPageObjectName() {
		if(isset($this->currentPageObjectName)){
			return $this->currentPageObjectName;
		}
	}
	
	/**
	 * Return current category.
	 * 
	 * @access public 
	 */
	public function getCurrentCategory() {
		if(isset($this->currentCategory)){
			return $this->currentCategory;
		}
	}
	
	/**
	 * Research which navigation link is active
	 * If link is active return true
	 * 
	 * @access public
	 * @param string $active (pageId)
	 * @return bool  $activeLink
	 */
	public function getActiveLink( $active ) {
		$activeLink = false;
		if ( is_string( $active) and $active === $this->currentPageObjectName ) {
			$activeLink = true;
		}
		return $activeLink;
	}
	
	/**
	 * Check if category is active
	 * 
	 * @access private
	 * @param string $category (category)
	 * @return bool  $active
	 */
	
	private function getActiveCategory( $category ){
		$active = false;
		
		if($category == $this->currentCategory){
			$active = true;
		}
		else $active = false;
		
		return $active;
	}
	
	/**
	 * Get navigation element text	
	 * 
	 * @access public
	 * @param string 	$elementName
	 * @return array	$navigationElement
	 */
	private function getNavigationElement($elementName){
		$navigationElement = array();
		
		$navigationArray = array(
			"SelectCompany" => array( "page" => gettext("Select company") )
			, "FrontPage" => array( "page" => gettext("Front page") )
			, "AccountEvents" => array( "page" => gettext("Tax account events") 
				, "subnavi" => array( 
								"AccountTransactions" => gettext("Account transactions")
								, "MonthlySummary" => gettext("Monthly summary") 
							)
			)
			, "Declarations" => array( "page" => gettext("Tax declarations")
				, "subnavi" => array ( 
								"DeclarationInfo" => gettext("Info")
								, "VATDeclaration" => gettext("VAT declaration")
								, "ECDeclaration" => gettext("Employer's contributions")
								, "CorrectDeclaration" => gettext("Correcting declarations")
							)
			)
			, "CustomerInfo" => array( "page" => gettext("Customer information") )
			/*, "Logout" => array( "page" => gettext("Log out") )*/
		);
		
		if(array_key_exists($elementName, $navigationArray)){
			$navigationElement = $navigationArray[$elementName];
		}
		
		return $navigationElement;
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