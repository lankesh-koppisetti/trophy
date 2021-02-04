<?php

class Db {

    public $db;

    function Db() {
        $this->db = mysqli_connect("localhost", "root", "", "tournamenttracker");
        
        if ($this->db) {
            //echo "Good. connected";
        } else {
            echo "DB not connected";
            die();
        }
    }

}

$db=new Db();