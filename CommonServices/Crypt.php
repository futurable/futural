<?php
/**
 *  Crypt.php
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
 * Crypt functions
 * 
 * @package   CommonServices
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-09-07
 */

require_once 'Debug.php';

class Crypt {
	
	public function __construct(){
	}
	
	/**
	 * Static function for encrypting strings.
	 * 
	 * @access 	public
	 * @param 	string 	$data		Data to be encrypted
	 * @param 	string 	$key		The same key is required to decrypt the encrypted data, default false
	 * @return 	mixed  	$encrypted 
	 */
	public static function encrypt( $data , $key = false ) 
	{
		Debug::debug(get_class(), "encrypt", "Start");
		
		// Make stronger encryption key
		$cryptKey = Crypt::makeCryptKey($key);
		if(!$cryptKey){
			Debug::debug(get_class(), "encrypt", "Cannot create crypt key.", 2);
			return false;
		}
		
		// Add salt to data
		$salt = Crypt::makeRandomString(10,2);
		$data = $salt.$data;
		
		// Create initialization vector for CBC block cipher mode using Rijandael 256bit cipher
		$ivk = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
		$iv = mcrypt_create_iv($ivk, MCRYPT_RAND);
		
		// Encrypt the string
		$encryptedString = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $cryptKey, $data, MCRYPT_MODE_CBC, $iv);
		$encrypted = $encryptedString.$iv;
		$encrypted = base64_encode($encrypted);
		$encrypted = urlencode($encrypted);
		
		// Return the encrypted string and the initialization vector
		Debug::debug(get_class(), "encrypt", "Return encrypted data.");
		
		return $encrypted;
	}
	
	/**
	 * Static function for decrypting strings.
	 * 
	 * @access 	public
	 * @param 	string 	$data		Data to be decrypted
	 * @param 	string 	$key		The key used to encrypt the data, default false
	 * @return 	mixed  	$decrypted 
	 */
	public static function decrypt( $data , $key = false ) 
	{
		Debug::debug(get_class(), "decrypt", "Start");
		
		// Decode data
		$data = urldecode($data);
		$data = base64_decode($data);
		
		// Make stronger encryption key
		$cryptKey = Crypt::makeCryptKey($key);
		
		// Count the initialization vector size and use it to get the IV from given data
		$ivk = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
		$iv = substr($data, -$ivk);
		
		// Strip the IV from given data
		$data = substr($data, 0, -$ivk);
		
		// Decrypt the data
		$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $cryptKey, $data, MCRYPT_MODE_CBC, $iv);
		
		// Remove salt
		$decrypted = substr($decrypted, 10);
		
		// Trim the return data to prevent preceding space
		Debug::debug(get_class(), "decrypt", "Return decrypted data");
		return trim($decrypted);
	}
	
	/**
	 * Static function for making a 256bit encryption key
	 * 
	 * @access 	private
	 * @param 	string 	$key		Key to be used as base
	 * @return 	mixed  	$cryptKey	256bit encryption key 
	 */
	private static function makeCryptKey( $key ) {
		
		Debug::debug(get_class(), "makeCryptKey", "Start");
		
		// Make 256bit encryption key using given key and predefined key
		
		// Get cryptKey from external file
		$handle = file_get_contents("Conf/conf-futurality.xml", true);
		$xml = new SimpleXMLElement($handle);
		$predefinedKey = $xml->cryptKey;

		// Check that cryptKey is set
		if(strlen($predefinedKey)<16 || strlen($predefinedKey)>32){
			Debug::debug(get_class(), "makeCryptKey", "Invalid crypt key in cryptKey.xml", 2);
			return false;
		}
		
		$tempkey = substr($key,0,16).$predefinedKey;
		
		$cryptKey = substr($tempkey, 0, 32);
		Debug::debug(get_class(), "makeCryptKey", "Return crypt key");
		return $cryptKey;
	}
	
	/**
	 * Static function for making random strings
	 * 
	 * mode	1	=	numeric [0-9]
	 * mode 2	=	alphanumeric [0-9a-Z]
	 * mode 3	=	full [0-9a-Z!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]
	 * 
	 * WARNING! Use mode 3 with extreme caution, as it contains php-reserved characters
	 * 
	 * @access 	public
	 * @param 	int 	$length		Random string length 
	 * @param	int		$mode		String mode, default is 1 (numeric)
	 * @return 	mixed  	$string		The random generated string
	 */
	public static function makeRandomString($length, $mode = 1){
		Debug::debug(get_class(), "makeRandomString", "Start");
		// Make the characters
		$characters = array();
		
		// Numeric
		if($mode >= 1){
			foreach(range(0,9) as $number){
				$characters[] = $number;
			}
		}
		// Alphanumeric
		if($mode >= 2){
			foreach(range('a','z') as $letter){
				$characters[] = $letter;
				$characters[] = strtoupper($letter);
			}
		}
		// Punctuation
		if($mode >= 3){
			// Punctuation characters to array
			$punctuation = addslashes("!#$%&*+,-.:<=>?@[]^_`{|}~");
			$punctuation = chunk_split($punctuation,1,'x');
			$punctuation = explode('x',$punctuation);
			
			foreach($punctuation as $char){
				$characters[] = $char;
			}
		}
		
		// Make random string
		$randomString = null;
		for($i=0 ; $i<$length ; $i++){
			$randomString .= $characters[ array_rand($characters, 1) ];
		}
		
		Debug::debug(get_class(), "makeRandomString", "Return random string");
		return $randomString;	
	}
}
?>