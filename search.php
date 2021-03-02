<?php
    require "connection.inc.php";
    $db = new dbconnection('phpoop');

    if(!isset($_GET['request'])) {
        $id = file_get_contents("php://input");

        $row = $db->get_hobbie_from_id($id);

        if($row) {
            $arrow = array();
            while($r = mysqli_fetch_assoc($row)) {
                $arrow[] = $r['id'];
                $arrow[] = $r['name'];
                $arrow[] = $r['mail'];
                $arrow[] = $r['hobbie'];
            }
            echo json_encode($arrow);
        }else {
            echo "record not found";
        }

        exit;
    }

?>