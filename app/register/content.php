<h2 class="content-subhead">Please fill in this registration form.</h2>
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
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" />
            <span class="pure-form-message-inline">Password must be at least 6 character.</span>
        </div>
        <div class="pure-control-group">
            <label for="passwordconf">Repeat</label>
            <input type="password" id="passwordconf" name="passwordconf" placeholder="Password" />
        </div>
        <div class="pure-control-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Email Address" />
            <span class="pure-form-message-inline">You must enter not registered mail address.</span>
        </div>
        <div class="pure-controls">
            <input type="submit" name="register" value="Register" class="pure-button pure-button-primary">
        </div>
    </fieldset>
</form>
<a href="../index.php">Already have account? Please log in.</a>