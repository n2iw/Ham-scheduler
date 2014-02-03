<?php
    // configuration
    require("includes/config.php");
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO 
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
        if (query("INSERT INTO op (`call`, `password`, `name`, `email`, `phone`) 
            VALUES(?,?,?,?,?)", strtoupper($_POST["call"]), crypt($_POST["password"]), 
            $_POST["name"], $_POST["email"], $_POST["phone"]) === false)
        {
            apologize("Sorry, register failed {$_POST["call"]} might exists!");
        }
        else
        {
            $rows = query("SELECT LAST_INSERT_ID() AS id"); 
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;
            redirect("/");
        }
    }
    else
    {
        render("register_form.php", ["title" => "Register"]); 
    }
?>
