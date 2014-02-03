<form action="edit_profile.php" method="post">
    <fieldset>
        <div class="control-group">
            <input autofocus name="call" placeholder="Call sign" type="text"/>
        </div>
        <div class="control-group">
            <input name="name" placeholder="Name" type="text"/>
        </div>
        <div class="control-group">
            <input name="email" placeholder="Email" type="text"/>
        </div>
        <div class="control-group">
            <input name="phone" placeholder="Phone" type="text"/>
        </div>
        <div class="control-group">
            <input name="password" placeholder="Old password" type="password"/>
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
    </fieldset>
</form>
