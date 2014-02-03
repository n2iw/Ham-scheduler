<?php
    // configuration
    require("includes/config.php");
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO 
    }
    else
    {
        $op_id = $_SESSION["id"];
        $result = query("SELECT * FROM op WHERE id=?", $op_id);
        if ($result !== false)
            $call = $result[0]["call"];
        //get all the bands and modes for table header
        $result = query("SELECT * FROM band ORDER BY id");
        foreach ($result as $r)
        {
            $result2 = query("SELECT mode.mode as mode FROM band_mode,mode
                WHERE band_mode.mode=mode.id AND band_mode.band=? ORDER BY mode.id", $r["id"]);
            $modes = [];
            foreach ($result2 as $r2)
            {
                $modes[] = $r2["mode"];
            }
            $bands[] = ["id"=>$r["id"], "name"=>$r["band"], "modes"=>$modes];
        }

        //get dates and times
        $result = query("SELECT DISTINCT date,startTime FROM `slot`");
        foreach ($result as $r)
        {
            $result2 = query("SELECT band.id as band_id, band.band, 
                mode.id as mode_id, mode.mode, op.call as op, op.id as op_id
                FROM slot, band, mode, op
                WHERE slot.band=band.id and slot.mode=mode.id and slot.op=op.id
                and slot.date=? and slot.startTime=?
                ORDER BY band.id,mode.id", $r["date"], $r["startTime"]);
            $slots = [];
            foreach ($result2 as $r2)
            {
                $slots[] = [
                    "band_id"=>$r2["band_id"], 
                    "band"=>$r2["band"],
                    "mode_id"=>$r2["mode_id"],
                    "mode"=>$r2["mode"],
                    "op_id"=>$r2["op_id"],
                    "op"=>$r2["op"]
                ];
            }
            
            $lines[] = [
                "date"=>$r["date"],
                "time"=>$r["startTime"],
                "slots"=>$slots
            ];
        }
        render("slot_template.php", ["title"=>"Time Slots - $call", "bands" => $bands, "lines"=>$lines ]);
    }
?>
