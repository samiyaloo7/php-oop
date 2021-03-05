<?php
    $db = new mysqli("localhost", "root", "", "m26");
    
    if(!$db) {
        echo "data base not connected";
    }else {
        $ar = [];
        $data = $db->query('select * from moa2');
        while($d=mysqli_fetch_assoc($data)) {
            $a = [];
            $a[] = $d['state'];
            $a[] = unserialize($d['cg']);
            $a[] = unserialize($d['ma']);
            $a[] = $d['msg'];
            $ar[] = $a;
        }
        echo json_encode($ar);
    }
?>