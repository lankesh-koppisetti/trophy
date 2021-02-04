<header>
    <nav class="navbar">
        <img src="images/logo_no_bg.png" alt="trophy"/>
        <span class="login_menu">
            <?php
            echo (isset($_SESSION['user'])) ? $_SESSION['user']['players_name'] : 'Login';
            ?>
        </span>

        <div class = "clearfix"></div>
    </nav>
</header>        