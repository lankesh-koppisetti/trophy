<?php

require_once './classes/DbPdo.php';

$query = "select * from roles ";
//        . "where player_id=:player_id";

$stmt = DbPdo::connect()->prepare($query);
//$player_id = 1;
//echo "<pre>";
$stmt->bindParam("role_id", $player_id);
//print_r($stmt);
$stmt->execute();
//var_dump($stmt);
//print_r($stmt);
//$players = [];
while ($rs = $stmt->fetch()) {
    $players [] = $rs;
}
//$players = $stmt->fetchAll();
print_r($players);


$query = "select * from teams where team_id =:team_id";
$stmt1 = DbPdo::connect()->prepare($query);
$team_id = 1;
$stmt1->bindParam("team_id", $team_id);
$stmt1->execute();
if ($stmt1) {

    while ($rs = $stmt1->fetch()) {
        $teams = $rs["team_name"];
    }
}
print_r($teams);


$query = "select * from roles where role_id =:role_id";
$stmt = DbPdo::connect()->prepare($query);
$role_id = 1;
$stmt->bindParam("role_id", $role_id);
$stmt->execute();
if ($stmt) {

    while ($rs = $stmt->fetch()) {
        $team_name = $rs["role_name"];
    }
}
print_r($team_name);





$schedule_time = "select s.schedule_id ,s.team_1_name ,s.team_2_name,s.schedule_date from schedule_view s  
            where (s.team_1=:team_id or s.team_2=:team_id) and s.schedule_date>=now() order by s.schedule_date ASC limit 1;
";
$stmt = DbPdo::connect()->prepare($schedule_time);
$team_id =1;
echo"$team_id";
$stmt->bindParam("team_id", $schedule_id);
echo "$schedule_id";
//$runselect_schedule_time = mysqli_query($this->db, $select_schedule_time);

$stmt->execute();
$nextMatch = [];
if ($stmt) {
    while ($rs = $stmt->fetch()) {
        $nextMatch = $rs;
    }
}
print_r($nextMatch);
