<?php

    /***********************************************************************
     * database.php
     *
     * database table names
     * database column names
     *
     * Global constants.
     **********************************************************************/

    // table names
    define("OP_TABLE", "op");
    define("BAND_TABLE", "band");
    define("MODE_TABLE", "mode");
    define("BAND_MODE_TABLE", "band_mode");
    define("SLOT_TABLE", "slot");

    //column names in band table
    define("BAND_ID", "id");
    define("BAND_NAME", "band");
    define("BAND_HAS_AM", "AM");
    define("BAND_HAS_FM", "FM");
    define("BAND_HAS_NO_PHONE", "no_phone");

    //column names in band_mode table
    define("BM_ID", "id");
    define("BM_BAND_ID", "band");
    define("BM_MODE_ID", "mode");

    //column names in mode table
    define("MODE_ID", "id");
    define("MODE_NAME", "mode");
    define("MODE_IS_SUBMODE", "sub_mode");

    //column names in op table
    define("OP_ID", "id");
    define("OP_CALL", "callsign");
    define("OP_NAME", "name");
    define("OP_EMAIL", "email");
    define("OP_PHONE", "phone");
    define("OP_PASSWORD", "password");
    define("OP_PRIVILEGE", "privilege");

    //column names in slot table
    define("SLOT_ID", "id");
    define("SLOT_DATE", "date");
    define("SLOT_START_TIME", "startTime");
    define("SLOT_BAND_ID", "band");
    define("SLOT_MODE_ID", "mode");
    define("SLOT_OP_ID", "op");
    define("SLOT_END_TIME", "endTime");
?>
