<?php 
    require("includes/config.php");
    apologize("Only Administrator can use this function!");

    date_default_timezone_set('UTC');
    $first_date = DateTime::createFromFormat(
                "Y-m-d", trim(FIRST_DAY) , new DateTimeZone('UTC'));
    //Insert every operating day into the list
    for ($i = 0; $i < trim(DAYS); ++$i) {
        $dates[] = date("Y-m-d", mktime(0,0,0,substr(trim(FIRST_DAY),5,2), 
                   substr(trim(FIRST_DAY), 8, 2) + $i, substr(trim(FIRST_DAY), 0, 4)));
    }

    //Add second operating period
    if (trim(FIRST_DAY_2) !== "" && trim(DAYS_2) !== "" && trim(DAYS_2) !== 0) {
        $first_date = DateTime::createFromFormat(
                    "Y-m-d", trim(FIRST_DAY_2) , new DateTimeZone('UTC'));
        for ($i = 0; $i < trim(DAYS_2); ++$i) {
            //Insert every operating day into the list
            $dates[] = date("Y-m-d", mktime(0,0,0,substr(trim(FIRST_DAY_2),5,2), 
                       substr(trim(FIRST_DAY_2), 8, 2) + $i, substr(trim(FIRST_DAY_2), 0, 4)));
        }
    }
    //dump($dates);
    //$dates = ["2014-5-21", "2014-5-22", "2014-5-23", "2014-5-24", "2014-5-25", "2014-5-26", "2014-5-27" ];

    //First insert all possible band and mode
    $result = query("SELECT * FROM band");

    $bands = array();
    $modes = array();
    foreach ($result as $r)
    {
        $bands[] = $r["id"];
    }

    $result = query("SELECT * FROM mode WHERE sub_mode=0");

    foreach ($result as $r)
    {
        $modes[] = $r["id"];
    }

    //Clear band mode table first
    $reslut = query("TRUNCATE band_mode");
    if ($result === false) {
        apologize("Clear table band_mode failed!");
    }

    //Insert all normal bands and modes
    foreach ($bands as $b)
        foreach($modes as $m)
            query("INSERT IGNORE INTO band_mode (band,mode) VALUES (?,?)",
            $b, $m);

    $result = query("SELECT * FROM mode WHERE mode=\"Phone\"");
    if ($result === false){
        apologize("Some thing wrong with database query for Phone");
    }
    $phone_id = $result[0]["id"];

    $result = query("SELECT * FROM mode WHERE mode=\"SSB\"");
    if ($result === false){
        apologize("Some thing wrong with database query for SSB");
    }
    $ssb_id = $result[0]["id"];
    
    $result = query("SELECT * FROM mode WHERE mode=\"AM\"");
    if ($result === false){
        apologize("Some thing wrong with database query AM");
    }
    $am_id = $result[0]["id"];

    //Get all bands that allow AM mode
    $result = query("SELECT * FROM band WHERE AM=1");
    if ($result === false){
        apologize("Some thing wrong with database query AM bands");
    } else {
        foreach ($result as $r) {
            $am_band = $r["id"];
            //Replace Phone to SSB
            $result2 = query("UPDATE band_mode SET mode=? WHERE band=? and mode=?", 
                $ssb_id, $am_band, $phone_id);
            if ($result2 === false){
                apologize("Some thing wrong with database update phone to ssb");
            }
            //Add AM mode
            $result2 = query("INSERT IGNORE INTO band_mode (band,mode) VALUES (?,?)", 
                $am_band, $am_id);
            if ($result === false){
                apologize("Some thing wrong with database insert 80m AM");
            }
        }
    }
    
    $result = query("SELECT * FROM mode WHERE mode=\"FM\"");
    if ($result === false){
        apologize("Some thing wrong with database query FM");
    }
    $fm_id = $result[0]["id"];

    //Get all bands that allow FM mode
    $result = query("SELECT * FROM band WHERE FM=1");
    if ($result === false){
        apologize("Some thing wrong with database query FM bands");
    } else {
        foreach ($result as $r) {
            $fm_band = $r["id"];
            //Replace Phone to SSB
            $result2 = query("UPDATE band_mode SET mode=? WHERE band=? and mode=?", 
                $ssb_id, $fm_band, $phone_id);
            if ($result2 === false){
                apologize("Some thing wrong with database update phone to ssb");
            }
            //Add FM mode
            $result2 = query("INSERT IGNORE INTO band_mode (band,mode) VALUES (?,?)", 
                $fm_band, $fm_id);
            if ($result === false){
                apologize("Some thing wrong with database insert 80m AM");
            }
        }
    }
    
    //Get all bands that don't allow phone mode like 30 meters
    $result = query("SELECT * FROM band WHERE no_phone=1");
    if ($result === false){
        apologize("Some thing wrong with database query no phone bands");
    } else {
        foreach ($result as $r) {
            $no_phone_band = $r["id"];
            //Delete phone mode
            $result2 = query("DELETE FROM band_mode WHERE band=? and mode=?", 
                $no_phone_band, $phone_id);
            if ($result2 === false){
                apologize("Some thing wrong with database delete phone mode");
            }
        }
    }
    
    //Now insert all the slots

    //Clear slot table first
    $reslut = query("TRUNCATE slot");
    if ($result === false) {
        apologize("Clear table slot failed!");
    }

    $result = query("SELECT * FROM band_mode");


    foreach ($dates as $d)
        for ($t = 0; $t <= 2200; $t += 200)
            foreach ($result as $r)
                query("INSERT IGNORE INTO slot (date,startTime,band,mode) VALUES (?,?,?,?)",
                   $d, $t, $r["band"], $r["mode"]);

?>
