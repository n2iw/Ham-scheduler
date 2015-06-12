<?php
    require("includes/config.php");

    checkTable(SLOT_TABLE);

    makeSureLogin();

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {    
        $op_id = $_SESSION["id"];
        $privilege = $_SESSION["privilege"];
        //dump($_POST);
        if ($privilege > 1){ //if you are admin op you can cancel other's slot
            $updateSlot = sprintf("UPDATE %s SET %s=? ", SLOT_TABLE, SLOT_OP_ID) .
                sprintf("WHERE %s=? AND (%s=0 OR ?=0)", SLOT_ID, SLOT_OP_ID);
            $result = query($updateSlot, $_POST["op"],$_POST["id"],$_POST["op"]);
        } else { //normal op can only take free slot or cancel your own slot
            $updateSlot = sprintf("UPDATE %s SET %s=? ", SLOT_TABLE, SLOT_OP_ID) .
                sprintf("WHERE %s=? AND (%s=0 OR %s=?)", SLOT_ID, SLOT_OP_ID, SLOT_OP_ID);
            $result = query($updateSlot, $_POST["op"],$_POST["id"],$_SESSION["id"]);
        }
        if ($result === false) {
            apologize("Failed to take/cancel slot! Please try again later.");
        } else {
            redirect($_POST["url"]);
        }

    }else
    {
        redirect("index.php");
    }


?>
