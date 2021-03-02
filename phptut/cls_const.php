<?php 

    /**
     * - are global automatically across the entire script.
     * - its value cannot be changed during execution of script.
     * - in class declaration is done usind const key word.
     * - define() method is used to declare constants.
     */

    namespace samiyal; // declaring namespace.
    use samiyal as sam; // namespace alias.
    // define("MYNAME", "sagar");
    define("MYNAME", "sagar", true);// with case insensitivity;
    define("frnds", ['dddon', "bhatti", 'yash', 'nayan']);

    class cls_const {
        const NAME = "samiyal";
        public static function clsconst() {
            echo self::NAME;
        }
    }

    echo cls_const::clsconst();
    echo "\n".MYNAME;
    echo "\n".myname;
    echo "\n".implode(",",frnds);
?>