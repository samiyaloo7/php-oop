<?php
    $db = new mysqli("localhost", "root", "", "m26");
    if(!$db) {
        echo "db not connected";
    }
?>