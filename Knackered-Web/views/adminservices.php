<?php
//check for admin logon
if($login->isUserLoggedIn()){
    if($_SESSION['is_admin'] === 1){
        //yes, they're admin, give them the page
    //ifs ended in ending php block

    if(!empty($_POST['insert_teamid']) && !empty($_POST['address']) && !empty($_POST['type'])){
        addService($db);
    }
    if (!empty($_POST['delete_id'])){
        deleteService($db);
    }
?>

<h3>Select a team to continue</h3>
<form action="#" method="GET">
    <label for="select_teamid">Team ID: </label>
    <select name="select_teamid" required>
        <option value="">None</option>
        <?php
        $sql = 'SELECT (id) FROM teams';
        $query = $db->prepare($sql);
        $query->execute();
        $query->bind_result($id);
        while($query->fetch()){
            if($id !== 0){  // 0 is whiteteam. do not include.
                echo '<option value="' . $id . '">' . $id . '</option>';
            }
        }
    ?>
    </select>
    <input type="submit" value="Continue" />
</form>

<?php
        //if this runs the user is an admin
        //if statement ends at bottom of page
        if(!empty($_GET['select_teamid'])){
            displayTeamServices($db);
?>

<script>
function deleteService(id){
    $.post( "services.php", {'delete_id': id}, function( data ) {
        document.location = 'services.php?select_teamid=<?php echo $_GET['select_teamid'] ?>';
    });
}
</script>

<hr /><h3>Add a service</h3>

<form class="breakafterinput" action="#" method="POST">
    <input type="hidden" value="<?php echo $_GET['select_teamid'] ?>" name="insert_teamid" />
    <input type="hidden" value="<?php echo $_GET['select_teamid'] ?>" name="select_teamid" />

    <label for="address">Address: </label><br />
    <input type="text" name="address" required /><br /><br />

    <label for="type">Service type: </label><br />
    <input type="text" name="type" required /><br /><br />
    <input type="submit" value="Submit" />
</form>

<?php
    //close if statements started above, kick out non-admins
        }
    } else {
        //logged in as a team
        echo '<p>Only white team can access this page.</p>';
    }
} else {
    //not logged in
    echo '<p>Please login to view this page.</p>';
}

//content functions stored below, abstracted to make page more readable

function displayTeamServices($db){
    echo '<hr />';
    $id = $_GET['select_teamid'];
    echo '<h3>Team ' . $id . '\'s services</h3>';

    $sql = 'SELECT * FROM services WHERE teamId = ?';
    $query = $db->prepare($sql);
    $query->bind_param("i",$id);
    $query->execute();
    $query->bind_result($serviceid, $teamid, $address, $type);
    while($query->fetch()){
        echo '<p class="service">' . $type . ' at ' . $address . ' - <button onclick="deleteService(' . $serviceid . ')">Delete</button></p>';
    }
}

function addService($db){
    $sql = 'INSERT INTO services (teamId, address, type) VALUES (?,?,?)';
    $query = $db->prepare($sql);
    $query->bind_param("iss", $_POST['insert_teamid'], $_POST['address'], $_POST['type']);
    $query->execute();
}

function deleteService($db){
    $checksql = 'DELETE FROM checks WHERE serviceId = ?';
    $loginsql = 'DELETE FROM servicelogins WHERE serviceId = ?';
    $servicesql = 'DELETE FROM services WHERE id = ?';
    
    $checkquery = $db->prepare($checksql);
    $checkquery->bind_param("i", $_POST['delete_id']);
    $checkquery->execute();
    
    $loginquery = $db->prepare($loginsql);
    $loginquery->bind_param("i", $_POST['delete_id']);
    $loginquery->execute();

    $servicequery = $db->prepare($servicesql);
    $servicequery->bind_param("i", $_POST['delete_id']);
    $servicequery->execute();
}