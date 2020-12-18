<h2 class="content-subhead">Please fill in this registration form.</h2>
<h3 style="color: red"><?php
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    } ?>
</h3>
<h3 style="color: green">
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    } ?>
</h3>
<form action="register/process.php" method="post" class="pure-form pure-form-aligned">
    <fieldset>
        <div class="pure-control-group">
            <label for="name">Username</label>
            <input type="text" id="login" name="login" placeholder="Username" required/>
            <span id="loginerror" class="pure-form-message-inline" style="color: red"></span>
        </div>
        <div class="pure-control-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required/>
            <span id="passworderror" class="pure-form-message-inline" style="color: red"></span>
        </div>
        <div class="pure-control-group">
            <label for="passwordconf">Repeat</label>
            <input type="password" id="passwordconf" name="passwordconf" placeholder="Password" required/>
            <span id="passwordconferror" class="pure-form-message-inline" style="color: red"></span>
        </div>
        <div class="pure-control-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Email Address" required/>
            <span id="emailerror" class="pure-form-message-inline" style="color: red"></span>
        </div>
        <div class="pure-controls">
            <input type="submit" id="register" name="register" value="Register" class="pure-button pure-button-primary" disabled>
        </div>
    </fieldset>
</form>
<a href="?do=login">Already have account? Please log in.</a>
<script src="register/view/validation.js"></script>