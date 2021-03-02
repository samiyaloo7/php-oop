<?php
    require "connection.inc.php";
    $db = new dbconnection('phpoop');
    if(!isset($_GET['request'])) {
        $id = file_get_contents("php://input");
        echo "deleting... $id";
        $db->delete_hobbie($id);
        exit;
    }
?>