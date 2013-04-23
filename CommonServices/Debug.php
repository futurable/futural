<?php
/**
 *  AuthComponent.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Annika Granlund <annika.granlund@futurable.fi>
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
 * Debug for debugging.
 * If debuglevel is 0, debug is passive.
 * 
 * @package   CommonServices
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-09-07
 */

class Debug {
	
	public function __construct(){
	}
	
	/**
	 * Static function for debugging.
	 * 
	 * Debuglevel defines how deep debug level is printed.
	 * Debug off => $debuglevel = 0
	 * Debug on  => $debuglevel = 1 ->
	 * 
	 * @access public
	 * @param string $className
	 * @param string $functionName
	 * @param string $message
	 * @param integer $level
	 */
	public static function debug( $className, $functionName, $message, $level = 1) 
	{
		$debugLevel = 0;

        if ( is_numeric($debugLevel) and $debugLevel >= $level )
        {
            //$time = strftime("%Y-%m-%d %H:%m");
            print "<br/>[debug $className::$functionName] $message\n";
        }
	}
	
}

?>