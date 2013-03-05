<?php

/**
 *  UiView.php
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
 * UiView.php
 * 
 * @package   UI
 * @author    Annika Granlund,
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2011-08-17
 */
class UiView {
	/**
	 * Html header
	 * @var Header $header
	 * @access private
	 */
	private $header;
	/**
	 * Html navigation
	 * @var Navigation $navigation
	 * @access private
	 */
	private $navigation;
	/**
	 * Html Content
	 * @var Content $content
	 * @access private
	 */
	private $content;
	/**
	 * Html footer
	 * @var Footer $footer
	 */
	private $footer;
	
	/**
	 * Constructor for UiView
	 * 
	 * @access  public
	 */
	public function __construct() {
		Debug::debug(get_class(), "__construct", "Start");
	
		$this->header = new Header();
		$this->footer = new Footer();
	}
	
	/**
	 * Displays Login Page.
	 * Create LoginContent object and displays its content.
	 * 
	 * @access  public
	 */
	public function displayLoginPage() {
		Debug::debug(get_class(), "displayLoginPage", "Start");
		
		$this->content = new LoginContent();
		
		$this->header->displayInHtml();
		$this->content->doDisplayLogin();
		$this->footer->displayInHtml();
	}

	/**
	 * Displays pages in html.
	 * 
	 * Create navigation by user and content by current page object.
	 * Displays content by user.
	 * 
	 * @access  public
	 * @param   User    $userObject
	 */
	public function displayInHtml( User $userObject ) {
		Debug::debug(get_class(), "displayInHtml", "Start");
		
		$navigation = new Navigation( $userObject );
		$currentPage = $navigation->getCurrentPageObjectName();
		$content = Content::openContentObjectById( $currentPage );
		
		$this->header->displayInHtml();
		$navigation->displayInHtml();
		$content->displayInHtml( $userObject );
		$this->footer->displayInHtml();
	}
}

?>