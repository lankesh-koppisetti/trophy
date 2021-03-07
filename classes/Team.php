<?php

require_once __DIR__ . './Db.php';
require_once './classes/DbPdo.php';

class Team extends DB {

    public function Team() {
        parent::Db();
    }

    public function getTeamByTeamId($team_id) {
        $query = "select * from teams where team_id =:team_id";
        $stmt = DbPdo::connect()->prepare($query);
        //$team_id =1 ;
        $stmt->bindParam("team_id", $team_id);
        $stmt->execute();
        if ($stmt) {

            while ($rs = $stmt->fetch()) {
                $team_name = $rs["team_name"];
            }
        }
        // print_r($team_name);
        return $team_name;
    }

    public function getTeams() {
        $query = "select * from teams ";
        $stmt = DbPdo::connect()->prepare($query);
        $stmt->bindParam("team_id", $team_id);
        $stmt->execute();
        if ($stmt) {

            $teams = $stmt->fetchAll();
        }
        //print_r($teams);
        return $teams;
    }

}
