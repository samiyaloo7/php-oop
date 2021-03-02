<?php
    class classstest {
        public static $sssvar = "sssvalue";

        public static function gevalue() {
            return self::$sssvar;
        }
    }

    class class2test extends classstest {
        public static function getvalue() {
            return parent::$sssvar;
        }
    }

    /**
     * static method or vatiable can be accessed through classname. no need to create object;
     */
    $ctest = new classstest();
    echo $ctest->gevalue();

    /**
     * static method or vatiable can be accessed through classname. no need to create object;
     */
    echo classstest::gevalue();

    echo class2test::$sssvar;

?>