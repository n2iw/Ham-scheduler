<div class="table">
<h1>2014 RDXA W1AW/2 Schedule</h1>

<div id="date_nav">
<table>
    <tr>
      <?php foreach ($dates as $d): ?>
          <th class="<?= $d==$date? "" : "not_today"?>">
            <a href="index.php?date=<?= $d ?>">
            <?php
                 $utc_date = DateTime::createFromFormat(
                             "Y-m-d", $d, new DateTimeZone('UTC'));
                 echo $utc_date->format("D n/j");
            ?>
          </th>
      <?php endforeach ?>
</tr>
</table>
</div>

<table id="slots_table">
    <?php 
        $op_id = $_SESSION["id"];
        $privilege = $_SESSION["privilege"];
    ?>
        <tr>
            <?php
                $utc_date = DateTime::createFromFormat(
                            "Y-m-d Gi", $date . "0000", new DateTimeZone('UTC'));
                $utc_day = $utc_date->format("D n/j");
            ?>
            <th class="time"><?= "UTC\nTime"?></th>
            <th><?= $utc_day ?></th>
        <?php //Table Header line UTC time
            foreach ($times as $t): ?>
            <th><?php printf("%04d-%04d",$t,$t + 200); ?></th>
        <?php endforeach?>
        </tr>
        
        <tr>
            <th class="time"><?= "Local\nTime" ?></th>
            <?php
                $ny_date = $utc_date;
                $ny_date->setTimeZone(new DateTimeZone('America/New_York'));
                $ny_day = $ny_date->format('D n/j');
            ?>
            <th><?= $ny_day ?></th>
        <?php //Table Header line local time
            foreach ($times as $t): ?>
                <?php
                    $utc_time = DateTime::createFromFormat(
                                "Y-m-d Gi", $date . sprintf("%04d",$t), new DateTimeZone('UTC'));
                    $ny_time = $utc_time;
                    $ny_time->setTimeZone(new DateTimeZone('America/New_York'));
                    $ny_time_str = $ny_time->format("D n/j -\ng a");

                    $utc_time = DateTime::createFromFormat(
                                "Y-m-d Gi", $date . sprintf("%04d",$t+200), new DateTimeZone('UTC'));
                    $ny_time = $utc_time;
                    $ny_time->setTimeZone(new DateTimeZone('America/New_York'));
                    $ny_time_str .= $ny_time->format(' - g a');
                ?>
            <th class="time"><?= $ny_time_str  ?></th>
        <?php endforeach?>
        </tr>

        <?php //Data lines
            foreach ($lines as $l): ?>
            <tr>
                <th class="band"><?= $l["band"] ?></th>
                <th class="band"><?= $l["mode"] ?></th>

            <?php //Actual data slots
                foreach ($l["slots"] as $s): ?>
                    <?php if ($s["op_id"] == 0)
                              $className = "";
                          else if ($s["op_id"] == $op_id)
                              $className = "my_slot";
                          else 
                              $className = "others_slot";

                    ?>
                    <td class="<?= $className?>">
                        <?= $s["op"]?>
                        <?php if ($s["op_id"] == 0 && $privilege > 0): ?>
                            <form action="reserve.php" method="POST">
                                <input type="hidden" name="date" value="<?= $date?>">
                                <input type="hidden" name="id" value="<?= $s["id"]?>">
                                <input type="hidden" name="op" value="<?= $op_id?>">
                                <input type="submit" value="Reserve">
                            </form> 
                        <?php elseif ($s["op_id"] == $op_id || $privilege > 1): ?>
                            <form action="reserve.php" method="POST">
                                <input type="hidden" name="date" value="<?= $date?>">
                                <input type="hidden" name="id" value="<?= $s["id"]?>">
                                <input type="hidden" name="op" value="0">
                                <input type="submit" value="Cancel">
                            </form> 
                        <?php endif?>
                    </td>
            <?php endforeach?>
            </tr>
        <?php endforeach?>
</table>
</div>
