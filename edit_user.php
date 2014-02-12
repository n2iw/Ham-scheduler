<?php
    // configuration
    require("includes/config.php");

    //Only admins can use this page
    if ($_SESSION["privilege"] < 2) {
        apologize("Only Administrators can use this page!");
    }

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

        $edit = "";
        if ($_POST["call"] != $_POST["old_call"])
        {
            $edit .= "`callsign`=\"" . strtoupper($_POST["call"]) ."\", ";
        }
        if ($_POST["name"] != $_POST["old_name"])
        {
            $edit .= "`name`=\"" . $_POST["name"] ."\", ";
        }
        if ($_POST["email"] != $_POST["old_email"])
        {
            $edit .= "`email`=\"" . $_POST["email"] ."\", ";
        }
        if ($_POST["phone"] != $_POST["old_phone"])
        {
            $edit .= "`phone`=\"" . $_POST["phone"] ."\", ";
        }
        if (!empty($_POST["new_password"]))
        {
            $edit .= "`password`=\"" . crypt($_POST["new_password"]) ."\", ";
        }
        if ($_POST["privilege"] != $_POST["old_privilege"])
        {
            $edit .= "`privilege`=\"" . $_POST["privilege"] ."\", ";
        }

        if ($edit === "")
        {
            apologize("Nothing changed!");
        }
        else
        {
            $edit = substr($edit, 0, -2); //delete trailing ", "
        }
        
        if (query("UPDATE op SET $edit WHERE id=?",
            $_POST["id"])  === false)
        {
            apologize("Sorry, edit user failed!");
        }
        else
        {
            succeed("User profile saved!");
        }
    }
    else
    {
        if (isset($_GET["call"])) {
            $result = query("SELECT * FROM op WHERE `callsign`=?", $_GET["call"]);
            if ($result === false || count($result) === 0) {
                apologize("Can't find profile for " . $_GET["call"]);
            } else {
                render("edit_user_form.php", array("title" => "Edit profile - " . $_SESSION["call"],
                    "id" => $result[0]["id"],
                    "call" => $_GET["call"],
                    "name" => $result[0]["name"],
                    "email" => $result[0]["email"],
                    "privilege" => $result[0]["privilege"],
                    "phone" => $result[0]["phone"]
                )); 
            }
        } else {
            //choose user
            render("choose_user_form.php", array("title" => "Choose user - " . $_SESSION["call"]));
        }
    }
?>
