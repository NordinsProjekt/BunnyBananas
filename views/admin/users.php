<div class="AdminUserSection">
<details>
<summary>Add User</summary>
    <section class="UserSection" id="AddUser">
        <h2>Add User</h2>
           <form method="post">
            <label for="txtUsername" id ="lblUsername" class="">Username: </label>
            <input type="text" id ="txtUsername" name="txtUsername" class="userInput" value="" size="30" /><br />
            <label for="txtPassword" id ="lblPassword" class="">Password: </label>
            <input type="password" id ="txtPassword" name="txtPassword" class="userInput" value="" size="30" /><br />
            <label for="txtEmail" id ="lblEmail" class="">Email: </label>
            <input type="email" id ="txtEmail" name="txtEmail" class="userInput" value="" size="30" /><br />
            <label for="selGroups" id="lblGroups" class="">Grupp: </label>
            <select name="selGroups" id="selGroups">
                <?php 
                $arr = $controller->ListAllUserGroups();
                foreach ($arr as $key => $value) {
                    echo "<option value='".$value['ID']."'>". $value["name"] . "</option>";
                }
                ?>
            </select><br />
            <input type="submit" id="add" class="addButton" name="addUser" value="Add user" />
            <br />
        </form>
    </details>
    </section>

    <details>
        <summary>Add Group</summary>
        <section class="UserSection" id="CreateGroup">
            <h2>Add Group</h2>
                <form method="post">
                    <label for="txtGroupname" id ="lblGroupname" class="">Group name: </label>
                    <input type="text" id ="txtGroupname" name="txtGroupname" class="userInput" value="" size="10" /><br />
                    <input type="submit" id="addGroup" class="addGroupButton" name="addGroup" value="Add Group" />
                </form>
        </section>
    </details>
    <details>
        <summary>Delete Group</summary>
        <section class="UserSection" id="DeleteGroup">
            <h2>Delete Group</h2>
                <form method="post">
                    <label for="txtGroupname" id ="lblGroupname" class="">Group name: </label>
                    <select name="selGroups" id="selGroups">
                    <?php 
                    $arr = $controller->ListAllUserGroups();
                    foreach ($arr as $key => $value) {
                        echo "<option value='".$value['ID']."'>". $value["name"] . "</option>";
                    }
                    ?>
                    </select><br />
                    <input type="submit" id="deleteGroup" class="deleteGroupButton" name="deleteGroup" value="Delete Group" />
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