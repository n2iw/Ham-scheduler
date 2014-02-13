<div class="table" id="my_slots">
<h1>Time Slots for <?= $_SESSION["call"]?></h1>
<table>
    <tr>
        <th>UTC Date</th>
        <th>UTC Time</th> 
        <th>Local Time</th>
        <th>Band</th>
        <th>Mode</th>
        <th>Action</th>
    </tr>
    <?php foreach ($slots as $s): ?>
    <tr>
        <?php
            $utc_time = DateTime::createFromFormat(
                        "Y-m-d Gi", $s["date"] . sprintf("%04d",$s["time"]), new DateTimeZone('UTC'));
            $utc_date_str = $utc_time->format("D n/j");
            $local_time = $utc_time;
            $local_time->setTimeZone(new DateTimeZone(TIMEZONE));
            $local_time_str = $local_time->format("D n/j -\ng a");

            $utc_time = DateTime::createFromFormat(
                "Y-m-d Gi", $s["date"] . sprintf("%04d",$s["time"]+200), 
                new DateTimeZone('UTC'));
            $local_time = $utc_time;
            $local_time->setTimeZone(new DateTimeZone(TIMEZONE));
            $local_time_str .= $local_time->format(' - g a');
        ?>
        <td><?= $utc_date_str?></td>
        <td class="time"><?php printf("%04d-%04d",$s["time"],
            ($s["time"] + 200 == 2400)? 0:($s["time"] + 200)); ?></td>
        <td class="time"><?= $local_time_str?></td>
        <td><?= $s["band"]?></td>
        <td><?= $s["mode"]?></td>
        <td><form action="reserve.php" method="POST">
                <input type="hidden" name="id" value="<?= $s["id"] ?>">
                <input type="hidden" name="op" value="0">
                <input type="submit" value="Cancel">
        </form></td>
    </tr>
    <?php endforeach ?>
</table>
</div>
