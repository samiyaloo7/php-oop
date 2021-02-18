<!Doctype html>
<html>

<head>
    <title>php oop.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
    <header>
        <h1> PHP OOP. </h1>
    </header>

    <section class="table-sec">
        <div class="tbl-div">
            <table>
                <thead>
                    <tr>
                        <th> id </th>
                        <th> name </th>
                        <th> email </th>
                        <th> pass </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $data = mysqli_query($con, "select * from users");
                        if($data->num_rows != 0) {
                            while($d = mysqli_fetch_array($data)) {
                                echo "<tr><td> ".$d['id']." </td>";
                                echo "<td> ".$d['name']." </td>";
                                echo "<td> ".$d['email']." </td>";
                                echo "<td> ".$d['pass']." </td></tr>";
                            }
                        }else {
                            print('data not found');
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <p> this is php oop test. </p>
    </footer>
</body>

</html>