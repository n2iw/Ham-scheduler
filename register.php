<?php
    // configuration
    require("includes/config.php");
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["call"]))
        {
            apologize("Sorry you have to have a callsign");
        }
        else if (empty($_POST["password"]))
        {
            apologize("Sorry you have to have a password");
        }
        else if (empty($_POST["name"]))
        {
            apologize("Sorry you have to have a name");
        }
        else if (empty($_POST["email"]))
        {
            apologize("Sorry you have to have a email");
        }
        else if (empty($_POST["phone"]))
        {
            apologize("Sorry you have to have a phone");
        }
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("passwords don't match!");
        }
        else if (strlen($_POST["password"]) < 6 
            || $_POST["password"] == $_POST["call"])
        {
            apologize("Password must be at least 6 characters long, and 
               can't be the same as Call sign!"); 
        }

        foreach ( $_POST as &$p){
            $p = htmlspecialchars(trim($p));
        }
        $_POST["call"] = strtoupper($_POST["call"]);
        //dump($_POST);

        $insertOP = sprintf("INSERT INTO %s (`%s`, `%s`, `%s`, `%s`, `%s`, `%s`) VALUES(?,?,?,?,?,0)", 
            OP_TABLE, OP_CALL, OP_PASSWORD, OP_NAME, OP_EMAIL, OP_PHONE, OP_PRIVILEGE);
        if (query($insertOP, $_POST["call"], crypt($_POST["password"]), 
            $_POST["name"], $_POST["email"], $_POST["phone"]) === false)
        {
            apologize("Sorry, register failed {$_POST["call"]} might exists!");
        } 
        else
        {
            $getOP = sprintf("SELECT * FROM %s WHERE `%s` = ?", OP_TABLE, OP_CALL);
            $rows = query($getOP, $_POST["call"]);
            $_SESSION["id"] = $rows[0][OP_ID];
            $_SESSION["call"] = $rows[0][OP_CALL];
            $_SESSION["privilege"] = $rows[0][OP_PRIVILEGE];
            redirect("index.php");
        }
    }
    else
    {
        render("register_form.php", ["title" => "Register"]); 
    }
?>
