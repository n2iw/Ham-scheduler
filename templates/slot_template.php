<div class="table">
<table id="slots_table">
    <caption>
        <h1>RDXA W1AW/2 Schedule</h1>
    </caption>
        <tr>
            <th>UTC Date</th>
            <th>UTC Time</th>
        <?php
            foreach ($bands as $b): ?>
            <th colspan="<?= count($b["modes"])?>"><?= $b["name"] ?></th>
        <?php endforeach?>
        </tr>
        <tr>
            <th>Date</th>
            <th>Time</th>
        <?php foreach ($bands as $b): ?>
            <?php foreach ($b["modes"] as $m): ?>
                <th><?= $m ?></th>
            <?php endforeach ?>
        <?php endforeach?>
        </tr>

        <?php foreach ($lines as $l): ?>
            <tr>
                <th><?= $l["date"] ?></th>
                <th><?php printf("%04d",$l["time"]); ?></th>

            <?php foreach ($l["slots"] as $s): ?>
                    <td><?= $s["op"]?></td>
            <?php endforeach?>
            </tr>
        <?php endforeach?>
</table>
</div>
