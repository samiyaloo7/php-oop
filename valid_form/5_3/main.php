<?php 
    if(!isset($_GET['equest'])) {

        $data = json_decode(file_get_contents("php://input"));
        // echo "\n data :".json_encode($data);

        $db = new mysqli("localhost", "root", "", "m26");
        if($db->query("delete from moa2 where 1;")) {
            // echo "all data deleted";
        }else {
            // echo "deleting data error";
            echo 0;
        }

        $state = $data->st;
        $cg = $data->cg;
        $ma = $data->ma;
        $msg = $data->msg;

        if($db->query("insert into moa2 values('".$state."', '".serialize($cg)."', '".serialize($ma)."', '".$msg."');")) {
            // echo " is inserted";
            echo 1;
        }else {
            echo 0;
        }

    }else {
        echo "not data";
    }

?>

