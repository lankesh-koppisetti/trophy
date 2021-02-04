<?php
require_once './includes/db.php';
require_once './classes/Roles.php';
require_once './classes/Team.php';

//If the form is submitted, proceed the registration.
//On succesfully registration, redirect the page to login.

$roles = new Roles();
$role_name = $roles->getRoleByRoleId($_SESSION['user']['role_id']);



$team = new Team();
$teams_name = $team->getTeamByTeamId($_SESSION['user']['team_id']);


$teamsary[] = $team;

/*==================== Insert player details =========================*/
if (isset($_POST['player_name'])) {
    $insert_details = new Player();
    $insert = $insert_details->insertPlayerDetails($_POST);

    if ($insert) {
        header("location:index.php");
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
                <div class="banner_component">
                    <img src="images/banner.jpg" alt="Banner"/>
                </div>
                <div class="login_component">
                    <div class="login_text_box">
                        <h2 class="login_text">Register</h2>
                        <span class="login_text_desc">To be part of Tournament.</span>
                    </div>
                    <div class="login_input_box">
                        <form  name="registration_form" onsubmit="return validate_user_registration()"action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="input-block">
                                <label class=" label-element">Player name: </label>
                                <input name="player_name" type="text" class=" input-box"/> 
                            </div>
                            <div class="input-block">
                                <label class="label-element"> Password : </label>
                                <input name="player_password" type="text" class="input-box"/> 
                            </div>
                            <div class="input-block">
                                <label class="label-element"> Conform Password : </label>
                                <input name="player_password_confirm" type="text" class="input-box"/> 
                            </div>
                            <div id="registration_validate_message"></div>
                            <div class="input-block">
                                <label class="label-element"> Player email</label>
                                <input name="player_email" type="text" class="input-box"/> 
                            </div>
                            <div class="input-block">
                                <label class="label-element">Player age</label>
                                <input name="player_age" type="text" class="input-box"/> 
                            </div>
                            <div class="input-block">
                                <label class="label-element"> Team</label>
                                <select name="team_id" class="select_box">
                                    <option value="">Select team</option>

                                    <?php
                                    foreach ($teamsary as $team) {
                                        echo '<option value="' . $team['team_id'] . '">' . $team['team_name'] . '</option>';
                                    }
                                    ?>

                                </select> 
                            </div>
                            <div class="input-block">
                                <label class="label-element"> player role</label>
                                <select name="player_role" class="select_box">
                                    <option value="">Select Role</option>

                                    <?php
                                    foreach ($rolesary as $role) {
                                        echo '<option value="' . $role['role_id'] . '">' . $role['role_name'] . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>


                            <button class="button"> 
                                Register
                            </button>
                        </form>
                    </div>
                </div>
                <a href="login.php"></a>
            </main>
            <div class="clearfix"></div>


        </div>
        <script src="js/validations.js" type="text/javascript"></script>
    </body>
</html>