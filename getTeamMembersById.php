<?php
require_once './classes/Player.php';

//i will get team_id
$team_id = $_GET['team_id'];

//get players list from team id
$palyerObj = new Player();
$teamPlayers = $palyerObj->getPlayersByTeamId($team_id);


$teamPlayersJson= json_encode($teamPlayers);
echo $teamPlayersJson;

?>


