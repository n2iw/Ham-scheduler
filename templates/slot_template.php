<div class="table">
<h1>2014 RDXA W1AW/2 Schedule</h1>
<table id="slots_table">
    <?php 
        $op_id = $_SESSION["id"];
        $result = query("SELECT * FROM op WHERE id=?", $op_id);
        if ($result !== false)
            $privilege = $result[0]["privilege"];
        else
            $privilege = 0;
    ?>
        <tr>
            <th>UTC Date</th>
            <th>UTC Time</th>
        <?php //Table Header line1
            foreach ($bands as $b): ?>
            <th colspan="<?= count($b["modes"])?>"><?= $b["name"] ?></th>
        <?php endforeach?>
        </tr>
        <?php //Table Header line1 ?>
        <tr>
            <th>Date</th>
            <th>Time</th>
        <?php foreach ($bands as $b): ?>
            <?php foreach ($b["modes"] as $m): ?>
                <th><?= $m ?></th>
            <?php endforeach ?>
        <?php endforeach?>
        </tr>

        <?php //Data lines
            foreach ($lines as $l): ?>
            <tr>
                <th><?= $l["date"] ?></th>
                <th><?php printf("%04d",$l["time"]); ?></th>

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
                            <form action="take.php" method="POST">
                                <input type="hidden" name="id" value="<?= $s["id"]?>">
                                <input type="hidden" name="op" value="<?= $op_id?>">
                                <input type="submit" value="Reserve">
                            </form> 
                        <?php elseif ($s["op_id"] == $op_id || $privilege > 1): ?>
                            <form action="take.php" method="POST">
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
