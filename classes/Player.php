<?php

require_once __DIR__ . './Db.php';

class Player extends Db {

    function Player() {
        //Not yet implemented
        parent::Db();
    }

    public function getPlayerById($playerId) {
        $query = "select * from players where player_id=" . $playerId;
        $runQuery = mysqli_query($this->db, $query);

        $player = [];
        if ($runQuery) {
            while ($rs = mysqli_fetch_assoc($runQuery)) {
                $player = $rs;
            }
        }

        return $player;
    }

    public function doLogin($player_email, $player_password) {



        //get password hash by md5().
        $md5 = md5($player_password);

        $query = "select * from players where player_email='$player_email' and password='$md5'";
        $runselect = mysqli_query($this->db, $query);


        $playerInfo = [];
        if ($runselect && mysqli_num_rows($runselect) > 0) {

            while ($rs = mysqli_fetch_assoc($runselect)) {

                $playerInfo = $rs;
            }
        }


        return $playerInfo;
    }

    public function insertPlayerDetails($postAry) {
        if ($postAry) {


            $player_name = $postAry['player_name'];
            $player_email = $postAry['player_email'];
            $player_age = $postAry['player_age'];
            $player_team_id = $postAry['team_id'];
            $passwordHash = md5($postAry['player_password']);
            $player_role = $postAry['role_id'];


            $insert_query = sprintf("insert into players (players_name,players_email,players_age,team_id,password,player_role) values ('%s','%s',%s,%d,'%s,%d')", $player_name, $player_email, $player_age, $player_team_id, $passwordHash, $player_role);

            $insert = mysqli_query($this->db, $insert_query);
        }

        return insert;
    }

    public function updatePlayer($player_id, $postAry) {

        if ($postAry) {
            $player_name = $postAry['player_name'];
            $player_email = $postAry['player_email'];
            $player_age = $postAry['player_age'];
            $player_team_id = $postAry['team_id'];
            $passwordHash = md5($postAry['player_password']);
            $player_role = $postAry['player_role'];


            $update_query = sprintf("update players set players_name='%s',players_email='%s',players_age='%d',team_id='%d',role_id='%d' where players_id=%d", $player_name, $player_email, $player_age, $player_team_id, $player_role, $player_id);


            $update = mysqli_query($this->db, $update_query);
        }
        return $update;
    }

}
