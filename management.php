<?php require("includes/config.php");
    //Only admins can use this page
    makeSureIsAdmin();

    render("management_template.php", array("title"=>"Management - " . $_SESSION["call"]));
?>
