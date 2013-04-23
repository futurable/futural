<?php
class CommonServices
{
    
    /**
     * Takes a string and strips all non-alphanumerical characters
     * 
     * @param string $name
     * @return string $tag
     */
    public function createTagFromName($name){
        require_once('CommonServices/removeAccents.php');
                       
        // Name to lowercase
        $tag = strtolower($name);
        
        // Replace accented letters
        $removeAccents = new removeAccents($tag);
        $tag = $removeAccents->get();

        // Remove illegal characters
        $tag = preg_replace("/[^A-Za-z0-9]/", '', $tag);

        // Allow 16 characters or less
        $tag = substr($tag, 0, 16);

        return $tag;
    }
    
}