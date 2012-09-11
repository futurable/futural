<?php
/**
 *  LocalizationComponent.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Jarmo Kortetjärvi <jarmo.kortetjarvi@futurable.fi>
 *
 *  License
 *
 *      This file is part of project Futural/CommonServices.
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
 * LocalizationComponent for multi-language support
 * 
 * @package   LocalizationComponent
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-09-11
 */
 
Class LocalizationComponent{
	/**
	 * Static function for setting the localization.
	 * 
	 * @access 	public
	 * @param 	string 	$charSet		Charset to be used, default false
	 * @param 	string 	$path			Path to language catalog, default './locale'
	 * @param 	string 	$textDomain		Textdomain for catalog file, default 'messages'
	 * @return	bool	$success		True on success, false on error 
	 */
	public static function setLocalization( $charSet = false, $path = './locale' , $textDomain = 'messages'){
		Debug::debug(get_class(), "setLocalization", "Start");
		Debug::debug(get_class(), "setLocalization", "Requested locale '$charSet'");
		
		// Check if path is valid
		if(!is_dir($path)){
			Debug::debug(get_class(), "setLocalization", "Invalid path", 2);
			return $path;
		}
		
		// Get available languages
		$languages = array();
		foreach(scandir($path) as $lang){
			if($lang != '.' && $lang != '..'){
				$languages[substr($lang, 0, 2)] = $lang;
			}
		}
		
		// Use requested spesific charset
		if(!empty($charSet) && in_array($charSet, $languages)){
			$locale = $charSet;
			Debug::debug(get_class(), "setLocalization", "Use spesific locale $locale", 2);
		}
		// Use requested general charset
		elseif(!empty($charSet) && array_key_exists($charSet, $languages)){
			$locale = $languages[ $charSet ];
			Debug::debug(get_class(), "setLocalization", "Use general locale $locale", 2);
		}
		// No charset selected, try to use browser language
		//
		// TODO: try to use spesific HTTP_ACCEPT_LANGUAGE
		//
		// Spesific language not found, try generic
		elseif( array_key_exists( substr( $_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2 ), $languages ) ){
			$locale = $languages[ substr( $_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2 ) ];
			Debug::debug(get_class(), "setLocalization", "Use general locale $locale", 2);
		}
		// Browser language not supported, use default
		else {
			$locale = 'en_US';
			Debug::debug(get_class(), "setLocalization", "Use default locale $locale", 2);	
		}
		
		// Use utf-8 locale	
		$locale .= ".utf-8";
		Debug::debug(get_class(), "setLocalization", "Set localization $locale");
		putenv("LC_ALL=$locale");
		setlocale(LC_ALL, $locale);
		bindtextdomain("$textDomain", "$path");
		textdomain("$textDomain");
	}
	
	/**
	 * Static function for getting the current locale.
	 * 
	 * @access 	public
	 * @return	string	$locale		Current locale
	 */
	public static function getLocale(){
		$locale = getenv("LC_ALL");
		
		return $locale;
	}
}