<?php 
    /**
     * Loops...
     */

    // 1. while loop
    // $l = 10;
    // $i = 1;
    // while($i <= 10)  {
    //     echo($i." hello times.");
    //     $i = $i + 1;
    // }

    // 2. do while loop
    // do{
    //     $i++;
    //     print("\n".$i." hello time");
    // }while($i < $l);

    // 3. for loop.
    // for(;$i < $l; $i++) { // for($i = 1; $i < $l; $i++) {
    //     echo("\n temp");
    // }

    // test.....
    $counter = 0;
    do{
        if($counter == 0) {
            $counter++;
            continue;
        }
        print("\n $counter hlasdf;");
        $counter++;
    }while($counter <= 10);
?>