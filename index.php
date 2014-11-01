<?php
    // configuration
    require("includes/config.php");

    
    if (isset($_GET["date"]))
    {
        $date = $_GET["date"];
    }
    else
    {
        $now = new DateTime("Now", new DateTimeZone("UTC"));
        $today = $now->format("Y-m-d");

        //$today = "2014-05-28";

        $getDates = sprintf("SELECT DISTINCT %s as date ", SLOT_DATE) .
            sprintf("FROM `%s` ORDER BY date", SLOT_TABLE);
        $result = query($getDates);
        foreach ($result as $r){
            $cmp = strcmp($today, $r["date"]); 
            if ($cmp < 0) {
                $date = $r["date"];
                break;
            } else if ($cmp == 0) {
                $date = $today;
                break;
            } else {
                $date = $r["date"];
            }
        }

    }
    
    if (isset($_SESSION["id"])) {
        $op_id = $_SESSION["id"];
        $call = $_SESSION["call"];
    } else {
        $op_id = 1;
        $call = "Guest";
    }

    //dump($date);
    
    //get all the bands
    $getBands = sprintf("SELECT * FROM %s ORDER BY %s", BAND_TABLE, BAND_ID);
    $result = query($getBands);
    foreach ($result as $r) {
        $bands[] = array("id"=>$r[BAND_ID], "band"=>$r[BAND_NAME], "modes"=>array());
    }

    foreach ($bands as &$b) { //each iteration is a band
        //get all modes for this band 
        $getModes = sprintf("SELECT %s.%s as mode, ", MODE_TABLE, MODE_NAME) .
            sprintf("%s.%s as mode_id ", MODE_TABLE, MODE_ID) .
            sprintf("FROM %s,%s ", BAND_MODE_TABLE, MODE_TABLE) .
            sprintf("WHERE %s.%s=? ", BAND_MODE_TABLE, BM_BAND_ID) .
            sprintf("AND %s.%s=%s.%s ", BAND_MODE_TABLE, BM_MODE_ID, MODE_TABLE, MODE_ID) .
            "ORDER BY mode_id";
        $result = query($getModes, $b["id"]);
        foreach ($result as $r) { //each iteration is one mode
            $getSlots = sprintf("SELECT %s.%s as id, ", SLOT_TABLE, SLOT_ID) .
                sprintf("%s.%s as op, ", OP_TABLE, OP_CALL) .
                sprintf("%s.%s as op_id, ", OP_TABLE, OP_ID) .
                sprintf("%s as startTime, ", SLOT_START_TIME) .
                sprintf("%s as endTime ", SLOT_END_TIME) .
                sprintf("FROM %s, %s ", SLOT_TABLE, OP_TABLE) .
                sprintf("WHERE %s.%s=? ", SLOT_TABLE, SLOT_DATE) .
                sprintf("AND %s.%s=? ", SLOT_TABLE, SLOT_BAND_ID) .
                sprintf("AND %s.%s=? ", SLOT_TABLE, SLOT_MODE_ID) .
                sprintf("AND %s.%s=%s.%s ", SLOT_TABLE, SLOT_OP_ID, OP_TABLE, OP_ID) .
                sprintf("ORDER BY startTime" );
            $result2 = query($getSlots, $date, $b["id"], $r["mode_id"]);
            $slots = array();
            foreach ($result2 as $r2) {
                $slots[] = array(
                    "id"=>$r2["id"],
                    "time"=>$r2["startTime"], //Maybe not necessory
                    "endTime"=>$r2["endTime"], //Maybe not necessory
                    "op_id"=>$r2["op_id"],
                    "op"=>$r2["op"]
                );
            }
            $b["modes"][] = array(
                "mode"=>$r["mode"],
                "slots"=>$slots
            );
        }
    }

    $getTimes = sprintf("SELECT DISTINCT %s as startTime, ", SLOT_START_TIME) .
        sprintf("%s as endTime ", SLOT_END_TIME) .
        sprintf("FROM `%s` ORDER BY startTime", SLOT_TABLE);

    $result = query($getTimes);
    foreach ($result as $r){
        $times[] = array($r["startTime"], $r["endTime"]);
    }


    $getDates = sprintf("SELECT DISTINCT %s as date ", SLOT_DATE) .
        sprintf("FROM `%s` ORDER BY date", SLOT_TABLE);
    $result = query($getDates);
    foreach ($result as $r){
        $dates[] = $r["date"];
    }
    //dump($bands);


    //dump($_SERVER["REQUEST_URI"]);
    render("slot_template.php", array("title"=>"Time Slots - $call", "date" => $date,
        "times" => $times, "dates" => $dates, "bands"=>$bands, "url"=>$_SERVER["REQUEST_URI"]));
?>
