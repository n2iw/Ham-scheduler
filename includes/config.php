<?php

    /***********************************************************************
     * config.php
     *
     *
     * Configures pages.
     **********************************************************************/

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("constants.php");
    require("database.php");
    require("functions.php");
    //date_default_timezone_set('UTC');

    checkDatabase();

    // enable sessions
    session_start();

    // require authentication for most pages
    if (!preg_match("{(?:login|logout|register|index)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["id"]))
        {
            redirect("login.php");
        }
    }

?>
