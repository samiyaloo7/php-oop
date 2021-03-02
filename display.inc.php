<?php
    require "connection.inc.php";
    $db = new dbconnection('phpoop');

    if(!isset($_GET['request'])) {
        $data = $db->get_hobbies();
        $arr = array();
        if($data->num_rows != 0) {
            while($d = mysqli_fetch_assoc($data)) {
                $arow = array();

                $arow[] = $d['id'];
                $arow[] = $d['name'];
                $arow[] = $d['mail'];
                $arow[] = $d['hobbie'];

                $arr[] = $arow;
            }
            echo json_encode($arr);
        }else {
            echo "no data not found";
        }
        exit;
    }

?>