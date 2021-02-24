<?php
require_once './classes//Team.php';
require_once './classes/Player.php';
require_once './classes/Roles.php';
require_once './classes/Schedule.php';


if (is_null($_SESSION['user'])) {
    header("location:index:php");
}
print_r($_SESSION['user']);
/* ============================== Coding for Search and Sort ============================ */
$searchKey = "";
$sortBy = "";

if (isset($_GET['search'])) {

    $searchKey = $_GET['search'];
    $sortBy = $_GET['sort'];
}

//===================== Get Team name by team id ========================
$team = new Team();
$teamInfo = $team->getTeamByTeamId($_SESSION['user']['team_id']);
$team_name = $teamInfo;

$teamNames = $team->getTeams();

//========================Get Role name by role_id=======================

$roles = new Roles();
$roleInfo = $roles->getRoleByRoleId($_SESSION['user']['role_id']);
$role_name = $roleInfo;


$roles = new Roles();
$roleInfo = $roles->getRoleByRoleId($_SESSION['user']['role_id']);
$role_name = $roleInfo;



$player = new Player();
$captain_team_members = $player->getCaptainTeamMembers($_SESSION['user']['team_id'], $searchKey, $sortBy);


/* ============== Get next match details ============================ */
$schedule = new Schedule();
$nextMatch = $schedule->getSchedule($_SESSION['user']['team_id']);
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/main.css" />
        <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">

            $(document).ready(function () {

//             ============================searchinh=======================
                $("#inputValue").on("keyup", function () {
                    var searchedKey = $(this).val();
                    $("#tableBody tr").filter(function () {

                        $(this).toggle($(this).text().toLowerCase().indexOf(searchedKey.toLowerCase()) > -1)
                    });
                });

                //=========================sorting=========================

                $("#selctBox").change(function () {
                    var val = $(this).val();

                    var allTrs = $("#tableBody tr");

                    if (val === 'age') {
                        allTrs.sort(function (a, b) {
                            var ageA = $(a).find("td:nth-child(4)").text();
                            var ageB = $(b).find("td:nth-child(4)").text();
                            return parseInt(ageA) - parseInt(ageB);
                        });
                    } else {
                        allTrs.sort(function (a, b) {
                            var nameA = $(a).find("td:nth-child(2)").text();
                            var nameB = $(b).find("td:nth-child(2)").text();

                            return nameA.toLowerCase().localeCompare(nameB.toLowerCase());

                        });

                    }

                    $.each(allTrs, function (i, tr) {
                        $("#tableBody").append(tr);
                    });

                });


                $(".getTeamPlayers").click(function () {

                    var teamId = $(this).find("input").val();

                    $.ajax({
                        url: "getTeamMembersById.php?team_id=" + teamId,
                        beforeSend: function () {
                            $("#teamlist").slideDown();
                            $(".loaderGetTeamPlayers").show();
                        },
                        dataType: 'json',
                        success: function (data) {

                            $("#wait").css("display", "none");

                            var html = '<table class="teamPlayers"><thead><tr><th>Sl.no</th><th>Player Name</th><th>Age</th><th>Email</th></tr></thead>\n\
                                        <tbody>';
                            $.each(data, function (key, val) {
                                html += '<tr><td>' + (key + 1) + '</td><td>' + val.player_name + '</td><td>' + val.player_age + '</td><td>' + val.player_email + '</td></tr>';
                            });


                            html += '</tbody></table>';


                            $(".loaderGetTeamPlayers").hide();
                            $("#teamlist .showList").html(html);
                        },
                        error: function () {
                            //Handle the errors.
                        }
                    });
                });
            });
        </script>



    </head>
    <body>

        <div>

            <?php require_once './includes/navbar.php'; ?>

            <main>

                <div class="player_info"> 


                    <div class="player_profile">
                        <div class="image_container">
                            <img src= "profilepics/<?php echo $_SESSION['user']['profile_pic'];
            ?>" alt="banner" class="image" />
                        </div>

                        <div class="player_id">
                            <h1 class="player_name"> <?= ucfirst($_SESSION['user']['player_name']); ?></h1>
                            <p class="player_id_orgin"> <?= $role_name ?>, <?= $team_name ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="player_details">
                        <label class="profile_label">Player</label>
                        <p class="profile_value"> <?php echo $_SESSION['user']['player_name'];
            ?> </p>

                        <label class="profile_label ">Age</label>
                        <p class="profile_value"><?php echo $_SESSION['user']['player_age'];
            ?> Years</p>


                        <label class="profile_label ">Email</label>
                        <p class="profile_value"><?php echo $_SESSION['user']['player_email'];
            ?></p>


                        <label class="profile_label ">Team</label>
                        <p class="profile_value">
                            <?= $team_name ?>

                        <div>
                            <button class="button1" onclick="location = 'player_update.php'">
                                Edit  profile
                            </button>
                        </div>
                        <div class="button2 button1">
                            <a class="anchor_button" href="logout.php">Logout </a>
                        </div>  
                    </div>


                </div>

                <div class="match_details">
                    <h2 class="dashboard_name"> Dash board</h2>

                    <div class="team_names">
                        <?php
                        foreach ($teamNames as $team) {
                            ?>
                            <div class="team_name_info getTeamPlayers">
                                <input type="hidden" value="<?= $team['team_id']; ?>" />
                                <?= $team['team_name']; ?>
                            </div>
                        <?php }
                        ?>
                    </div>


                    <div id="teamlist">
                        <div class="showList"></div>
                        <div class="loaderGetTeamPlayers"><img src="images/loader.gif" /></div>
                    </div>
                    <!--    ====================player_view=================-->

                    <?php
                    if ($_SESSION['user']['role_id'] == 2) {
                        ?>

                        <div class="captain_view">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                                <div>   
                                    <label > Select Player</label>
                                    <input type="text" name="search" id="inputValue">


                                    <label> sort</label>

                                    <select class="select_box " name="sort" id="selctBox">
                                        <option value="" selected="true">Select</option>
                                        <option value="age">Age</option>
                                        <option value="name">Name</option>
                                    </select>

                                </div>

                                <button type="submit">Submit</button>
                            </form>
                            <div>
                                <table border="0" class="player_list">
                                    <thead >
                                        <tr>
                                            <th> Sl.no</th>
                                            <th> Name</th>
                                            <th> Email</th>
                                            <th> Age</th>

                                        </tr>
                                    </thead>
                                    <tbody id="table_body">

                                        <?php
                                        $i = 1;
                                        echo '<tr>';
                                        foreach ($captain_team_members as $player_details) {
                                            echo '<td value="' . $player_details['player_id'] . '">' . $i . '</td>';

                                            echo '<td value="' . $player_details['player_id'] . '">' . $player_details['player_name'] . '</td>';
                                            echo '<td value="' . $player_details['player_id'] . '">' . $player_details['player_email'] . '</td>';
                                            echo '<td value="' . $player_details['player_id'] . '">' . $player_details['player_age'] . '</td>';

                                            $i++;
                                            echo '</tr>';
                                        }
                                        ?>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!--    ====================captain_view=================-->
                        <?php
                    } elseif ($_SESSION['user']['role_id'] == 1) {
                        ?>


                        <div class="captain_view">
    <!--                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">-->
                            <div>   
                                <label > Select Player</label>
                                <input type="text" name="search" id="inputValue">


                                <label> sort</label>

                                <select class="select_box " name="sort" id="selctBox">
                                    <option value="" selected="true">Select</option>
                                    <option value="age">Age</option>
                                    <option value="name">Name</option>
                                </select>

                            </div>

                            <!--                                <button type="submit">Submit</button>-->
                            <!--                            </form>-->
                            <div>
                                <table border="0" class="player_list">
                                    <thead>
                                        <tr>
                                            <th> Sl.no</th>
                                            <th> Name</th>
                                            <th> Email</th>
                                            <th> Age</th>
                                            <th> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">

                                        <?php
                                        $i = 1;

                                        echo '<tr>';
                                        foreach ($captain_team_members as $player_details) {

                                            $player_id = $player_details['player_id'];

                                            echo '<td>' . $i . '</td>';

                                            echo '<td>' . $player_details['player_name'] . '</td>';
                                            echo '<td>' . $player_details['player_email'] . '</td>';
                                            echo '<td>' . $player_details['player_age'] . '</td>';
                                            echo '<td>
                                            <a href="player_edit.php?player_id=' . $player_id . '" class="update_button" >Update</a>
                                                
                                            <a href="player_delete.php?player_id=' . $player_id . '" class="delete_button" onclick="confirm_delete(event)" >Delete</a>
                                                
                                        </td>';
                                            $i++;
                                            echo '</tr>';
                                        }
                                        ?>

                                    </tbody>
                                </table>



                            </div>
                        </div>
                    <?php }
                    ?>




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
                                    <?php echo substr($nextMatch['team_1_name'], 0, 4);
                                    ?>
                                </h2>
                            </div>
                            <div class="icon_vs">
                                <h2>
                                    V/S</h2>
                            </div>
                            <div class="icon">
                                <h2>
                                    <?php echo substr($nextMatch['team_2_name'], 0, 4);
                                    ?>
                                </h2>
                            </div>


                        </div>
                        on<span class="span_dates" name="schedule_time">
                            <?php
                            echo date("d M,Y - H:i", strtotime($nextMatch['schedule_date']));
                            ?>
                        </span>

                    </div>


                </div>


                <div class="clearfix">

                </div>

            </main>
            <script src="js/validations.js" type="text/javascript"></script>
        </div>

    </body>
</html>
