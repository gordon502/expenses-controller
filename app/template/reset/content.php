<h2 class="content-subhead">Here you can reset password to your account</h2>
<h3 id="error" style="color: red"></h3>
<h3 style="color: maroon"><?php
    if (isset($_SESSION['error']))
        echo $_SESSION['error'];
    unset($_SESSION['error'])?></h3>
<form action="actions/reset/change_password.php" method="post" class="pure-form pure-form-aligned">
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
            <button class="pure-button" type="button" id="checkButton" onclick="checkUser()">Check
            </button>
            <img src="https://media3.giphy.com/media/3o7TKtnuHOHHUjR38Y/giphy.gif" id="spin" style="visibility: hidden; height: 1em; width: 1em;">
        </div><br>
        <div id="newPasswordSubform" style="visibility: hidden;">
            <div class="pure-control-group">
                <label for="password">New password</label>
                <input type="password" id="password" name="password" placeholder="New password" />
                <span class="pure-form-message-inline" id="passworderror" style="color: red; visibility: hidden;">Password must have between 6 and 20 characters!</span>
            </div>
            <div class="pure-control-group">
                <label for="passwordconf">Repeat</label>
                <input type="password" id="passwordconf" name="passwordconf" placeholder="Repeat above" />
                <span class="pure-form-message-inline" id="passwordconferror" style="color: red; visibility: hidden">Password and confirmation must be the same</span>
            </div>
            <div class="pure-control-group">
                <label for="resetcode">Code</label>
                <input type="text" id="code" name="code" placeholder="Code" />
                <span class="pure-form-message-inline" id="codeerror" style="color: red; visibility: hidden;">Code has to be 6 signs!</span>
            </div>
            <div class="pure-controls">
                <button class="pure-button" type="button" id="generateCodeButton" onclick="generateCode()">Generate Code</button>
                <img src="https://media3.giphy.com/media/3o7TKtnuHOHHUjR38Y/giphy.gif" id="spin2" style="visibility: hidden; height: 1em; width: 1em;">
                <span class="pure-form-message-inline" id="generateCodeMessage"></span>
            </div>
            <div class="pure-controls">
                <input type="submit" id="reset" name="reset" value="Change" class="pure-button pure-button-primary" disabled>
            </div>
        </div>
    </fieldset>
</form>
<script src="template/reset/script.js"></script>