<?php
require_once './classes/Db.php';
require_once './classes/Player.php';
//redirect a user if he/she already logged in. 
//Check the registered user session, if true then redirect the user to dashboard.


if (isset($_SESSION['user'])) {
    header('location:dashboard.php');
}




//Process the login check and redirect the user to dashboard if login passed.
//Also register the user data into the session to keep the logged in person details.
if (isset($_POST['user_name'])) {
    $username = $_POST['user_name'];
    $playerpassword = $_POST['password'];

    $player = new Player();
    $player_info = $player->doLogin($username, $playerpassword);



    if (key_exists('player_name', $player_info)) {
        $_SESSION['user'] = $player_info;
   
        

        header("location:dashboard.php");
    } else {
        echo "Sorry..!. we are unable to process you request. Please Check your username/password again.";
        //$logFile = fopen('log', 'a');
        //fwrite($logFile, 'There would be error the Query. Query details: ' . $select_query);
        //fclose($logFile);
    }
}
?>
<!DOCTYPE html>


<html>

    <head>
        <title>My first application in HTML</title>
        <link rel="stylesheet" href="css/main.css" />
        <link href="css/slick-theme.css" rel="stylesheet">
        <link href="css/slick.css" rel="stylesheet">


        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/slick.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#image_selector').slick({
                    autoplay: true,
                    arrows: false
                });
            });
        </script>

    </head>
    <body>
        <div class="home_page ">

            <?php require_once './includes/navbar.php'; ?>

            <main class="container">
                <div class="banner_component">
                    <div id="home_slider">
                        <div id="image_selector">
                            <div> <img src="images/crick1.jpg" alt="banner" /></div>
                            <div> <img src="images/crick2.jpg" alt="banner" /></div>
                            <div> <img src="images/crick3.jpg" alt="banner" /></div>
                        </div>
                    </div>
                </div>
                <div class="login_component">

                    <div class="login_text_box">

                        <h2 class="login_text">Login</h2>
                        <span class="login_text_desc">To access & maintain the Tournament.</span>
                    </div>

                    <div class="login_input_box">
                        <form name="myform" onsubmit="return validate_login()" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                            <div class="input-block">
                                <label class=" label-element">Username: </label>
                                <input name= 'user_name' type="text" class=" input-box"/> 
                            </div>
                            <div class="input-block">
                                <label class="label-element"> Password : </label>
                                <input name='password' type="password" class="input-box"/> 
                            </div>

                            <div id="loginValidationMessage"></div>

                            <button class="button"> 
                                login
                            </button>

                        </form>      

                        <a class="button button_reg" href="registration.php">
                            Register
                        </a>


                    </div>
                </div>
                <a href="dashboard.php"></a>

            </main>
            <div class="clearfix"></div>


        </div>
        <script src="js/validations.js" type="text/javascript"></script>
    </body>
</html>