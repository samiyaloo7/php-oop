<?php
    
    /**
     * continue with for;
     */
    for($i = 0; $i <= 10; $i++) {
        if($i == 0) { continue; }
        echo "$i samiyal\n";
    }

    /**
     * continue with for while;
     */
    $i = 0; 
    while($i <= 10) {
        if($i == 0) { 
            $i++; 
            continue; 
        }
        echo "$i samiyal\n";
        $i++;
    }

    /**
     * continue with for each;
     */
    $arr = array(1, 2, 3, 4, 5);
    foreach($arr as $a) {
        echo "$a";
        if($a == 5) { continue; }        
        echo "\n";
    }
?>