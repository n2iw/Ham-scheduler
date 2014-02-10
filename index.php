<?php
    // configuration
    require("includes/config.php");
    if (isset($_GET["date"]))
    {
        if (isset($_SESSION["id"])) {
            $op_id = $_SESSION["id"];
            $call = $_SESSION["call"];
        } else {
            $op_id = 1;
            $call = "Guest";
        }

        $date = $_GET["date"];
        //dump($date);
        
        //get all the bands and modes 
        $result = query("SELECT band.band as band, band.id as band_id,
            mode.mode as mode, mode.id as mode_id 
            FROM band_mode,band,mode 
            WHERE band_mode.band=band.id AND band_mode.mode=mode.id
            ORDER BY band_id, mode_id");
        foreach ($result as $r) { //each iteration is one band mode
            $result2 = query("SELECT slot.id as id, op.callsign as op, op.id as op_id,
                startTime
                FROM slot, op
                WHERE slot.date=? AND slot.band=? AND slot.mode=? AND slot.op=op.id
                ORDER BY startTime", $date, $r["band_id"], $r["mode_id"]);
            $slots = [];
            foreach ($result2 as $r2) {
                $slots[] = [
                    "id"=>$r2["id"],
                    "time"=>$r2["startTime"], //Maybe not necessory
                    "op_id"=>$r2["op_id"],
                    "op"=>$r2["op"]
                ];
            }
            
            $lines[] = [
                "band"=>$r["band"],
                "mode"=>$r["mode"],
                "slots"=>$slots
            ];
        }

        $result = query("SELECT DISTINCT startTime FROM `slot` ORDER BY startTime");
        foreach ($result as $r){
            $times[] = $r["startTime"];
        }

        $result = query("SELECT DISTINCT date FROM `slot` ORDER BY date");
        foreach ($result as $r){
            $dates[] = $r["date"];
        }
        //dump($lines);


        render("slot_template.php", ["title"=>"Time Slots - $call", "date" => $date,
            "times" => $times, "dates" => $dates, "lines"=>$lines ]);
    }
    else
    {
        redirect("index.php?date=2014-05-21");
    }
?>
