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
    define("OP_TABLE", "op_new");
    define("BAND_TABLE", "band_new");
    define("MODE_TABLE", "mode_new");
    define("BAND_MODE_TABLE", "band_mode_new");
    define("SLOT_TABLE", "slot_new");

    //column names in band table
    define("BAND_ID", "band_id");
    define("BAND_NAME", "name");
    define("BAND_HAS_AM", "has_AM");
    define("BAND_HAS_FM", "has_FM");
    define("BAND_HAS_NO_PHONE", "has_no_phone");

    //column names in band_mode table
    define("BM_ID", "band_mode_id");
    define("BM_BAND_ID", "band_id");
    define("BM_MODE_ID", "mode_id");

    //column names in mode table
    define("MODE_ID", "mode_id");
    define("MODE_NAME", "name");
    define("MODE_IS_SUBMODE", "is_sub_mode");

    //column names in op table
    define("OP_ID", "op_id");
    define("OP_CALL", "call");
    define("OP_NAME", "op_name");
    define("OP_EMAIL", "op_email");
    define("OP_PHONE", "op_phone");
    define("OP_PASSWORD", "op_password");
    define("OP_PRIVILEGE", "op_privilege");

    //column names in slot table
    define("SLOT_ID", "slot_id");
    define("SLOT_DATE", "slot_date");
    define("SLOT_START_TIME", "slot_startTime");
    define("SLOT_BAND_ID", "band_id");
    define("SLOT_MODE_ID", "mode_id");
    define("SLOT_OP_ID", "op_id");
    define("SLOT_END_TIME", "slot_endTime");
?>
