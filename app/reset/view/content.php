<h2 class="content-subhead">Here you can reset password to your account</h2>
<h3 style="color: red"><?php
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    } ?>
</h3>
<form action="register/process.php" method="post" class="pure-form pure-form-aligned">
    <fieldset>
        <div class="pure-control-group">
            <label for="name">Username</label>
            <input type="text" id="login" name="login" placeholder="Username" />
            <span class="pure-form-message-inline">Login must be at least 8 characters.</span>
        </div>
        <div class="pure-control-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Email Address" />
            <span class="pure-form-message-inline">Login and email address must be associated!</span>
        </div>
        <div class="pure-controls">
            <button class="pure-button">Check</button>
        </div>
        <div id="newPasswordSubform" style="visibility: hidden;">
            <div class="pure-control-group">
                <label for="password">New password</label>
                <input type="text" id="password" name="password" placeholder="New password" />
                <span class="pure-form-message-inline">Password must be at least 6 characters.</span>
            </div>
            <div class="pure-control-group">
                <label for="passwordconf">Repeat</label>
                <input type="text" id="passwordconf" name="passwordconf" placeholder="Repeat above" />
            </div>
            <div class="pure-control-group">
                <label for="resetcode">Code</label>
                <input type="text" id="code" name="code" placeholder="Code" />
            </div>
            <div class="pure-controls">
                <input type="submit" name="reset" value="Change" class="pure-button pure-button-primary">
            </div>
        </div>
    </fieldset>
</form>