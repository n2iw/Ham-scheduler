<div>
hello <?=$name?><br/>
you cash balance is <?=$cash?> <br/>
<?php
    if (count($positions) > 0)
    {
        //dump($data);
        print('<table border="1">');
        print('<tr><td>symbol</td><td>name</td><td>price</td>
            <td>shares</td></tr>');
        foreach ( $positions as $p): ?>
            <tr>
            <td><?= $p["symbol"]?></td> 
            <td><?= $p["name"]?></td> 
            <td><?= $p["price"]?></td> 
            <td><?= $p["shares"]?></td> 
            </tr>
        <? endforeach ?>
<?php    
        print('</table>');
    }
?>

</div>
<div>
<form action="sell.php" method="post">
    <fieldset>
        <div class="control-group">
            <input type="select">
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Sell</button>
        </div>
    </fieldset>
</form>
<?php
    if (count($positions) > 0)
    {
        foreach ( $positions as $p): ?>
            <tr>
            <td><?= $p["symbol"]?></td> 
            <td><?= $p["name"]?></td> 
            <td><?= $p["price"]?></td> 
            <td><?= $p["shares"]?></td> 
            </tr>
        <? endforeach ?>
<?php    
        print('</table>');
    }
?>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
