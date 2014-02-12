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
        
        //get all the bands
        $result = query("SELECT * FROM band ORDER BY id");
        foreach ($result as $r) {
            $bands[] = array("id"=>$r["id"], "band"=>$r["band"], "modes"=>array());
        }

        foreach ($bands as &$b) { //each iteration is a band
            //get all modes for this band 
            $result = query("SELECT mode.mode as mode, mode.id as mode_id 
                FROM band_mode,mode 
                WHERE band_mode.band=? AND band_mode.mode=mode.id
                ORDER BY mode_id", $b["id"]);
            foreach ($result as $r) { //each iteration is one mode
                $result2 = query("SELECT slot.id as id, op.callsign as op, op.id as op_id,
                    startTime
                    FROM slot, op
                    WHERE slot.date=? AND slot.band=? AND slot.mode=? AND slot.op=op.id
                    ORDER BY startTime", $date, $b["id"], $r["mode_id"]);
                $slots = array();
                foreach ($result2 as $r2) {
                    $slots[] = array(
                        "id"=>$r2["id"],
                        "time"=>$r2["startTime"], //Maybe not necessory
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

        $result = query("SELECT DISTINCT startTime FROM `slot` ORDER BY startTime");
        foreach ($result as $r){
            $times[] = $r["startTime"];
        }

        $result = query("SELECT DISTINCT date FROM `slot` ORDER BY date");
        foreach ($result as $r){
            $dates[] = $r["date"];
        }
        //dump($bands);


        render("slot_template.php", array("title"=>"Time Slots - $call", "date" => $date,
            "times" => $times, "dates" => $dates, "bands"=>$bands ));
    }
    else
    {
        redirect("index.php?date=". FIRST_DAY);
    }
?>
