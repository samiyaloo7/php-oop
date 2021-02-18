<?php

    /**
     * constructor ...
     */

    // require "cls_constructor.php";

    // $objconst = new clsconst("hello");
    // // $objconst->setData("hello2");
    // echo $objconst->getData();

?>

<?php 

    /**
     * getter & setter ...
     */

    // require "cls_getter_setter.php";

    // /**
    //  * creating instance/object of a team class.
    //  */
    // $t = new team();

    // /**
    //  * setting vlue of object properties using setter methods.
    //  */
    // $t->setTeam_memebers(['samiyal', 'sagar', 'sam']);
    // $t->setTeam_name('bajarang dal');
    
    // /**
    //  * getting vlue of object properties using getter methods.
    //  */
    // echo " team members : ".implode(",", $t->getTeam_memebers());
    // echo "\n team name : ".$t->getTeam_name();
?>

<?php 
    /**
     * access modifier ...
     */

    require "cls_acc_modifier.php";

    $obj = new childof_accmod();
    // $obj->setChild_name('child1');
    // $obj->setName('samiyal');
    // $obj->setAdhar_no('98739847298347');
    // $obj->setPassword('*****');
    $obj->setAll('child1', 'samiyal', '9087838362', '653513');


    $obj->getChild_name();
    echo $obj->getName();
    echo $obj->getAdhar_no();
    echo $obj->getPassword(); // will not display in output ..it is private only.
    // echo implode(',', $obj->getAll());

?>