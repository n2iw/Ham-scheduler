<?php
    // configuration
    require("includes/config.php");

    //Normal user will can't use this page
    if ($_SESSION["privilege"] < 2) {
        apologize("Only Administrators can use this page!");
    }

    checkTable(DATABASE, OP_TABLE);
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        foreach ( $_POST as &$p){
            $p = htmlspecialchars(trim($p));
        }

        if (empty($_POST["call"]))
        {
            apologize("Sorry you have to enter your callsign");
        }
        else if (empty($_POST["password"]))
        {
            apologize("Sorry you have to enter a password");
        }
        else if (empty($_POST["name"]))
        {
            apologize("Sorry you have to enter your name");
        }
        else if (empty($_POST["email"]))
        {
            apologize("Sorry you have to enter an email");
        }
        else if (empty($_POST["phone"]))
        {
            apologize("Sorry you have to enter your phone number");
        }
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords don't match!");
        }
        else if (strlen($_POST["password"]) < 6 
            || $_POST["password"] == $_POST["call"])
        {
            apologize("Password must be at least 6 characters long, and 
               can't be the same as Call sign!"); 
        }


        $_POST["call"] = strtoupper($_POST["call"]);
        //dump($_POST);
        $insertOP = sprintf("INSERT INTO %s (`%s`, `%s`, `%s`, `%s`, `%s`, `%s`) VALUES(?,?,?,?,?,1)", 
            OP_TABLE, OP_CALL, OP_PASSWORD, OP_NAME, OP_EMAIL, OP_PHONE, OP_PRIVILEGE);
        if (query($insertOP, $_POST["call"], crypt($_POST["password"]), 
            $_POST["name"], $_POST["email"], $_POST["phone"]) === false)
        {
            apologize("Sorry, register failed {$_POST["call"]} might exists!");
        }
        else
        {
            succeed(array("message"=>"User added!", "url"=>$_SERVER["PHP_SELF"], 
                "link_message"=>"Add another user"));
            //redirect("add_user.php");
        }
    }
    else
    {
        render("add_user_form.php", array("title"=>"Add user - " . $_SESSION["call"]));
    }
?>
