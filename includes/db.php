<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "tournamenttracker");
if ($connection) {
    //Well
} else {
    echo "DB not connected";
    die();
}

