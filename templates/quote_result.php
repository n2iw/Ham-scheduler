<div class="table">
    <table>
    <tr>
        <td><?= $symbol ?> </td>
        <td><?= $name ?></td>
        <td><?= $price ?></td>
        <td>
            <form action="buy.php" method="POST">
                <input type="hidden" name="symbol" value="<?=$symbol?>">
                <input type="hidden" name="price" value="<?=$price?>">
                <input type="text" name="shares" value="1" required>
                <input type="submit" value="Buy">
            </form>
        </td>
    </tr>
    </table>
</div>
<div class="control-group">
    <a href="index.php">back to home</a>
</div>
