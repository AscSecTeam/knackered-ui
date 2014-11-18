<div id="leftbox">
    <div id="statusbox" class="lightred">
        <h4>Team Management</h4>
        <hr>
        <?php if($login->isUserLoggedIn()){
            echo '<p><span class="glyphicon glyphicon-ok black"></span> Currently logged in as: ' . $_SESSION['user_name'] . '</p>';
            $sql = 'SELECT *
                FROM servicelogins INNER JOIN services ON servicelogins.serviceId = services.id
                WHERE services.teamId = ' . $_SESSION['team_id'] . ';';
            $result = $db->query($sql);
            $count = 0;
            while ($row = $result->fetch_array()) {
                echo strtoupper($row['type']) . " @ " . $row['address'] . "<br />";
                echo '<p class="indented"><a href="#" onclick="generateModifyPrompt(' . $row['serviceId'] . ');">Modify Login</a></p>';
                include('modifyform.php');
                $count++;
            }
            if($count == 0){
                echo "<p>Your team doesn't have any services that can be edited here.</p>";
            }
        } else {
            echo '<p><span class="glyphicon glyphicon-remove black"></span> Not logged in</p>
                  <p>Log in manage your team\'s services.</p>';
        }
        ?>
    </div>
    <?php if($login->isUserLoggedIn()){ ?>
        <div id="statusbox" class="lightgreen">
            <h4>Service Status</h4>
            <hr>
            <?php
                $sql = 'SELECT checks.result, services.address, services.type
                    FROM checks INNER JOIN services ON checks.serviceId = services.id
                    WHERE checks.round = (SELECT max(round) FROM checks)
                    AND services.teamId = ' . $_SESSION['team_id'] . ';';
                $result = $db->query($sql);
                $count = 0;
                while ($row = $result->fetch_array()) {
                    echo strtoupper($row['type']) . " @ " . $row['address'] . "<br />";
                    if($row['result'] == 1) {
                        echo '<p class="green indented">Passing</p>';
                    } else if($row['result'] == 0) {
                        echo '<p class="red indented">Failing</p>';
                    } else {
                        echo '<p class="red indented">Status Unknown</p>';
                    }
                    $count++;
                }
                if($count == 0){
                    echo "<p>Your team doesn't have any services being scored.</p>";
                }
            ?>
        </div>
    <?php } ?>
</div>