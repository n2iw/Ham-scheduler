<?php
    // configuration
    require("includes/config.php");

    checkTable(OP_TABLE);

    //Only admins can use this page
    makeSureIsAdmin();

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        foreach ( $_POST as &$p){
            $p = htmlspecialchars(trim($p));
        }

        if ($_POST["new_password"] != $_POST["confirmation"])
        {
            apologize("New passwords don't match!");
        }
        else if ( (strlen($_POST["new_password"]) < 6 && strlen($_POST["new_password"]) != 0)
            || $_POST["new_password"] == $_POST["old_call"]
            || $_POST["new_password"] == $_POST["call"])
        {
            apologize("Password must be at least 6 characters long, and 
               can't be the same as Call sign!"); 
        }

        //dump(array($_POST["id"], $_SESSION["id"]));
        if ($_POST["id"] == $_SESSION["id"] && $_POST["privilege"] != 2)
        {
            apologize("You can't demote yourself!");
        }

        $edit = "";
        if ($_POST["call"] != $_POST["old_call"])
        {
            $edit .= "`" . OP_CALL . "`=\"" . strtoupper($_POST["call"]) ."\", ";
        }
        if ($_POST["name"] != $_POST["old_name"])
        {
            $edit .= "`" . OP_NAME . "`=\"" . $_POST["name"] ."\", ";
        }
        if ($_POST["email"] != $_POST["old_email"])
        {
            $edit .= "`" . OP_EMAIL . "`=\"" . $_POST["email"] ."\", ";
        }
        if ($_POST["phone"] != $_POST["old_phone"])
        {
            $edit .= "`" . OP_PHONE . "`=\"" . $_POST["phone"] ."\", ";
        }
        if (!empty($_POST["new_password"]))
        {
            $edit .= "`" .  OP_PASSWORD . "`=\"" . crypt($_POST["new_password"]) ."\", ";
        }
        if ($_POST["privilege"] != $_POST["old_privilege"])
        {
            $edit .= "`" . OP_PRIVILEGE . "`=\"" . $_POST["privilege"] ."\", ";
        }

        if ($edit === "")
        {
            apologize("Nothing changed!");
        }
        else
        {
            $edit = substr($edit, 0, -2); //delete trailing ", "
        }
        
        $updateOP = sprintf("UPDATE %s SET $edit WHERE %s=?", OP_TABLE, OP_ID);
        if (query($updateOP, $_POST["id"])  === false)
        {
            apologize("Sorry, edit user failed!");
        }
        else
        {
            succeed(array("message"=>"User profile saved!", "url"=>$_SERVER["PHP_SELF"], 
                "link_message"=>"Edit another user"));
        }
    }
    else
    {

        if (isset($_GET["call"])) {
            $call = strtoupper(htmlspecialchars(trim($_GET["call"])));
            $getOP = sprintf("SELECT * FROM %s WHERE `%s`=?", OP_TABLE, OP_CALL);
            $result = query($getOP, $call);
            if ($result === false || count($result) === 0) {
                apologize("Can't find profile for " . $call);
            } else {
                render("edit_user_form.php", array("title" => "Edit profile - " . $_SESSION["call"],
                    "id" => $result[0][OP_ID],
                    "call" => $call,
                    "name" => $result[0][OP_NAME],
                    "email" => $result[0][OP_EMAIL],
                    "privilege" => $result[0][OP_PRIVILEGE],
                    "phone" => $result[0][OP_PHONE]
                )); 
            }
        } else {
            //choose user
            render("choose_user_form.php", array("title" => "Choose user - " . $_SESSION["call"],
                "url"=>$_SERVER["PHP_SELF"], "action"=>"Edit"));
        }
    }
?>
