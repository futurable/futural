<?php
/** Environment configuration **/

Class EnvironmentConfiguration{
	
	private $includePath;
	private $cryptKey;
	
	public function __construct(){
		$this->includePath = '/var/www/';
		$this->cryptKey = '128BitsOr32BytesLongCryptkey1234';
	}
	
	public function getIncludePath(){
		return $this->includePath;
	}
	public function getCryptKey(){
		return $this->cryptKey;
	}
}
?>