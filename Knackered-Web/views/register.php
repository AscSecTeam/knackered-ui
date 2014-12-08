<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>

<!-- register form -->
<form method="post" action="register.php" id="registerform">

    <!-- the user name input field uses a HTML5 pattern check -->
    <label for="login_input_username">Username: </label><br /><br />
    <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required /><br />

<br /><br />

    <!-- email field replaced with teamid field -->
    <label for="login_team_id">Team ID: (Integer, 0 for whiteteam)</label><br />
    <input id="login_team_id" class="login_input" type="text" name="team_id" required />

<br /><br />

    <label for="login_input_password_new">Password: </label><br />
    <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

<br /><br />

    <label for="login_input_password_repeat">Repeat password: </label><br />
    <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />

<br /><br />

    <input type="submit"  name="register" value="Register" />
</form>

