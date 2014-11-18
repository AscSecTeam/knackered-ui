<!DOCTYPE html>

<html><head>
<title>Scoring Engine</title>

<!--Meta tags - charset, and mobile optimization-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<!--using CDNs for ease of setup - perhaps change these to locally stored for production-->

<!--Jquery 2.1.1-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Bootstrap 3.2 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Bootstrap 3.2 theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Bootstrap 3.2 JavaScript -->
<!-- For production, should probably self-compile this with only what is needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- Custom CSS -->
<link rel="stylesheet" href="css/main.css">

<!-- Custom JS -->
<script src="js/main.js"></script>

<!-- VOILA! We have a header, ladies and gentlemen-->

<?php //While we're at it, let's include the login functionality.

// checking for minimum PHP version
    if (version_compare(PHP_VERSION, '5.3.7', '<')) {
        exit("Minimum version not found");
    } else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
        // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
        // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
        require_once("libraries/password_compatibility_library.php");
    }

    // include the configs / constants for the database connection
    require_once("config/db.php");

    // load the login class
    require_once("classes/Login.php");

    // create a login object. when this object is created, it will do all login/logout stuff automatically
    $login = new Login();

    // sanitization functions
    require_once("libraries/sanitization.php");

    // create a database object
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($db->connect_errno) {
        echo '<p>Database connection is not functioning correctly. </p>';
    }

?>

</head>