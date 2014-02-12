<?php
    // configuration
    require("includes/config.php");
    // if form was submitted
    $result = query("SELECT * FROM op WHERE id=?", $_SESSION["id"]);
    if ($result !== false)
    {
        $call = $result[0]["callsign"];
        $name = $result[0]["name"];
        $email = $result[0]["email"];
        $phone = $result[0]["phone"];
    }

    render("profile_template.php", array("title" => "Profile - $call", "call"=>$call,
    "name"=>$name, "email"=>$email, "phone"=>$phone)); 
?>
