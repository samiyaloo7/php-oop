<?php 
    class clsconst {
        var $data;

        public function __construct($data)
        {
                $this->data = $data;
                // echo "inside constructor";
        }

        /**
         * Get the value of datatobeset
         */ 
        public function getData()
        {
                // echo "inside getter";
                return $this->data;
        }

        /**
         * Set the value of datatobeset
         *
         * @return  self
         */ 
        public function setData($data)
        {
                $this->data = $data;

                return $this;
        }
    }

?>


