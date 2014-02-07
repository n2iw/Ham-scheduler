<div class="table">
<h1>2014 RDXA W1AW/2 Schedule</h1>

<div id="date_nav">
<table>
    <tr>
      <?php foreach ($dates as $d): ?>
          <th><a href="index.php?date=<?= $d ?>"><?= $d ?></th>
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
                $real_date = mktime(0,0,0,substr($date,5,2),substr($date,8,2),
                                        substr($date,0,4));
                $dofw = date("l", $real_date);
                $day = date("F j", $real_date);
            ?>
            <th><?= $dofw ?></th>
            <th><?= $day ?></th>
        <?php //Table Header line
            foreach ($times as $t): ?>
            <th><?php printf("%04d-%04d",$t,$t + 200); ?></th>
        <?php endforeach?>
        </tr>

        <?php //Data lines
            foreach ($lines as $l): ?>
            <tr>
                <th><?= $l["band"] ?></th>
                <th><?= $l["mode"] ?></th>

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
