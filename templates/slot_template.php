<div class="table">
<h1>2014 <?= CLUB . " " . CALL_SIGN?> Schedule</h1>

<div id="date_nav" class="navigator">
<table>
    <tr>
      <?php for ($i = 0; $i < count($dates); ++$i): ?>
          <?php $d = $dates[$i]; ?>
          <th class="<?= $d==$date? "today" : "not_today"?>">
            <a href="index.php?date=<?= $d ?>">
            <?php
                 $utc_date = DateTime::createFromFormat(
                             "Y-m-d", $d, new DateTimeZone('UTC'));
                 echo $utc_date->format("D n/j");
            ?>
          </a></th>
        <?php if ($i % 7 == 6 && count($dates) > 7) {
            echo "</tr><tr>";
        }?>
      <?php endfor ?>
</tr>
</table>
</div>

<table id="slots_table">
    <?php 
        if (isset($_SESSION["id"])) {
            $op_id = $_SESSION["id"];
            $privilege = $_SESSION["privilege"];
        } else {
            $op_id = 1;
            $privilege = 0;
        }
    ?>
        <thead><tr>
            <?php
                $utc_date = DateTime::createFromFormat(
                            "Y-m-d Gi", $date . "0000", new DateTimeZone('UTC'));
                $utc_day = $utc_date->format("D\nn/j");
            ?>
            <th class="date" rowspan="2"><?= $utc_day ?></th>
            <th class="time_name"><?= "UTC"?></th>
        <?php //Table Header line UTC time
            foreach ($times as $t): ?>
            <th class="time"><?php printf("%04d-%04d",$t,($t + 200 == 2400)? 0:($t + 200)); ?></th>
        <?php endforeach?>
        </tr>
        
        <tr>
            <th class="time_name"><?= "Local" ?></th>
        <?php //Table Header line local time
            foreach ($times as $t): ?>
                <?php
                    $utc_time = DateTime::createFromFormat(
                                "Y-m-d Gi", $date . sprintf("%04d",$t), new DateTimeZone('UTC'));
                    $local_time = $utc_time;
                    $local_time->setTimeZone(new DateTimeZone(TIMEZONE));
                    $local_time_str = $local_time->format("D n/j -\ng a");

                    $utc_time = DateTime::createFromFormat(
                                "Y-m-d Gi", $date . sprintf("%04d",$t+200), new DateTimeZone('UTC'));
                    $local_time = $utc_time;
                    $local_time->setTimeZone(new DateTimeZone(TIMEZONE));
                    $local_time_str .= $local_time->format(' - g a');
                ?>
            <th class="time"><?= $local_time_str  ?></th>
        <?php endforeach?>
        </tr></thead>

        <tbody>
        <?php //Data lines
            $row_count = 0;
            foreach ($bands as $b): ?>
                <tr class="slot_row_<?= $row_count % 2?>">
                <th class="band" rowspan="<?= count($b["modes"])?>"><?= htmlspecialchars($b["band"]) ?></th>
                <?php //dump($b["modes"]); ?>
                <?php for ($i = 0; $i < count($b["modes"]); ++$i): ?>
                    <?php $m = $b["modes"][$i]; 
                        if ($i !== 0): ?>
                            <tr class="slot_row_<?= $row_count % 2?>">
                        <?php endif?>
                    <th class="mode"><?= $m["mode"] ?></th>

                    <?php //Actual data slots
                    foreach ($m["slots"] as $s): ?>
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
                                    <input type="hidden" name="url" value="<?= $url?>">
                                    <input type="submit" value="Reserve">
                                </form> 
                            <?php elseif ($s["op_id"] == $op_id || $privilege > 1): ?>
                                <form action="reserve.php" method="POST">
                                    <input type="hidden" name="date" value="<?= $date?>">
                                    <input type="hidden" name="id" value="<?= $s["id"]?>">
                                    <input type="hidden" name="op" value="0">
                                    <input type="hidden" name="url" value="<?= $url?>">
                                    <input type="submit" value="Cancel">
                                </form> 
                            <?php endif?>
                        </td>
                    <?php endforeach?>
                <?php endfor?>
            <?php ++$row_count; ?>
            </tr>
            <?php endforeach?>
            </tbody>
</table>
</div>
  <script src='js/jquery-1.11.0.min.js'></script>
  <script src="js/scroll.js"></script>
