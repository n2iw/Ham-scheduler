<div class="container" id="portfolio">
<p>Hello <?=$name?><br>
you cash balance is <?=$cash?> 
</p>
<div class="table">
<?php
    if (count($positions) > 0)
    {
        //dump($data);
        print('<table>');
        print('<tr><th>Symbol</th><th>Name</th><th>Price</th>
            <th>Shares</th><th>Action</th></tr>');
        foreach ( $positions as $p): ?>
            <tr>
            <td><?= $p["symbol"]?></td> 
            <td><?= $p["name"]?></td> 
            <td><?= $p["price"]?></td> 
            <td><?= $p["shares"]?></td> 
            <td><form action="sell.php" method="POST">
                <input type="hidden" name="symbol" value="<?=$p["symbol"]?>">
                <input type="hidden" name="price" value="<?=$p["price"]?>">
                <input type="hidden" name="shares" value="<?=$p["shares"]?>">
                <input type="submit" value="Sell">
                </form></td>
            </tr>
        <? endforeach ?>
<?php    
        print('</table>');
    }
?>
</div>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
