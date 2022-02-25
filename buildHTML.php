<?php
function LoginForm()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<label for='txtUsername' id ='lblUsername' class=''>Username: </label>";
    $text .= "<input type='text' id ='txtUsername' name='txtUsername' class='userInput' value='' size='10' />";
    $text .= "<label for='txtPassword' id ='lblPassword' class=''>Password: </label>";
    $text .= "<input type='password' id ='txtPassword' name='txtPassword' class='userInput' value='' size='10' />";
    $text .= "<input type='submit' id='login' class='loginButton' name='login' value='Login' />";
    $text .= "</form>";
    return $text;
}
function LogoutForm()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<input type='submit' id='logout' class='logoutButton' name='logout' value='Logout' />";
    $text .= "</form>";
    return $text;
}
function ProfileButtonForm()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<input type='submit' id='profile' class='profileButton' name='profile' value='".$_SESSION['username']." profile' />";
    $text .= "</form>";
    return $text;
}

?>