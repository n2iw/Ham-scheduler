<?php
    require("includes/config.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {    
        $result = query("UPDATE slot SET op=? WHERE date=? AND startTime=? AND band=? AND mode=?
            AND (op=0 OR op=?)", 
            $_POST["op"],$_POST["date"],$_POST["time"],$_POST["band"],$_POST["mode"],$_SESSION["id"]);
        if ($result === false)
            apologize("Failed to take/cancel slot! Please try again later.");
        else
            redirect("/rdxa");

    }else
    {
        redirect("/");
    }


?>
