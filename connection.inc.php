<?php
    class dbconnection {
        public $lhost;
        public $user;
        public $pass;
        public $db;
        public $mysqli;
        public $hdata;

        public function __construct($db) {
            $this->lhost = "localhost";
            $this->user = "root";
            $this->pass = "";
            $this->db = $db;
            if($this->mysqli = new mysqli($this->lhost, $this->user, $this->pass, $this->db)) {
                $this->create_table();
            }else {
                echo "<script> alert('database not connected'); </script>";
            }
        }

        public function create_table() {
            if($this->mysqli->query("select 1 from hobbies LIMIT 1;")) {
                $this->hdata = $this->mysqli->query("select * from hobbies");
                if($this->hdata->num_rows == 0) {
                    // echo "<script> alert('table is empty'); </script>";
                }
            }else {
                echo "<script> alert('table not exists'); </script>";
                if($this->mysqli->query("create table if not exists hobbies(id int(3) NOT NULL, name varchar(255), mail varchar(255), hobbie varchar(255), PRIMARY KEY (id));")) {
                    echo "<script> alert('table created'); </script>";
                }else {
                    echo "<script> alert('table not created'); </script>";
                } 
            } 
        }
        public function get_hobbies() {
            if($this->mysqli->query("select * from hobbies")) {
                $this->hdata = $this->mysqli->query("select * from hobbies");
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

        public function insert_hobbie($name, $mail, $hobbie) {
            if ($this->mysqli->query('insert into hobbies(name, mail, hobbie) values("'.$name.'","'.$mail.'","'.$hobbie.'")')) {
                echo "<script> alert('record inserted'); </script>";
            }else {
                echo "<script> alert('record not insertd'); </script>";
            }
        }

        public function delete_hobbie($id) {
            if ($this->mysqli->query("delete from hobbies where id=$id LIMIT 1;")) {
                echo "<script> alert('record $id deleted'); </script>";
            }else {
                echo "<script> alert('record $id not deleted'); </script>";
            }
        }

        public function update_hobbie($id, $name, $mail, $hobbie) {
            if ($this->mysqli->query("update hobbies set name='".$name."', mail='".$mail."', hobbie='".$hobbie."' where id='".$id."' LIMIT 1;")) {
                echo "<script> alert('record updated of $id to $name, $mail, $hobbie'); </script>";
            }else {
                echo "<script> alert('record $id not updated'); </script>";
            }
        }

        public function get_hobbie_from_id($id) {
            $row = $this->mysqli->query("select * from hobbies where id='".$id."'; ");
            if($row->num_rows > 0) {
                return $row;
            }else {
                echo "record for $id not found";
            }
        }

    }

?>