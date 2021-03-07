<?php

class DbPdo {

    static function connect() {
        try {
            $pdo = new PDO("mysql:host=localhost:3306;dbname=tournamenttracker", 'root', '');
            //echo "connected to db";
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        
        return $pdo;
    }

}
