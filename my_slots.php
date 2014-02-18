<?php
    require("includes/config.php");

    $rows = query("SELECT slot.id as id, slot.date as date, slot.startTime as time, 
        band.band as band, mode.mode as mode 
        FROM slot,band,mode 
        WHERE slot.band=band.id AND slot.mode=mode.id AND op=?
        ORDER BY slot.date, slot.startTime, slot.band, slot.mode", $_SESSION["id"]);
    if ($rows === false) {
        apologize("Something wrong with finding slots for you!");
    } else {
        foreach ($rows as $r) {
            $slots[] = array("id"=>$r["id"] , "date"=>$r["date"], "time"=>$r["time"], 
                "band"=>$r["band"], "mode"=>$r["mode"]); 
        }
        if (!isset($slots)) {
            apologize("You haven't reserved any time slots yet!");
        } else {
            render("my_slots_template.php", array("title"=>"My Slots - " . $_SESSION["call"],
                "slots"=>$slots, "call"=>$_SESSION["call"], "url"=>$_SERVER["REQUEST_URI"]));
        }
    }
?>
