<?php 
    require("includes/config.php");
    if ($_SESSION["privilege"] < 2) {
        apologize("Only Administrators can use this page!");
    }
    //apologize("Only Administrator can use this function!");

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
    
    //Now insert all the slots

    //Clear slot table first
    $result = query("TRUNCATE ". SLOT_TABLE);
    if ($result === false) {
        apologize("Clear table slot failed!");
    }

    $length = TIME_SLOT_LENGTH * 100; 
    if (24 % TIME_SLOT_LENGTH != 0) {
        $length = 200;
    }

    $result = query("SELECT * FROM " . BAND_MODE_TABLE);

    foreach ($dates as $d)
        for ($t = 0; $t <= 2400 - $length; $t += $length) {
            $endTime = $t + $length;
            $insertSlot = sprintf("INSERT IGNORE INTO %s ", SLOT_TABLE) . 
                sprintf("(%s,%s,%s,%s,%s) ", SLOT_DATE, SLOT_START_TIME, SLOT_BAND_ID, SLOT_MODE_ID, SLOT_END_TIME) .
                "VALUES (?,?,?,?,?)";
            foreach ($result as $r)
                query($insertSlot, $d, $t, $r[BM_BAND_ID], $r[BM_MODE_ID], $endTime);
        }

    succeed(array("message"=>"Time Slots generated!", "url"=>"index.php", 
        "link_message"=>"Home"));
    

?>
