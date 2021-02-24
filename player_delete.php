<?php

require_once './includes/db.php';
require_once './classes/Player.php';



/* ==========get Player Details by Parameter we got======= */
$playerId = $_GET['player_id'];
$palyerObj = new Player();

if ($_SESSION['user']['role_id'] == 1) {
    $delete = $palyerObj->deletePlayer($playerId,);
} else {
    echo "you are not autherized to perform this action";
    exit;
}



if ($delete) {
    header("location:dashboard.php");
} else {
    echo "Player details are not deleted";
}

