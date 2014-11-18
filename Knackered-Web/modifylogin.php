<?php

//session
require_once("classes/Login.php");
$login = new Login();

//db configs
require_once("config/db.php");
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//check for post data
if(isset($_POST['id']) && !empty($_POST['user']) && !empty($_POST['pass'])){

    //check for length
    if(strlen($_POST['user']) <= 15 || strlen($_POST['pass']) <= 15){

        //ensure ID is correct
        if(is_numeric($_POST['id']) && has_service_ownership($db, $_SESSION['team_id'], $_POST['id'])){
            echo "yo";
            //yay we can finally change the password
            change_password($db, $_POST['id'], $_POST['user'], $_POST['pass']);

//error messages
        } else {
            echo "{'error': 'service id does not belong to you'}";
        }
    } else {
        echo "{'error': 'username or password too long'}";
    }
} else {
    echo "{'error': 'Empty usernames and passwords are not allowed'}";
}

function has_service_ownership($db, $team_id, $service_id){
    //simple prepared statement query
    $sql = "SELECT serviceId FROM servicelogins INNER JOIN services on servicelogins.serviceId = services.id WHERE teamId = ?";
    $query = $db->prepare($sql);
    $query->bind_param("s",$team_id);
    $query->execute();
    $query->bind_result($service);

    //if service_id is in the list of services owned by team_id, return true
    while($query->fetch()){
        if($service == $service_id){
            return true;
        }
    }
    //if we get here, someone's modifying the forms or sending custom POSTs
    return false;
}

function change_password($db, $service_id, $user, $pass){
    //simple prepared statement query
    $sql = "UPDATE servicelogins SET username = ?,password = ? WHERE serviceId = ?";
    $query = $db->prepare($sql);
    $query->bind_param("sss", $user, $pass, $service_id);
    $query->execute();
}