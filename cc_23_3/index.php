<?php

    class dbconnection {
        public $lhost;
        public $user;
        public $pass;
        public $db;
        public $mysqli;
        public $hdata;
        public $tbl = 'coupon_code';

        public function __construct($db) {
            $this->lhost = "localhost";
            $this->user = "root";
            $this->pass = "";
            $this->db = $db;
            $this->mysqli = new mysqli($this->lhost, $this->user, $this->pass, $this->db);
        }
        public function get_cc() {
            if($this->mysqli->query("select * from ".$this->tbl)) {
                // echo "select * from ".$this->tbl;
                $this->hdata = $this->mysqli->query("select * from ".$this->tbl);
                if($this->hdata->num_rows == 0) {
                    echo "<script> alert('table is empty'); </script>";
                    return false;
                }else {
                    return $this->hdata;
                }
            }else {
                echo "<script> alert('table not created'); </script>";
            } 
        }
        public function insert_cc($rname, $status, $website, $coupon, $fromd, $tod, $priority) {
            if($this->mysqli->query("insert into ".$this->tbl."(`r_name`, `status`, `websites`, `coupon`, `startd`, `endd`, `priority`) values('".$rname."', '".$status."', '".$website."', '".$coupon."', '".$fromd."','".$tod."','".$priority."')")) {
                echo "<script> alert('record inserted'); </script>";
            }else {
                echo "<script> alert('record not insertd'); </script>";
            }
        }

        public function delete_cc($id) {
            if ($this->mysqli->query("delete from ".$this->tbl." where id=$id LIMIT 1;")) {
                echo "<script> alert('record $id deleted'); </script>";
            }else {
                echo "<script> alert('record $id not deleted'); </script>";
            }
        }

        public function update_cc($id, $name, $mail, $hobbie) {
            if ($this->mysqli->query("update ".$this->tbl." set name='".$name."', mail='".$mail."', hobbie='".$hobbie."' where id='".$id."' LIMIT 1;")) {
                echo "<script> alert('record updated of $id to $name, $mail, $hobbie'); </script>";
            }else {
                echo "<script> alert('record $id not updated'); </script>";
            }
        }

        public function get_cc_from_id($id) {
            $row = $this->mysqli->query("select * from ".$this->tbl." where id='".$id."'; ");
            if($row->num_rows > 0) {
                return $row;
            }else {
                echo "record for $id not found";
            }
        }
    }


    $db = new dbconnection('m26');

    if(isset($_POST['add'])) {
        if($_POST['add'] == "true") {
            $rname = $_POST['rname'];
            $status = $_POST['rstatus'] == true ? 1 : 0;
            $website = serialize($_POST['rweb']);
            $coupon = $_POST['ccode'];
            $fromd = $_POST['from'];
            $tod = $_POST['to'];
            $priority = $_POST['priority'];

            $db->insert_cc($rname, $status, $website, $coupon, $fromd, $tod, $priority); 
        }
        exit;
    }

    if(isset($_POST['show'])) {
        if($_POST['show'] == true){
            $data = $db->get_cc(); 
            $arr = array();
            if($data->num_rows != 0) {
                while($d = mysqli_fetch_assoc($data)) {
                    $arow = array();

                    $arow[] = $d['id'];
                    $arow[] = $d['r_name'];
                    $arow[] = $d['status'];
                    $arow[] = $d['websites'];
                    $arow[] = $d['coupon'];
                    $arow[] = $d['startd'];
                    $arow[] = $d['endd'];
                    $arow[] = $d['priority'];

                    $arr[] = $arow;
                }
                echo json_encode($arr);
            }else {
                echo "no data not found";
            }
        }
        exit;
    }

    if(isset($_POST['search'])) {
        if($_POST['search'] == true){
            $data = $db->get_cc_from_id($_POST['id']); 
            $arr = array();
            if($data->num_rows != 0) {
                while($d = mysqli_fetch_assoc($data)) {
                    $arow = array();

                    $arow[] = $d['id'];
                    $arow[] = $d['r_name'];
                    $arow[] = $d['status'];
                    $arow[] = $d['websites'];
                    $arow[] = $d['coupon'];
                    $arow[] = $d['startd'];
                    $arow[] = $d['endd'];
                    $arow[] = $d['priority'];

                    $arr[] = $arow;
                }
                echo json_encode($arr);
            }else {
                echo "no data not found";
            }
        }
        exit;
    }

    if(isset($_POST['delete'])) {
        if($_POST['delete'] == true){
            $data = $db->delete_cc($_POST['id']); 
            echo $data;
        }
        exit;
    }

    if(isset($_POST['update'])) {
        if($_POST['update'] == true){
            $data = $db->get_cc_from_id($_POST['id']); 
            $arr = array();
            if($data->num_rows != 0) {
                while($d = mysqli_fetch_assoc($data)) {
                    $arow = array();

                    $arow[] = $d['id'];
                    $arow[] = $d['r_name'];
                    $arow[] = $d['status'];
                    $arow[] = $d['websites'];
                    $arow[] = $d['coupon'];
                    $arow[] = $d['startd'];
                    $arow[] = $d['endd'];
                    $arow[] = $d['priority'];

                    $arr[] = $arow;
                }
                echo json_encode($arr);
            }else {
                echo "no data not found";
            }
        }
        exit;
    }

?>

<!Doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Open Sans', sans-serif;
    }

    .main-wraper {
        width: auto;
        height: auto;
        margin: 0;
        padding: 30px;
        display: block;
    }

    button#add_new_button, button#save_button {
        background-color: #ba4000;
        border-color: #b84002;
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        letter-spacing: .025em;
        padding-bottom: .6875em;
        padding-top: .6875em;

        border: 1px solid;
        border-radius: 0;
        display: inline-block;
        font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-weight: 600;
        line-height: 1.36;
        text-align: center;
        vertical-align: baseline;
    }

    button#search_button {
        background-color: #514943;
        border-color: #514943;
        color: #fff;
        text-shadow: 1px 1px 1px rgb(0 0 0 / 30%);
        border: 1px solid;
        padding: 6px 14px;
    }

    button#search_button>span {
        color: #fff;
        text-shadow: 1px 1px 1px rgb(0 0 0 / 30%);
    }

    .main-head {
        display: block;
        width: 100%;
        display: flex;
        justify-content: flex-end;
        lign-items: center;
    }

    .main-table {
        margin-bottom: 2px;
        max-width: 100%;
        overflow-x: auto;
        padding-bottom: 1px;
        padding-top: 2px;
    }
    .table {
        border-bottom: 2px solid #dee2e6;
    }
    thead>tr {
        background-color: #5f564f;
        cursor: pointer;
        transition: background-color .1s linear;
        z-index: 1;
        border-left-color: #8a837f;
        background-clip: padding-box;
        color: #fff;
        padding: 1rem 1rem;
        position: relative;
        vertical-align: middle;
        font-size: 13px;
        line-height: 1.36;
    }

    tbody td {
        background-color: #fff;
        border-left: .1rem dashed #d6d6d6;
        border-right: .1rem dashed #d6d6d6;
        color: #303030;
        padding: 1rem 1rem;
    }

    .top-row {
        margin-top: 3vh;
        display: flex;
        justify-content: space-between;
    }

    .page-number-div {
        display: flex;
        align-items: center;
        justify-content: left;
    }

    #ppbtn.disabled,
    #npbtn.disabled {
        cursor: default;
        opacity: .5;
        pointer-events: none;
    }

    #ppbtn,
    #npbtn {
        width: 44px;
        box-sizing: border-box;
        background: #e3e3e3;
        border-color: #adadad;
        color: #514943;
        border: 1px solid;
        border-radius: 0;
        display: inline-block;
        font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.36;
        padding: 6px 1em 6px;
        text-align: center;
    }

    #ppbtn {
        margin-right: 25px;
    }

    #npbtn {
        margin-left: 15px;
    }

    #pn_input {
        text-align: center;
        width: 44px;
        box-sizing: border-box;
        background-color: #fff;
        border: 1px solid #adadad;
        border-radius: 1px;
        box-shadow: none;
        color: #303030;
        font-size: 14px;
        font-weight: 400;
        height: auto;
        line-height: 1.36;
        padding: 6px 1px 6px;
        transition: border-color .1s linear;
        vertical-align: baseline;
    }

    th {
        border: .1rem solid #8a837f;
    }

    svg.svg-inline--fa.fa-long-arrow-left.fa-w-14 {
        width: 18px;
        height: auto;
    }

    .main-head>a {
        background-color: transparent;
        border-color: transparent;
        text-shadow: none;
        color: #41362f;

        font-size: 16px;
        letter-spacing: .025em;
        padding: 11px 16px;
        cursor: pointer;
    }

    .main-head>a:hover {
        text-decoration: none;
    }

    button#add_new_button:focus,
    #pn_input:focus,
    #ppbtn:focus,
    #npbtn:focus {
        border: none;
        outline: none;
    }

    /*--------------- */
        .switch {
            position: relative;
            display: inline-block;
            /* width: 60px;
            height: 34px; */
            width: 47px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            /* height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px; */
            height: 22px;
            width: 22px;
            bottom: 1px;
            right: 26px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #79a22e;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #79a22e;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    /*----------------- */

    .i-box {
        display: flex;
        /* align-items: center;
        height: 43px; */
        margin-top: 10px;
        width: 100%;
    }
    .i-box > div, .i-box > input {
        margin-left: 20px;
    }
    .i-box > input, .i-box > div, .i-box > select, .i-box > textarea {
        margin: 0;
        margin: 0 30px;
    }
    .i-box > input {
        width: 100%;
        max-width: 425px;
    }
    .i-box > label {
        width: 20vw;
        text-align: right;
    }

    .main-frm {
        display: none;
    }
    form {
        padding: 30px 0;
    }
    select#r_webiste {
        width: 100%;
        max-width: 250px;
    }
    .frm-top > span {
        color: #303030;
        font-size: 17px;
        font-weight: 600;
        padding: 19px 2px 19px 0;
    }
    .frm-top > p {
        font-size: 20px;
    color: #41362f;
    }
    </style>
</head>

<body>
    <div class="main-wraper main-tbl" id="tbl_box">
        <div class="main-head">
            <button id="add_new_button" class="orange-button">Add New Rule</button>
        </div>
        <div class="top-row">
            <div class="left-top-panel">
                <button id="search_button" class="brown-button"> <span> Search </span> </button>
                <input type="text" id="search_box" >
            </div>
            <div class="right-top-panel">
                <div class="per-page-div">
                </div>
                <div class="page-number-div">
                    <button id="ppbtn"> < </button>
                    <div class="pn-input">
                        <input type="text" id="pn_input" value="1">
                        <span> of <span id="pcount">10</span></span>
                    </div>
                    <button id="npbtn"> > </button>
                </div>
            </div>
        </div>
        <div class="main-table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"> ID </th>
                        <th scope="col"> Rule </th>
                        <th scope="col"> Coupon Code </th>
                        <th scope="col"> Start </th>
                        <th scope="col"> End </th>
                        <th scope="col"> Status </th>
                        <th scope="col"> Web Site </th>
                        <th scope="col"> Priority </th>
                        <th scope="col"> Edit </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>

    <div class="main-wraper main-frm" id="frm_box">
        <div class="main-head">
            <a id="back_btn" href="javascript:void(0);">
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="long-arrow-left" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                    class="svg-inline--fa fa-long-arrow-left fa-w-14">
                    <path fill="currentColor"
                        d="M136.97 380.485l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L60.113 273H436c6.627 0 12-5.373 12-12v-10c0-6.627-5.373-12-12-12H60.113l83.928-83.444c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0l-116.485 116c-4.686 4.686-4.686 12.284 0 16.971l116.485 116c4.686 4.686 12.284 4.686 16.97-.001z"
                        class=""></path>
                </svg>
                Back </a>
            <button id="save_button" class="orange-button">Save</button>
        </div>
        <div class="frm-top" >
            <p> Currently Active </p>
            <span> Rule Information </span>
        </div>
        <div class="main-form">
            <form id="rule_frm">
                <div class="i-box">
                    <label class="required"> Rule Name </label>
                    <input type="text" name="rulename" id="r_name">
                </div>
                <div class="i-box">
                    <label class="required"> Active </label>
                    <div>
                        <label class="switch">
                            <input type="checkbox" id="r_status" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="i-box">
                    <label class="required"> Websites </label>
                    <select multiple id="r_webiste" >
                        <option value="SEVA7"> Main </option>
                    </select>
                </div>
                <div class="i-box">
                    <label class="required"> Coupon </label>
                    <input type="text" id="ccode" >
                </div>
                <div class="i-box">
                    <label class="required"> From </label>
                    <input type="date" id="fromdate" >
                </div>
                <div class="i-box">
                    <label class="required"> To </label>
                    <input type="date" id="todate" >
                </div>
                <div class="i-box">
                    <label class="required"> Priority </label>
                    <input type="text" name="rulepriority" id="r_priority">
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    function delMe(e) {
        $.ajax({
            url: 'index.php',
            data: {delete: true, id: e},
            type: 'post',
            success: function(res) {
                $.ajax({
                    url: 'index.php',
                    data: {show: true},
                    type: 'post',
                    success: function(res) {
                        adata = JSON.parse(res);
                        $('tbody').html('');
                        for(var i = 0; i < adata.length; i++) {
                            $('tbody').append("<tr>"+
                                "<td scope='row'> "+adata[i][0]+" </td>"+
                                "<td scope='row'> "+adata[i][1]+" </td>"+
                                "<td scope='row'> "+adata[i][2]+" </td>"+
                                "<td scope='row'> "+adata[i][3]+" </td>"+
                                "<td scope='row'> "+adata[i][4]+" </td>"+
                                "<td scope='row'> "+adata[i][5]+" </td>"+
                                "<td scope='row'> "+adata[i][6]+" </td>"+
                                "<td scope='row'> "+adata[i][7]+" </td>"+
                                "<td scope='row'> <button onclick='delMe("+adata[i][0]+");' >Delete</button> <button onclick='upMe("+adata[i][0]+");' >Edit</button> </td>"+
                                "</tr>");
                        }
                    }
                });
            }
        });
    }
    function upMe(e) {
        $.ajax({
            url: 'index.php',
            data: {update: true, id: e},
            type: 'post',
            success: function(res) {
                // console.log(res);
                adata = JSON.parse(res);
                for(var i = 0; i < adata.length; i++) {
                    $('#r_name').val(adata[i][1]);
                    // $('#r_status:checked').length > 0;
                    $('#r_webiste').val(adata[i][3]);
                    $('#ccode').val(adata[i][4]);
                    $('#fromdate').val(adata[i][5]);
                    $('#todate').val(adata[i][6]);
                    $('#r_priority').val(adata[i][7]);
                    $('#tbl_box').hide();
                    $('#frm_box').show();
                }
            }
        });
    }
    $(function() {   
        function loadData() {
            $.ajax({
                url: 'index.php',
                data: {show: true},
                type: 'post',
                success: function(res) {
                    adata = JSON.parse(res);
                    $('tbody').html('');
                    for(var i = 0; i < adata.length; i++) {
                        $('tbody').append("<tr>"+
                            "<td scope='row'> "+adata[i][0]+" </td>"+
                            "<td scope='row'> "+adata[i][1]+" </td>"+
                            "<td scope='row'> "+adata[i][2]+" </td>"+
                            "<td scope='row'> "+adata[i][3]+" </td>"+
                            "<td scope='row'> "+adata[i][4]+" </td>"+
                            "<td scope='row'> "+adata[i][5]+" </td>"+
                            "<td scope='row'> "+adata[i][6]+" </td>"+
                            "<td scope='row'> "+adata[i][7]+" </td>"+
                            "<td scope='row'> <button onclick='delMe("+adata[i][0]+");' >Delete</button>  <button onclick='upMe("+adata[i][0]+");' >Edit</button> </td>"+
                            "</tr>");
                    }
                }
            });
        }
        $('#search_button').click(function() {
            var i = $('#search_box').val();
            if(i != '') {
                $.ajax({
                    url: 'index.php',
                    data: {search: true, id: i},
                    type: 'post',
                    success: function(res) {
                        if(res.includes("record")) {
                            $('tbody').html('');
                        }else {
                            adata = JSON.parse(res);
                            $('tbody').html('');
                            for(var i = 0; i < adata.length; i++) {
                                $('tbody').append("<tr>"+
                                    "<td scope='row'> "+adata[i][0]+" </td>"+
                                    "<td scope='row'> "+adata[i][1]+" </td>"+
                                    "<td scope='row'> "+adata[i][2]+" </td>"+
                                    "<td scope='row'> "+adata[i][3]+" </td>"+
                                    "<td scope='row'> "+adata[i][4]+" </td>"+
                                    "<td scope='row'> "+adata[i][5]+" </td>"+
                                    "<td scope='row'> "+adata[i][6]+" </td>"+
                                    "<td scope='row'> "+adata[i][7]+" </td>"+
                                    "<td scope='row'> <button onlick='delMe("+adata[i][0]+")' >Delete</button> </td>"+
                                    "</tr>");
                            }
                        }
                    }
                });
            }else {
                loadData();
            }
        });
        loadData();
        $('#add_new_button').click(function() {
            $('#tbl_box').hide();
            $('#frm_box').show();
        });
        $('#back_btn').click(function() {
            $('#tbl_box').show();
            $('#frm_box').hide();

            $('#r_name').val('');
            $('#r_webiste').val('');
            $('#ccode').val('');
            $('#fromdate').val('');
            $('#todate').val();
            $('#r_priority').val('');
            
            loadData();
        });
        $('#save_button').click(function () {
            var rn = $('#r_name').val();
            var rs = $('#r_status:checked').length > 0;
            var rw = $('#r_webiste').val();
            var rc = $('#ccode').val();
            var rf = $('#fromdate').val();
            var rt = $('#todate').val();
            var rp = $('#r_priority').val();

            var datatopass = {
                add: "true",
                rname : rn,
                rstatus : rs,
                rweb : rw,
                ccode : rc,
                from : rf,
                to : rt,
                priority : rp
            };

            console.log(datatopass);

            $.ajax({
                url: 'index.php',
                data: datatopass,
                type: 'post',
                success: function(res) {
                    console.log(res);
                }
            });

        });
         
    });
    </script>
</body>

</html>