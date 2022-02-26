<?php
//Onödig fil????
function jValidateLogin()
{
    if (key_exists('is_logged_in',$_SESSION))
    {
        if ($_SESSION['is_logged_in'])
        {
            return true;
        }
        return false;
    }
    return false;
}
function lLogOut()
{
    session_destroy();
}
?>