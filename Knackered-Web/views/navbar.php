<!-- NAVBAR -->
<div class="navbar navbar-default navbar-static-top" role="navigation" id="header" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" id="collapser">
                <span class="sr-only">Toggle navigation</span>
                <span class="glyphicon glyphicon-circle-arrow-down green"></span>
                <span class="whitetext">Navigation</span>
            </button>
            <span class="navbar-brand">Knackered <span class="glyphicon glyphicon-fire red"></span> Engine</span>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="score.php">Scoreboard</a></li>
                <?php if(!$login->isUserLoggedIn()){
                    echo '<li><a href="login.php">Log In</a></li>';
                } else {
                    if($_SESSION['is_admin']){
                        echo '<li><a href="teams.php">Teams</a></li>';
                        echo '<li><a href="services.php">Services</a></li>';
                        echo '<li><a href="logins.php">Logins</a></li>';
                        echo '<li><a href="register.php">Web</a></li>';
                    }
                    echo '<li><a href="index.php?logout=true">Log Out</a></li>';
                } ?>
            </ul>
        </div>
    </div>
</div>
<!-- END NAVBAR -->