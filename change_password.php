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

        $result = query("SELECT password FROM op WHERE id=?", $_SESSION["id"]);

        if (crypt($_POST["password"], $result[0]["password"]) != $result[0]["password"])
        {
            apologize("You entered a wrong password!");
        }
        
        if (query("UPDATE op SET password=? WHERE id=?",
            crypt($_POST["new_password"]), $_SESSION["id"])  === false)
        {
            apologize("Sorry, change failed!");
        }
        else
        {
            succeed("Password changed!");
            //redirect("login.php");
        }
    }
    else
    {
        render("password_form.php", ["title" => "Change Password - " . $_SESSION["call"]]); 
    }
?>
