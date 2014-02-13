<p class="lead text-error">
    Succeed!
</p>
<?php //dump("$link_message"); ?>
<p class="text-error">
    <?= htmlspecialchars($message) ?>
</p>
<a href="<?= htmlspecialchars($url)?>"><?= htmlspecialchars($link_message)?></a>
