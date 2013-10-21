<?php
Class GetRandomDateTimeForWeek{
    public function run($week = false){
        if( $week===false OR !in_array($week, range(1,52)) ) $week = date('W');
        
        $date = new DateTime();
        // Set a random time from office hours
        $date->setTime(rand(6,17), rand(0,60));
        // Set a random day
        $date->setISODate(date('Y'), $week, rand(0,7));
        
        return $date->format('Y-m-d H:i:s');
    }
}
?>
