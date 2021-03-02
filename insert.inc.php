<?php
    require "connection.inc.php";
    $db = new dbconnection('phpoop');

    if(!isset($_GET['request'])){
        $data = json_decode(file_get_contents("php://input"));

        $name = $data->nm;
        $mail = $data->ml;
        $hobbie = $data->hb;

        $db->insert_hobbie($name, $mail, $hobbie);
        exit;
     }
?>