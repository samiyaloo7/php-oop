<?php

    require "con.php";

    if(!isset($_GET['request'])) {
        $data = json_decode(file_get_contents("php://input"));

        $fname =  $data->fname; // string..
        $lname =  $data->lname; // string..
        $phone =  $data->phone;
        $city =  $data->city; // string..
        $country =  $data->country; // string..
        $email =  $data->email;
        $pass =  $data->pass;
        $pro =  $data->pro;
        $zip =  $data->zip;
        //-- optional --
        $mname = $data->mname;
        $namep = $data->namep;
        $names = $data->names;
        $dob = $data->dob;
        $taxno = $data->tax;
        $gender = $data->gender;
        $add = $data->add;
        $comp = $data->comp;
        $issub = $data->issub;

        if(empty($phone) || empty($city)  || empty($email) || empty($pro) || empty($zip) || empty($pass) || empty($country)) {
            echo "fill up all the fields";
        }else {
            
            if(!preg_match('/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/', $email)) {
                echo "email formate is invalid";
            }else 
            if(strlen($pass) < 8) {
                echo "password must be 8 letters long";
            }else {
                if($dob == "" || $dob == 'dob') {
                    $query_string = "insert into b2b_users(namep, fname, mname, lname, names, is_sub, vat_no, gender, company, phone, st_add, city, state, zip, country, email, pass) values('".$namep."', '".$fname."', '".$mname."', '".$lname."', '".$names."', '".$issub."', '".$taxno."', '".$gender."', '".$comp."', '".$phone."', '".$add."', '".$city."', '".$pro."', '".$zip."', '".$country."', '".$email."', '".md5($pass)."')";
                }else {
                    $query_string = "insert into b2b_users(namep, fname, mname, lname, names, is_sub, dob, vat_no, gender, company, phone, st_add, city, state, zip, country, email, pass) values('".$namep."', '".$fname."', '".$mname."', '".$lname."', '".$names."', '".$issub."', '".$dob."', '".$taxno."', '".$gender."', '".$comp."', '".$phone."', '".$add."', '".$city."', '".$pro."', '".$zip."', '".$country."', '".$email."', '".md5($pass)."')";
                }
                if($db->query($query_string)) {
                    echo "inserted";
                }else {
                    echo "query error";
                }
                
            }
        }

    }
?>