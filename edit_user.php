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
        if (!empty($_POST["call"])) 
        {
            $edit .= "`call`=\"" . strtoupper($_POST["call"]) ."\", ";
        }
        if (!empty($_POST["name"]))
        {
            $edit .= "`name`=\"" . $_POST["name"] ."\", ";
        }
        if (!empty($_POST["email"]))
        {
            $edit .= "`email`=\"" . $_POST["email"] ."\", ";
        }
        if (!empty($_POST["phone"]))
        {
            $edit .= "`phone`=\"" . $_POST["phone"] ."\", ";
        }
        if (!empty($_POST["new_password"]))
        {
            $edit .= "`password`=\"" . crypt($_POST["new_password"]) ."\", ";
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
            $result = query("SELECT * FROM op WHERE `call`=?", $_GET["call"]);
            if ($result === false) {
                apologize("Can't find profile for " . $_GET["call"]);
            } else {
                render("edit_user_form.php", ["title" => "Edit profile - " . $_SESSION["call"],
                    "id" => $result[0]["id"],
                    "call" => $_GET["call"],
                    "name" => $result[0]["name"],
                    "email" => $result[0]["email"],
                    "phone" => $result[0]["phone"]
                ]); 
            }
        } else {
            //choose user
            render("choose_user_form.php", ["title" => "Choose user - " . $_SESSION["call"]]);
        }
    }
?>
