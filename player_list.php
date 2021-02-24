<?php

require_once './includes/db.php';
require_once './classes/Roles.php';
require_once './classes/Team.php';
require_once './classes/Player.php';

$team_id = $_SESSION['user']['team_id'];
$role_id = $_SESSION['user']['role_id'];
$select_query = "select * from players where team_id=" . $team_id . " and role_id=" . $role_id;
$run_select = mysqli_query($connection, $select_query);
$player = [];
if ($run_select) {
    while ($rs = mysqli_fetch_assoc($run_select)) {
        $player = $rs['player_name'];
        print_r($player);
    }
}
        