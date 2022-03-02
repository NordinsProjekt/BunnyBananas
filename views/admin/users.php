<div class="AdminUserSection">
<details>
<summary>Skapa Användare</summary>
    <section class="UserSection" id="AddUser">
        <h2>Skapa Användare</h2>
           <form method="post">
            <!--<label for="txtUsername" id ="lblUsername" class="">Username: </label>-->
            <input type="text" id ="txtUsername" name="txtUsername" placeholder="Användarnamn" class="userInput" value="" size="30" /><br />
            <!--<label for="txtPassword" id ="lblPassword" class="">Password: </label>-->
            <input type="password" id ="txtPassword" name="txtPassword" placeholder="Lösenord" class="userInput" value="" size="30" /><br />
            <!--<label for="txtEmail" id ="lblEmail" class="">Email: </label>-->
            <input type="email" id ="txtEmail" name="txtEmail" placeholder="Email" class="userInput" value="" size="30" /><br />
            <!--<label for="selGroups" id="lblGroups" class="">Grupp: </label>-->
            <select name="selGroups" id="selGroups">
                <?php 
                $arr = $controller->ListAllUserGroups();
                foreach ($arr as $key => $value) {
                    echo "<option value='".$value['ID']."'>". $value["name"] . "</option>";
                }
                ?>
            </select><br />
            <input type="submit" id="add" class="addButton" name="addUser" value="Skapa" />
            <br />
        </form>
    </details>
    </section>
    <details>
        <summary>Hantera Grupper</summary>
        <section class="UserSection" id="CreateGroup">
            <h2>Skapa Grupp</h2>
                <form method="post">
                    <input type="text" id ="txtGroupname" name="txtGroupname" placeholder="Grupp namn" class="userInput" value="" size="10" /><br />
                    <input type="submit" id="addGroup" class="addGroupButton" name="addGroup" value="Skapa" />
                </form>
        </section>
        <br />
        <section class="UserSection" id="DeleteGroup">
            <h2>Radera Grupp</h2>
                <form method="post">
                    <select name="selGroups" id="selGroups">
                    <?php 
                    $arr = $controller->ListAllUserGroups();
                    foreach ($arr as $key => $value) {
                        echo "<option value='".$value['ID']."'>". $value["name"] . "</option>";
                    }
                    ?>
                    </select><br />
                    <input type="submit" id="deleteGroup" class="deleteGroupButton" name="deleteGroup" value="Radera" />
                </form>
        </section>
    </details>
</div>
<section class="ShowAll" id="ShowAllUsers">
    <?php 
        $arr = $controller->ListAllUsers();
        echo ShowAllUsers($arr);
    ?>
</section>