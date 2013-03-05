<?php
/**
 *  DatabaseConnect.php
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

require_once '../Conf/DatabaseConfiguration.php';

/**
 * DatabaseConnect for database connections
 * 
 * @package   CommonServices
 * @author    Annika Granlund
 * @copyright 2012 <annika.granlund@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-09-07
 */

class DatabaseConnect {
	/**
	 * Database host name
	 * @var string $dbhost
	 */
	private $dbhost;
	/**
	 * Database user name
	 * @var string $dbuser
	 */
	private $dbuser;
	/**
	 * User's database password
	 * @var string $dbpass
	 */
	private $dbpass;
	/**
	 * Database name
	 * @var string $dbname
	 */
	private $dbname;
	/**
	 * Database link
	 * @var resource $link
	 */
	private $link;

	/**
	 * Open database connect
	 */
	public function __construct() {
		Debug::debug(get_class(), "__construct", "Start");
		$success = FALSE;
		
		$DBConfig = new DatabaseConfiguration( $this );
		
		// initialize attributes
		$this->dbhost = $DBConfig->getDbHost();
		$this->dbuser = $DBConfig->getDbUser();
		$this->dbpass = $DBConfig->getDbPass();
		$this->dbname = $DBConfig->getDbName();
		
		$this->link = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass);

		if (!$this->link) {
			Debug::debug(get_class(), "__construct", "Could not connect to db.", 2);
		    die('Could not connect: ' . mysql_error());
		}
		
		// select database
		$connect = mysql_select_db($this->dbname, $this->link);
		if ($connect === true) {
			Debug::debug(get_class(), "__construct", "Db connect succesfull.", 2);
			$success = TRUE;
		} 
		
		return $connect;
	}
	
	
	public function databaseClose() {
		mysql_close($this->link);
	}
}

?>