<?php
    require "connection.inc.php";
    $db = new dbconnection('phpoop');

    if(!isset($_GET['request'])) {

        $data = json_decode(file_get_contents("php://input"));

        $db->update_hobbie($data->id, $data->nm, $data->ml, $data->hb);

        exit;
    }

?>