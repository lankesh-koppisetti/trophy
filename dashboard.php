<?php
require_once './includes/db.php';
require_once './classes//Team.php';
require_once './classes/Player.php';
require_once './classes//Roles.php';

//print_r( $_SESSION['user']);
if(is_null($_SESSION['user'])){
    header("location:index:php");
}

//===================== Get Team name by team id ========================
$team=new Team();
$teamInfo=$team->getTeamByTeamId($_SESSION['user']['team_id']);
$team_name = $teamInfo;


//========================Get Role name by role_id=======================
$roles=new Roles();
$roleInfo=$roles->getRoleByRoleId($_SESSION['user']['role_id']);

$role_name=$roleInfo;



/*============== Get next match details ============================*/
$select_schedule_time = "select s.schedule_id, t1.team_name as t1,t2.team_name as t2,s.schedule_date from schedule s 
join teams t1 on s.team_1=t1.team_id
join teams t2 on s.team_2=t2.team_id 
where (s.team_1=2 or s.team_2=2) and s.schedule_date>=now() order by s.schedule_date ASC limit 1;";

$runselect_schedule_time = mysqli_query($connection, $select_schedule_time);

$nextMatch=[];
if ($runselect_schedule_time) {
    while ($rs = mysqli_fetch_assoc($runselect_schedule_time)) {
        $nextMatch = $rs;
    }
}


?>
<!DOCTYPE html>

<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/main.css" />

    </head>
    <body>
        <div>

            <?php require_once './includes/navbar.php'; ?>

            <main>

                <div class="player_info"> 


                    <div class="player_profile">
                        <img src="images/banner.jpg" alt="banner" class="image" />

                        <div class="player_id">
                            <h1 class="player_name"> <?= ucfirst($_SESSION['user']['players_name']); ?></h1>
                            <p class="player_id_orgin"> <?= $role_name ?>, <?= $team_name ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="player_details">
                        <label class="profile_label">Player</label>
                        <p class="profile_value"> <?php echo $_SESSION['user']['players_name'];
            ?> </p>

                        <label class="profile_label ">Age</label>
                        <p class="profile_value"><?php echo $_SESSION['user']['players_age'];
            ?> Years</p>


                        <label class="profile_label ">Email</label>
                        <p class="profile_value"><?php echo $_SESSION['user']['players_email'];
            ?></p>


                        <label class="profile_label ">Team</label>
                        <p class="profile_value">
                            <?= $team_name ?>





                        <div>
                            <button class="button1" onclick="location = 'update.php'">
                                Edit  profile
                            </button>
                        </div>
                        <a class="button1 button2" href="logout.php">
                            Logout

                        </a>


                    </div>


                </div>

                <div class="match_details">


                    <div class="team_names">

                        <h2 class="dashboard_name"> Dash board</h2>
                        <div class="team_name_info">
                            Vaddigudem
                        </div>
                        <div class="team_name_info">
                            10Th Mile
                        </div>
                        <div class="team_name_info">
                            Mummidivaram
                        </div>
                        <div class="team_name_info">
                            Burugulanka
                        </div>

                    </div>
                    <div class="match_schedule ">
                        <h2 class="dashboard_name">
                            Tournament schedule

                        </h2>
                        <div class="match_dates">
                            <h2 class="teams_name">
                                vaddigudem <span style="color:#444;">v/s</span> 10th mile
                            </h2>
                            <p class="match_time">
                                27 feb,2021.
                            </p>
                        </div>
                        <div class="match_dates">
                            <h2 class="teams_name">
                                vaddigudem <span style="color:#444;">v/s</span> 10th mile
                            </h2>
                            <p class="match_time">
                                27 feb,2021.
                            </p>
                        </div>
                        <div class="match_dates">
                            <h2 class="teams_name">
                                vaddigudem <span style="color:#444;">v/s</span> 10th mile
                            </h2>
                            <p class="match_time">
                                27 feb,2021.
                            </p>
                        </div>
                        <div class="match_dates">
                            <h2 class="teams_name">
                                vaddigudem <span style="color:#444;">v/s</span> 10th mile
                            </h2>
                            <p class="match_time">
                                27 feb,2021.
                            </p>
                        </div>
                        <div class="match_dates">
                            <h2 class="teams_name">
                                vaddigudem <span style="color:#444;">v/s</span> 10th mile
                            </h2>
                            <p class="match_time">
                                27 feb,2021.
                            </p>
                        </div>

                    </div>
                    <div class="next_match">
                        <div style="text-align: center;">
                            <span class="next_match_header">

                                Your 
                            </span>
                            <p class="next_match_header">
                                Next Match
                        </div>
                        <div class="icon_box">
                            <div class="icon">
                                <h2>
                                   <?php echo substr($nextMatch['t1'], 0,4);
                                   ?>
                                </h2>
                            </div>
                            <div class="icon_vs">
                                <h2>
                                    V/S</h2>
                            </div>
                            <div class="icon">
                                <h2>
                                    <?php echo substr($nextMatch['t2'], 0,4);
                                   ?>
                                </h2>
                            </div>


                        </div>
                        on<span class="span_dates" name="schedule_time">
                            <?php
                           
                            echo date("d M,Y - H:i",strtotime($nextMatch['schedule_date']));
                            ?>
                        </span>

                    </div>


                </div>


                <div class="clearfix">

                </div>

            </main>
        </div>

    </body>
</html>
