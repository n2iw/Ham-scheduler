<form action="edit_user.php" method="post">
    <fieldset>
        <div class="control-group">
            <input name="id" type="hidden" value="<?= $id?>"/>
        </div>
        <div class="control-group">
            <input name="call" placeholder="Call sign" type="text" value="<?= $call?>"/>
        </div>
        <div class="control-group">
            <input name="name" placeholder="Name" type="text" value="<?= $name?>"/>
        </div>
        <div class="control-group">
            <input autofocus name="email" placeholder="Email" type="text" value="<?= $email?>"/>
        </div>
        <div class="control-group">
            <input name="phone" placeholder="Phone" type="text" value="<?= $phone?>"/>
        </div>
        <div class="control-group">
            <select name="privilege">
            <option value="0" <?= $privilege==0? "selected=\"selected\"" : ""?>>Read only user</option>
                <option value="1" <?= $privilege==1? "selected=\"selected\"" : ""?>>Normal user</option>
                <option value="2" <?= $privilege==2? "selected=\"selected\"" : ""?>>Administrator</option>
            </select>
        </div>
        <div class="control-group">
            <input name="new_password" placeholder="New password" type="password"/>
        </div>
        <div class="control-group">
            <input name="confirmation" placeholder="New password again" type="password"/>
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Save</button>
        </div>
        <div class="control-group">
            <input name="old_call" type="hidden" value="<?= $call?>"/>
            <input name="old_name" type="hidden" value="<?= $name?>"/>
            <input name="old_email" type="hidden" value="<?= $email?>"/>
            <input name="old_phone" type="hidden" value="<?= $phone?>"/>
            <input name="old_privilege" type="hidden" value="<?= $privilege?>"/>
        </div>
    </fieldset>
</form>
