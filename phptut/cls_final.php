<?php
    class finaltest {
        var $pin = '098';
        public function hello() {
            return "\n hello";
        }
        public final function finalhello() {
            return "\n hello from final method";
        }
    }

    class testtest extends finaltest {
        public function hello() {
            return "\n overrided funtion ";
        }
    }

    $ogj = new testtest() ;
    echo $ogj->hello(); // Error :  Class testtest may not inherit from final class (finaltest) in /opt/lampp/htdocs/phpoop/phptut/cls_final.php
    echo $ogj->finalhello();


?>