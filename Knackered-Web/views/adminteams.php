<?php
//check for admin logon
if($login->isUserLoggedIn()){
    if($_SESSION['is_admin'] === 1){
        //yes, they're admin, give them the page

        $teams = array();

        //check for insert form submission
        if(!empty($_POST['teamid']) && is_numeric($_POST['teamid'])){
            $id = $_POST['teamid'];
            $sql = 'INSERT INTO teams (id) VALUES (?)';
            $insert = $db->prepare($sql);
            $insert->bind_param("i",$id);
            $insert->execute();

        //check for delete form submission
        } else if (!empty($_POST['deleteid']) && is_numeric($_POST['deleteid'])){
            $id = $_POST['deleteid'];

            //delete from servicelogins
            $loginsql = 'DELETE servicelogins FROM servicelogins INNER JOIN services ON services.id = servicelogins.serviceId WHERE teamId = ?';
            $login = $db->prepare($loginsql);
            $login->bind_param("i",$id);
            $login->execute();

            //delete from checks
            $checksql = 'DELETE FROM checks where serviceId = ?';
            $check = $db->prepare($checksql);
            $check->bind_param("i",$id);
            $check->execute();

            //delete from services
            $servicesql = 'DELETE FROM services WHERE teamId = ?';
            $service = $db->prepare($servicesql);
            $service->bind_param("i",$id);
            $service->execute();

            //delete from teamlogins
            $teamloginsql = 'DELETE FROM teamlogins WHERE teamId = ?';
            $teamlogin = $db->prepare($teamloginsql);
            $teamlogin->bind_param("i",$id);
            $teamlogin->execute();

            //delete from teams
            $teamsql = 'DELETE FROM teams WHERE id = ?';
            $team = $db->prepare($teamsql);
            $team->bind_param("i",$id);
            $team->execute();
        }


        echo '<h3>Currently registered teams</h3><ul>';

        $sql = 'SELECT (id) FROM teams';
        $query = $db->prepare($sql);
        $query->execute();
        $query->bind_result($id);
        while($query->fetch()){
            if($id !== 0){  // 0 is whiteteam. do not include.
                echo '<li>' . $id . '</li>';
                $teams[] = $id; //save these for the deletion list
            }
        }
//ifs ended in below block
?>
</ul>
<p>Head over to <a href="services.php">services management</a> to configure service information.</p>

<hr />

<h3>Register a new team</h3>
<form action="#" method="POST">
    <label for="teamid">Team ID: </label>
    <input type="number" name="teamid" required/>
    <input type="submit" value="Insert" />
</form>

<hr />

<h3>Delete a team</h3>
<p>Careful, this will delete their services!</p>
<form action="#" method="POST">
    <label for="deleteid">Team ID: </label>
    <select name="deleteid" required>
        <option value="999999">None</option>
        <?php
        foreach ($teams as $team){
            echo '<option value="' . $team . '">' . $team . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="Delete" />
    <br />
</form>


<?php
//ifs began in top block
    } else {
        //logged in as a team
        echo '<p>Only white team can access this page.</p>';
    }
} else {
    //not logged in
    echo '<p>Please login to view this page.</p>';
}
?>
