<h2 class="content-subhead">Please log in.</h2>
<h3 style="color: red"><?php
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    } ?>
</h3>
<form action="login/process.php" method="post" class="pure-form pure-form-aligned">
    <fieldset>
        <div class="pure-control-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" />
            <span class="pure-form-message-inline">Login must be at least 8 characters.</span>
        </div>
        <div class="pure-control-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" />
            <span class="pure-form-message-inline">Password must be at least 6 character.</span>
        </div>
        <div class="pure-controls">
            <input type="submit" name="login" value="Login" class="pure-button pure-button-primary">
        </div>
    </fieldset>
</form>
<a href="../../?do=register">Don't have account? Please register now!</a>