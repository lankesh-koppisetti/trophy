<?php

require_once './classes/Roles.php';
require_once './classes/Team.php';
require_once './classes/Player.php';

//if session is unavailbale with user, redirect the page to index.php to reloagin.

if(!$_SESSION['user']){
    header("location:index.php");
}
/* ==========get Player Details by Parameter we got======= */

$playerId = $_SESSION['user']['player_id'];
$palyerObj = new Player();
$playerDetails = $palyerObj->getPlayerById($playerId);
//var_dump($playerDetails);


/* ============== Get Team details of given Player  ================ */
$team = new Team();
$teams = $team->getTeams($playerDetails['team_id']);
$teamsary = $teams;

/* ============== Get Role details of given Player  ================ */
$roles = new Roles();
$role = $roles->getRoles($playerDetails['role_id']);
$rolesary = $role;


//print_r($playerDetails);

if (isset($_POST['player_name'])) {
    
    $fileName = $_FILES['profile_pic']['name'];
    $ext = explode(".", $fileName)[1];
    $targetFileName = $_SESSION['user']['player_id'] . "." . $ext;

    move_uploaded_file($_FILES['profile_pic']['tmp_name'], "profilepics/" . $targetFileName);

    $_POST['profile_pic'] = $targetFileName;
    $update = $palyerObj->updatePlayer($playerId, $_POST);


    if ($update) {
        header("location:dashboard.php");
    } else {
        echo "Player details are not Updated";
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My first application in HTML</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        <div class="home-page ">
            <?php include_once './includes/navbar.php'; ?>

            <main class="container">
                <!--                <div class="banner_component">
                                    <img src="images/banner.jpg" alt="Banner"/>
                                </div>-->
                <div class="login_component">
                    <div class="login_text_box">
                        <h2 class="login_text">Update</h2>
                        <span class="login_text_desc">To be part of Tournament.</span>
                    </div>

                    <div class="login_input_box">
                        <form enctype="multipart/form-data" name="registration_form" onsubmit="return validate_user_registration()"action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
                            <div class="input-block" >
                                <div class="profile_pic_container">
                                    <img src="profilepics/<?php echo $playerDetails['profile_pic'];
            ?>" class="profile_pic"/>
                                </div>

                                <input name="profile_pic" type="file" alt="profile_pic">

                            </div>




                            <div class="input-block">
                                <label class=" label-element">Player name: </label>
                                <input name="player_name" type="text" value="<?php echo ucfirst($playerDetails['player_name']); ?>" class=" input-box"/> 
                            </div>
                            <div class="input-block">
                                <label class="label-element"> Password : </label>
                                <input name="player_password" type="text" class="input-box"/> 
                            </div>
                            <div class="input-block">
                                <label class="label-element"> Reset Password : </label>
                                <input name="player_password_confirm" type="text" class="input-box"/> 
                            </div>
                            <div id="registration_validate_message"></div>
                            <div class="input-block">
                                <label class="label-element"> Player email</label>
                                <input name="player_email" type="text" value="<?php echo $playerDetails['player_email']; ?> " class="input-box"/> 
                            </div>
                            <div class="input-block">
                                <label class="label-element">Player age</label>
                                <input name="player_age" type="text" value="<?php echo $playerDetails['player_age']; ?>" class="input-box"/> 
                            </div>
                            <div class="input-block">
                                <label class="label-element"> Team</label>
                                <select name="team_id" class="select_box">
                                    <!--<option value="">Select Team</option>-->

                                    <?php
                                    foreach ($teamsary as $team) {
                                        if($playerDetails['team_id']==$team['team_id']){
                                        echo '<option value="' . $team['team_id'] . '" selected="selected">' . $team['team_name'] . '</option>';
                                    }else{
                                        echo '<option value="' . $team['team_id'] . '" >' . $team['team_name'] . '</option>';
                                    }}
                                    
                                    ?>

                                </select> 
                            </div>
                            <div class="input-block">
                                <label class="label-element"> player role</label>
                                <select name="player_role" class="select_box">
                                    <!--                                    <option value="">Select Role</option>-->

                                    <?php
                                    foreach ($rolesary as $role) {
                                        if($playerDetails['role_id']==$role['role_id']){


                                        echo '<option value="' . $role['role_id'] . '" selected="selected" >' . $role['role_name'] . '</option>';
                                        } 
                                        else {
                                             echo '<option value="' . $role['role_id'] . '">' . $role['role_name'] . '</option>';
                                           
                                        }
                                    }
                                    ?>

                                </select>
                            </div>


                            <button class="button"> 
                                Update
                            </button>
                        </form>
                    </div>
                </div>
                <a href="dashboard.php"></a>
            </main>
            <div class="clearfix"></div>


        </div>
        <script src="js/validations.js" type="text/javascript"></script>
    </body>
</html>