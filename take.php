<?php
    require("includes/config.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {    
        //dump($_POST);
        $result = query("UPDATE slot SET op=? WHERE id=? AND (op=0 OR op=?)", 
            $_POST["op"],$_POST["id"],$_SESSION["id"]);
        if ($result === false)
            apologize("Failed to take/cancel slot! Please try again later.");
        else
            redirect("/rdxa");

    }else
    {
        redirect("/rdxa");
    }


?>
