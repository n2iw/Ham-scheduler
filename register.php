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

        foreach ( $_POST as &$p){
            $p = htmlspecialchars(trim($p));
        }
        $_POST["call"] = strtoupper($_POST["call"]);
        //dump($_POST);
        if (query("INSERT INTO op (`call`, `password`, `name`, `email`, `phone`) 
            VALUES(?,?,?,?,?)", $_POST["call"], crypt($_POST["password"]), 
            $_POST["name"], $_POST["email"], $_POST["phone"]) === false)
        {
            apologize("Sorry, register failed {$_POST["call"]} might exists!");
        }
        else
        {
            $rows = query("SELECT * FROM op WHERE `call` = ?", $_POST["call"]);
            $_SESSION["id"] = $rows[0]["id"];
            $_SESSION["call"] = $rows[0]["call"];
            $_SESSION["privilege"] = $rows[0]["privilege"];
            redirect("/rdxa");
        }
    }
    else
    {
        render("register_form.php", ["title" => "Register"]); 
    }
?>
