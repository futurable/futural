<?php
/**
 * Divides 100 percentage to given amount of portions
 * The randomization crude and approximate, 
 * so it doesn't get the lowest and
 * the highest numbers as much as the middle ones.
 * Don't use this if you need "true" randomization.
 */
Class GetRandomPercentagePortions {
    public function run($parts){
        $numbers = array();
        $portions = array();

        while($parts > 0){
            $numbers[] = rand(1,100);
            $parts--;
        }
        $sum = array_sum($numbers);
        
        foreach($numbers as $number){
            $portions[] = round( ($number/$sum)*$parts*100 );
        }
     
        return $portions;
    }
}

?>