<?php
function LoginForm()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<label for='txtUsername' id ='lblUsername' class=''>Username: </label>";
    $text .= "<input type='text' id ='txtUsername' name='txtUsername' class='userInput' value='' size='30' /><br />";
    $text .= "<label for='txtPassword' id ='lblPassword' class=''>Password: </label>";
    $text .= "<input type='password' id ='txtPassword' name='txtPassword' class='userInput' value='' size='30' /><br />";
    $text .= "<input type='submit' id='login' class='loginButton' name='login' value='Login' />";
    $text .= "<br /></form>";
    return $text;
}
?>