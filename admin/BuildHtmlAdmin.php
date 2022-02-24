<?php
function AddGroupsForm()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<label for='txtGruppNamn' id ='lblGruppNamn' class=''>Gruppnamn: </label>";
    $text .="<input type='text' id ='txtUsername' name='txtUsername' class='userInput' value='' size='30' /><br />";
    $text .= "<input type='submit' id='addGroup' class='addButton' name='add' value='Add group' /><br /></form>";
    return $text;
}
?>
