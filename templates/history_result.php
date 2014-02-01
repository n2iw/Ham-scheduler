<div class="container" id="history">
<p>Hello <?=$name?>
</p>
<div class="table">
<?php
    if (count($history) > 0)
    {
        //dump($data);
        print('<table>');
        print('<tr><th>Datetime</th><th>Symbol</th><th>Type</th><th>Price</th>
            <th>Shares</th></tr>');
        foreach ( $history as $p): ?>
            <tr>
            <td><?= $p["datetime"]?></td> 
            <td><?= $p["symbol"]?></td> 
            <td><?= $p["type"]?></td> 
            <td><?= $p["price"]?></td> 
            <td><?= $p["shares"]?></td> 
            </tr>
        <? endforeach ?>
<?php    
        print('</table>');
    }
?>
</div>
</div>
<div>
    <a href="index.php">Back to home page</a>
</div>
