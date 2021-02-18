<?php

    class acc_mod {
        public $name;
        private $password;
        protected $adhar_no;
    
        public function getName() {
                return $this->name;
        }

        public function setName($name) {
                $this->name = $name;
                return $this;
        }

        public function getPassword() {
                return $this->password;
        }

        public function setPassword($password) {
                $this->password = $password;
                return $this;
        }

        public function getAdhar_no() {
                return $this->adhar_no;
        }

        public function setAdhar_no($adhar_no) {
                $this->adhar_no = $adhar_no;
                return $this;
        }        

    }

    class childof_accmod extends acc_mod {
        public $child_name;
        
        public function getChild_name() {
                return $this->child_name;
        }

        public function setChild_name($child_name) {
                $this->child_name = $child_name;
                return $this;
        }

        public function getAll() {
            return [$this->child_name, $this->name, $this->adhar_no, $this->password];
        }

        public function setAll($child_name, $name, $adhar_no, $password) {
            $this->child_name = $child_name;
            $this->name = $name;
            $this->adhar_no = $adhar_no;
            $this->password = $password;        
        }

    }

?>