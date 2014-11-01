<?php
    // configuration
    require("includes/config.php");
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        foreach ( $_POST as &$p){
            $p = htmlspecialchars(trim($p));
        }

        if (empty($_POST["password"]))
        {
            apologize("Sorry you have to enter old password to change your password!");
        }
        else if ($_POST["new_password"] != $_POST["confirmation"])
        {
            apologize("New passwords don't match!");
        }

        if (strlen($_POST["new_password"]) < 6 
            || $_POST["new_password"] == $_SESSION["call"])
        {
            apologize("Password must be at least 6 characters long, and 
               can't be the same as Call sign!"); 
        }

        $getPassword = sprintf( "SELECT %s FROM %s WHERE %s=?", OP_PASSWORD, OP_TABLE, OP_ID);
        $result = query($getPassword, $_SESSION["id"]);

        if (crypt($_POST["password"], $result[0][OP_PASSWORD]) != $result[0][OP_PASSWORD])
        {
            apologize("You entered a wrong password!");
        }
        
        $updateOP = sprintf("UPDATE %s SET %s=? WHERE %s=?", OP_TABLE, OP_PASSWORD, OP_ID);
        if (query($updateOP, crypt($_POST["new_password"]), $_SESSION["id"])  === false)
        {
            apologize("Sorry, change failed!");
        }
        else
        {
            succeed(array("message"=>"Password changed!", "url"=>"logout.php", 
                "link_message"=>"Logout"));
            //redirect("login.php");
        }
    }
    else
    {
        render("password_form.php", array("title" => "Change Password - " . $_SESSION["call"])); 
    }
?>
