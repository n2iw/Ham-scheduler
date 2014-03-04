<?php

    /***********************************************************************
     * constants.php
     *
     *
     * Global constants.
     **********************************************************************/

    // ***** your database's server
    define("SERVER", "localhost");

    // ***** your database's name
    define("DATABASE", "w1aw");

    // ***** your database's username
    define("USERNAME", "w1aw");

    // ***** your database's password
    define("PASSWORD", "w1aw");

    // ***** your club's name
    define("CLUB", "RDXA");
    
    // ***** your operating callsign
    define("CALL_SIGN", "W1AW/2");
    
    // ***** your first date of operating period, must be like "YYYY-MM-DD"
    define("FIRST_DAY", "2014-05-21");

    // ***** your length of operating period
    define("DAYS", "7");
    
    // your first date of second operating period, must be like "YYYY-MM-DD"
    // Leave it empty if your club only have one week of operating time
    define("FIRST_DAY_2", "");

    // your length of second operating period
    // Leave it empty or 0 if your club only have one week of operating time
    define("DAYS_2", "0");

    //Timezone can be found on following website
    //https://php.net/manual/en/timezones.america.php
    //define("TIMEZONE", "America/Los_Angeles");
    // ***** 
    define("TIMEZONE", "America/New_York");
?>
