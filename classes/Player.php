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

    /**
     * 
     * @param type $player_email ex: send login email
     * @param type $player_password ex: send user password
     * @return type Boolean. 
     */
    public function doLogin($player_email, $player_password) {

        //get password hash by md5().
        $md5 = md5($player_password);
        $player_email = mysqli_real_escape_string($this->db, $player_email);

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
        print_r($postAry);
        
        if ($postAry) {


            $player_name = $postAry['player_name'];
            $player_email = $postAry['player_email'];
            $player_age = $postAry['player_age'];
            $player_team_id = $postAry['team_id'];
            $passwordHash = md5($postAry['player_password']);
            $player_role = $postAry['player_role'];


           echo $insert_query = sprintf("insert into players (player_name,player_email,player_age,team_id,password,role_id) values ('%s','%s',%d,%d,'%s',%d)", $player_name, $player_email, $player_age, $player_team_id, $passwordHash, $player_role);

            $insert = mysqli_query($this->db, $insert_query);
         
            var_dump($insert);
        }

        return $insert;
    }

    public function updatePlayer($player_id, $postAry) {

        if ($postAry) {
            $player_name = $postAry['player_name'];
            $player_email = $postAry['player_email'];
            $player_age = $postAry['player_age'];
            $player_team_id = $postAry['team_id'];
            //$passwordHash = md5($postAry['player_password']);
            $player_role = $postAry['player_role'];
            $profile_pic=$postAry['profile_pic'];
                    

            $update_query = sprintf("update players set player_name='%s',player_email='%s',player_age='%d',team_id='%d',role_id='%d',profile_pic='%s' where player_id=%d", $player_name, $player_email, $player_age, $player_team_id, $player_role,$profile_pic, $player_id);

            $update = mysqli_query($this->db, $update_query);
            //var_dump($update);
        }
        return $update;
    }

    public function deletePlayer($player_id) {

        $query = "delete from players where player_id=" . $player_id;
        return mysqli_query($this->db, $query);
    }

    public function getCaptainTeamMembers($team_id, $searchKey, $sortBy) {
        if ((strlen($searchKey) == 0) && ($sortBy == '')) {
            $select_query = "select * from players where team_id=" . $team_id;
        } elseif ((strlen($searchKey)) == 0 && (($sortBy) == 'age')) {
            $searchKey = strtolower($searchKey);
            $select_query = "select * from players where team_id=" . $team_id . " and lower(player_name) like '%$searchKey%' order by player_age ASC";
        } elseif ((strlen($searchKey)) == 0 && (($sortBy) == 'name')) {
            $searchKey = strtolower($searchKey);
            $select_query = "select * from players where team_id=" . $team_id . " and lower(player_name) like '%$searchKey%' order by player_name ASC";
        } elseif ((strlen($searchKey)) != 0 && (($sortBy) == 'name')) {
            $searchKey = strtolower($searchKey);
            $select_query = "select * from players where team_id=" . $team_id . " and lower(player_name) like '%$searchKey%' order by player_name ASC";
        } elseif ((strlen($searchKey)) != 0 && (($sortBy) == 'age')) {
            $searchKey = strtolower($searchKey);
            $select_query = "select * from players where team_id=" . $team_id . " and lower(player_name) like '%$searchKey%' order by player_age ASC";
        } else {
            $searchKey = strtolower($searchKey);
            $select_query = "select * from players where team_id=" . $team_id . " and lower(player_name) like '%$searchKey%' order by player_name ASC";
        }

        $run_select = mysqli_query($this->db, $select_query);

        $captain_team_members = [];
        if ($run_select) {
            while ($rs = mysqli_fetch_assoc($run_select)) {
                $captain_team_members[] = $rs;
            }
        }

        return $captain_team_members;
    }
    
    
    public function getPlayersByTeamId($team_id) {
        $query = "select * from players where team_id=" . $team_id;
        $runQuery = mysqli_query($this->db, $query);

        $players = [];
        if ($runQuery) {
            while ($rs = mysqli_fetch_assoc($runQuery)) {
                $players[] = $rs;
            }
        }
        return $players;
    }

}
