<?php 

    /**
     * abstract class
     * - can not be instanciated.
     * - must have at least one abstract method.
     * - all the abstract methods must be overrided by the child.
     * - can have properties & non abstract methods if needed.
     * - abstarct method can not have body part.
     * - nont abstarct method have body part and not neccessory to override tem.
     * - if a child class dont overrid all the abstract method of parent abstarct class then it must be declared as abstract.
     */

    abstract class one {

        public $name;

        abstract function fun_one($name) : string ; 

        abstract function fun_two();

        function func_hello() {
            return "\n hello";
        }
    }

    // class three {
    //     public $th;
    //     public function set_th($th) {
    //         $this->th = $th;
    //     }
    //     public function get_th($th) {
    //         return $this->th;
    //     }
    // }

    class two extends one {
        function fun_one($name) : string {
            $this->name = $name;
            return " hello ".$this->name;
        }
        function fun_two() {
            return "\n this is second method";
        }
        
    }

    $t = new two();
    $t2 = new one();
    echo $t->fun_one("samiyal");
    echo $t->fun_two();
    echo $t->func_hello();
?>