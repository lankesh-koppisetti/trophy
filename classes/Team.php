<?php
require_once __DIR__.'./Db.php';
class Team extends DB {

    public function Team() {
        parent::Db();
    }

    public function getTeamByTeamId($team_id) {
        $query = "select * from teams where team_id=" . $team_id;
        $runQuery = mysqli_query($this->db, $query);

        $team_name = '';
        if ($runQuery) {
            while ($rs = mysqli_fetch_assoc($runQuery)) {
                $team_name = $rs['team_name'];
            }
        }
        return $team_name;
    }

    public function getTeams() {
        $query = "select * from teams";
        $runQuery = mysqli_query($this->db, $query);
        $teams = [];
        if ($runQuery) {
            while ($rs = mysqli_fetch_assoc($runQuery)) {
                $teams[] = $rs;
            }
        }
        return $teams;
    }

}
