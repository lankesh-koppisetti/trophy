<?php


function getPleayerById($player_id){
    $sql="select * from players where player_id=$player_id";
    return $sql;
}

function getTeamByTeamId($team_id){
    return $select_team_name = "select * from teams where team_id=" . $team_id;
    
}