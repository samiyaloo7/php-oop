<!Doctype html>
<?php
    $obj = new dbconnection('phpoop');
?>
<html>

<head>
    <title>php oop.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
    <header>
        <h1> PHP OOP. </h1>
        <div class="frm-div">
            <form id="addfrm" class="myfrm" method="post">
                <div class="group-inputs" hidden>
                    <input type="text" name="id" id="frm_id" placeholder="Enter your name" hidden>
                </div>
                <div class="group-inputs">
                    <input type="text" name="name" id="frm_name" placeholder="Enter your name" Required>
                </div>
                <div class="group-inputs">
                    <input type="email" name="mail" id="frm_mail" placeholder="Enter your mail id" Required>
                </div>
                <div class="group-inputs">
                    <input type="text" name="hobbie" id="frm_hobbie" placeholder="Enter your hobbie" Required>
                </div>
                <div class="group-inputs">
                    <input type="submit" value="Add" name="addbtn" id="abtn" Required>
                    <input type="reset" value="Clear" name="clearbtn" id="cbtn" Required>
                </div>
            </form>
        </div>
    </header>

    <section class="table-sec">
        <div class="tbl-div">
            <table>
                <thead>
                    <tr>
                        <th> Id </th>
                        <th> Name </th>
                        <th> Email </th>
                        <th> Hobbie </th>
                        <th> Delete </th>
                        <th> Update </th>
                    </tr>
                </thead>
                <tbody id="target_body" >
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <p> this is php OOP test with Ajax. </p>
    </footer>
    <script src="js/main.js"></script>
</body>

</html>