<?php
    // configuration
    require("includes/config.php");

    //Only admins can use this page
    if ($_SESSION["privilege"] < 2) {
        apologize("Only Administrators can use this page!");
    }

    if (isset($_GET["call"])) {
        $call = strtoupper(htmlspecialchars(trim($_GET["call"])));

        $result = query("SELECT * FROM op WHERE `callsign`=?", $call);
        if ($result === false || count($result) === 0) {
            apologize("Can't find info for " . $call);
        } else { 
            $id = $result[0]["id"];
        }

        $rows = query("SELECT slot.id as id, slot.date as date, slot.startTime as time, 
            band.band as band, mode.mode as mode 
            FROM slot,band,mode 
            WHERE slot.band=band.id AND slot.mode=mode.id AND op=?
            ORDER BY slot.date, slot.startTime, slot.band, slot.mode", $id);
        if ($rows === false) {
            apologize("Something wrong with finding slots for " . $call);
        } else {
            foreach ($rows as $r) {
                $slots[] = array("id"=>$r["id"] , "date"=>$r["date"], "time"=>$r["time"], 
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
