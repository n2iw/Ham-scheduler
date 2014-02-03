<div class="table">
<table id="slots_table">
    <caption>
        <h1>RDXA W1AW/2 Schedule</h1>
    </caption>
    <?php $op_id = $_SESSION["id"]; ?>
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
                    <td><?= $s["op"]?>
                        <?php if ($s["op_id"] == 0): ?>
                            <form action="take.php" method="POST">
                                <input type="hidden" name="date" value="<?= $l["date"]?>">
                                <input type="hidden" name="time" value="<?= $l["time"]?>">
                                <input type="hidden" name="band" value="<?= $s["band_id"]?>">
                                <input type="hidden" name="mode" value="<?= $s["mode_id"]?>">
                                <input type="hidden" name="op" value="<?= $op_id?>">
                                <input type="submit" value="Take">
                            </form> 
                        <?php elseif ($s["op_id"] == $op_id): ?>
                            <form action="take.php" method="POST">
                                <input type="hidden" name="date" value="<?= $l["date"]?>">
                                <input type="hidden" name="time" value="<?= $l["time"]?>">
                                <input type="hidden" name="band" value="<?= $s["band_id"]?>">
                                <input type="hidden" name="mode" value="<?= $s["mode_id"]?>">
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
