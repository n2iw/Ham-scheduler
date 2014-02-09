<?php require("includes/config.php");
    //Only admins can use this page
    if ($_SESSION["privilege"] >= 2) {
        render("management_template.php", ["title"=>"Management - " . $_SESSION["call"]]);
    } else {
        apologize("Only Administrators can use this page!");
    }
?>
