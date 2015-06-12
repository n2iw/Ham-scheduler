<?php
    // configuration
    require("includes/config.php");
    checkTable(OP_TABLE);

    makeSureLogin();

    // if form was submitted
    $getOP = sprintf("SELECT * FROM %s WHERE %s=?", OP_TABLE, OP_ID);
    $result = query($getOP, $_SESSION["id"]);
    if ($result !== false)
    {
        $call = $result[0][OP_CALL];
        $name = $result[0][OP_NAME];
        $email = $result[0][OP_EMAIL];
        $phone = $result[0][OP_PHONE];
    }

    render("profile_template.php", array("title" => "Profile - $call", "call"=>$call,
    "name"=>$name, "email"=>$email, "phone"=>$phone)); 
?>
