<?php
    // configuration
    require("includes/config.php");

    checkTable(OP_TABLE);
    checkTable(SLOT_TABLE);

    //Only admins can use this page
    makeSureIsAdmin();

    if (isset($_GET["call"])) {
        $call = strtoupper(htmlspecialchars(trim($_GET["call"])));

        $getOP = sprintf("SELECT * FROM %s WHERE `%s`=?", OP_TABLE, OP_CALL);
        $result = query($getOP, $call);
        if ($result === false || count($result) === 0) {
            apologize("Can't find info for " . $call);
        } else { 
            $id = $result[0][OP_ID];
        }

        $getSlots = sprintf("SELECT %s.%s as id, ", SLOT_TABLE, SLOT_ID) .
            sprintf("%s.%s as date, ", SLOT_TABLE, SLOT_DATE) .
            sprintf("%s.%s as startTime, ", SLOT_TABLE, SLOT_START_TIME) .
            sprintf("%s.%s as endTime, ", SLOT_TABLE, SLOT_END_TIME) .
            sprintf("%s.%s as band, ", BAND_TABLE, BAND_NAME) .
            sprintf("%s.%s as mode ", MODE_TABLE, MODE_NAME) .
            sprintf("FROM %s, %s, %s ", SLOT_TABLE, BAND_TABLE, MODE_TABLE) .
            sprintf("WHERE %s.%s=%s.%s ", SLOT_TABLE, SLOT_BAND_ID, BAND_TABLE, BAND_ID) .
            sprintf("AND %s.%s=%s.%s ", SLOT_TABLE, SLOT_MODE_ID, MODE_TABLE, MODE_ID) .
            sprintf("AND %s=? ", SLOT_OP_ID) .
            sprintf("ORDER BY %s.%s, ", SLOT_TABLE, SLOT_DATE) .
            sprintf("%s.%s, ", SLOT_TABLE, SLOT_START_TIME) .
            sprintf("%s.%s, ", SLOT_TABLE, SLOT_BAND_ID) .
            sprintf("%s.%s", SLOT_TABLE, SLOT_MODE_ID);
        $rows = query($getSlots, $id);
        if ($rows === false) {
            apologize("Something wrong with finding slots for " . $call);
        } else {
            foreach ($rows as $r) {
                $slots[] = array("id"=>$r["id"] , "date"=>$r["date"], "time"=>array($r["startTime"],$r["endTime"]), 
                    "band"=>$r["band"], "mode"=>$r["mode"]); 
            }
            if (!isset($slots)) {
                apologize($call . " haven't reserve any time slots yet!");
            } else {
                render("my_slots_template.php", array("title"=>"User's Slots - " . 
                    $_SESSION["call"], "slots"=>$slots, "call"=>$call, 
                    "url"=>$_SERVER["REQUEST_URI"]));
            }
        }
    } else {
        //choose user
        render("choose_user_form.php", array("title" => "Choose user - " . $_SESSION["call"], 
            "url"=>$_SERVER["PHP_SELF"], "action"=>"Show slots"));
    }
?>
