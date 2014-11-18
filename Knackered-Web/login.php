<?php //While we're at it, let's include the login functionality.
include('views/header.php');
include('views/navbar.php');
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

// show the register view (with the registration form, and messages/errors)
if(!$login->isUserLoggedIn()){
    include("views/not_logged_in.php");
} else {
    header("Location: index.php");
}