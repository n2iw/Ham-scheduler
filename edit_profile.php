<?php
    // configuration
    require("includes/config.php");
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["password"]))
        {
            apologize("Sorry you have to enter password to edit your profile!");
        }
        else if ($_POST["new_password"] != $_POST["confirmation"])
        {
            apologize("New passwords don't match!");
        }

        foreach ( $_POST as &$p){
            $p = htmlspecialchars(trim($p));
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
        if (!empty($_POST["club"]))
        {
            $edit .= "`club`=\"" . $_POST["club"] ."\", ";
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
            $result = query("SELECT password FROM op WHERE id=?", $_SESSION["id"]);
            if (crypt($_POST["password"], $result[0]["password"]) != $result[0]["password"])
            {
                apologize("Old password wrong!");
            }
            else
            {
                $edit = substr($edit, 0, -2); //delete trailing ", "
                echo $edit;
            }
        }
        
        if (query("UPDATE op SET $edit WHERE id=?",
            $_SESSION["id"])  === false)
        {
            apologize("Sorry, edit profile failed!");
        }
        else
        {
            redirect("/rdxa");
        }
    }
    else
    {
        $result = query("SELECT * FROM op WHERE id=?", $_SESSION["id"]);
        if ($result !== false)
            $call = $result[0]["call"];

        render("profile_form.php", ["title" => "Edit profile - $call"]); 
    }
?>
