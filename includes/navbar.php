<header>
    <nav class="navbar">
        <a href="index.php">
        <img src="images/logo_no_bg.png" alt="trophy" />
        </a>
        <span class="login_menu">
            <?php
            echo (isset($_SESSION['user'])) ? $_SESSION['user']['player_name'] : 'Login';
            ?>
        </span>

        <div class = "clearfix"></div>
    </nav>
</header>        