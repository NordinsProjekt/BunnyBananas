<?php $ctrlr = new UserController()?>

<h1>Signup</h1>
<form method="post">
    <label for="txtUsername" id ="lblUsername" class="">Username: </label>
    <input type="text" id ="txtUsername" name="txtUsername" class="userInput" value="" size="15" /><br />
    <label for="txtPassword" id ="lblPassword" class="">Password: </label>
    <input type="password" id ="txtPassword" name="txtPassword" class="userInput" value="" size="15" /><br />
    <label for="txtEmail" id ="lblEmail" class="">Email: </label>
    <input type="email" id ="txtEmail" name="txtEmail" class="userInput" value="" size="15" /><br />
    <input type="checkbox" id="reklam" name="reklam" value="ja" checked />
    <label for="reklam"> Få exklusiva erbjudanen via email? </label><br>
    <input type="submit" id="signup" class="signupButton" name="signup" value="Skapa Konto" /><br />
</form>