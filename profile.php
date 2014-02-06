<?php
    // configuration
    require("includes/config.php");
    // if form was submitted
    $result = query("SELECT * FROM op WHERE id=?", $_SESSION["id"]);
    if ($result !== false)
    {
        $call = $result[0]["call"];
        $name = $result[0]["name"];
        $email = $result[0]["email"];
        $phone = $result[0]["phone"];
        $club = $result[0]["club"];
    }

    render("profile_template.php", ["title" => "Profile - $call", "call"=>$call,
    "name"=>$name, "email"=>$email, "phone"=>$phone, "club"=>$club]); 
?>
