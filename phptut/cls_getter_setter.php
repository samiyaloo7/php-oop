<?php

    /**
     * class..
     * - class is a template for object/class instance.
     * - mulatiple objects/instance can be made out of one class.
     * - class can have properties, and methods.
     * - can containes : constructors, getters&setters.
     * - class can extend only one class but can impliment multiple interfaces.
     */

    class team {
        var $team_name;
        var $team_memebers;

        /**
         * Get the value of team_memebers
         */ 
        public function getTeam_memebers()
        {
                return $this->team_memebers;
        }

        /**
         * Set the value of team_memebers
         *
         * @return  self
         */ 
        public function setTeam_memebers($team_memebers)
        {
                $this->team_memebers = $team_memebers;

                return $this;
        }

        /**
         * Get the value of team_name
         */ 
        public function getTeam_name()
        {
                return $this->team_name;
        }

        /**
         * Set the value of team_name
         *
         * @return  self
         */ 
        public function setTeam_name($team_name)
        {
                $this->team_name = $team_name;

                return $this;
        }
    }


?>