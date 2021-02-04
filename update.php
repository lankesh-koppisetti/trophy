<?php
require_once './includes/db.php';
require_once './classes/Roles.php';
require_once './classes/Team.php';

//If the form is submitted, proceed the registration.
//On succesfully registration, redirect the page to login.


$roles = new Roles();
//$role_name = $roles->getRoleByRoleId($_SESSION['user']['role_id']);


$team=new Team();
$teamsary[] = $teams;

//print_r($_SESSION['user']);

if (isset($_POST['player_name'])) {
    $player=new Player();
    $update=$player->updatePlayer($_SESSION['user']['player_id'], $_POST);
    
            
    if ($update) {
        //Assigning newly modified Player data into Session again, to keep the new data.
        $_SESSION['user']=$player->getPlayerById($_SESSION['player_id']);
        
        header("location:dashboard.php");
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
                        <form  name="registration_form" onsubmit="return validate_user_registration()"action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="input-block">
                                <label class=" label-element">Player name: </label>
                                <input name="player_name" type="text" value="<?php echo ucfirst($_SESSION['user']['players_name']); ?>" class=" input-box"/> 
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
                                <input name="player_email" type="text" value="<?php echo $_SESSION['user']['players_email']; ?> " class="input-box"/> 
                            </div>
                            <div class="input-block">
                                <label class="label-element">Player age</label>
                                <input name="player_age" type="text" value="<?php echo $_SESSION['user']['players_age']; ?>" class="input-box"/> 
                            </div>
                            <div class="input-block">
                                <label class="label-element"> Team</label>
                                <select name="team_id" class="select_box">
                                    <option value="">Select Team</option>

                                    <?php
                                    foreach ($teamsAry as $team) {
                                        echo '<option value="' . $team['team_id'] . '" selected>' . $team['team_name'] . '</option>';
                                    }
                                    ?>

                                </select> 
                            </div>
                            <div class="input-block">
                                <label class="label-element"> player role</label>
                                <select name="player_role" class="select_box">
                                    <option value="">Select Role</option>

                                    <?php
                                    foreach ($rolesAry as $role) {
                                        echo '<option value="' . $role['role_id'] . '" selected >' . $role['role_name'] . '</option>';
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