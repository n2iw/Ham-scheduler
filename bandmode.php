<?php 
    require("includes/config.php");
    $result = query("SELECT * FROM band");

    $bands = [];
    $modes = [];
    foreach ($result as $r)
    {
        $bands[] = $r["id"];
    }

    $result = query("SELECT * FROM mode");

    foreach ($result as $r)
    {
        $modes[] = $r["id"];
    }

    $dates = ["2014-5-21", "2014-5-22", "2014-5-23", "2014-5-24", "2014-5-25", "2014-5-26", "2014-5-27" ];



    foreach ($dates as $d)
        for ($t = 0; $t <= 2200; $t += 200)
            foreach ($bands as $b)
                foreach($modes as $m)
                    //query("INSERT IGNORE INTO slot (date,startTime,band,mode) VALUES (?,?,?,?)",
                    //   $d, $t, $b, $m);

?>
