$.ajaxSetup({
    async: false
});

function validateEmail(input) {
    let validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (input.match(validRegex)) {
        return true;
    }
    else {
        return false;
    }
}

function checkUsername() {
    //first check username length
    const username = $('#login');
    const usernameLength = username.val().length;
    if (usernameLength < 8 || 45 < usernameLength) {
        return {result: false, info: 'Username must be between 8 and 45 characters!'};
    }

    // check if login is free
    let isUsernameFree = false;
    $.getJSON(`api/check_user.php?login=${username.val()}`, function (data) {
        isUsernameFree = !data['exists'];
        //console.log(!data['exists']);
    });

    if (isUsernameFree)
        return {result: true, info: 'ok'};
    else
        return {result: false, info: 'Username is already taken'};

}

function checkPassword() {
    const passLength = $('#password').val().length;

    const passConf = checkPasswordConf();
    if (passConf['result']) {
        $('#passwordconferror').html('');
    }
    else {
        $('#passwordconferror').html('Password and its confirmation must be the same!');
    }

    if (6 <= passLength && passLength <= 20)
        return {result: true, info: 'ok'};
    else
        return {result: false, info: 'Password must be between 6 and 20 characters!'};
}

function checkPasswordConf() {
    if ($('#password').val() === $('#passwordconf').val())
        return {result: true, info: 'ok'};
    else
        return {result: false, info: 'Password and its confirmation must be the same!'};
}

function checkEmail() {
    const email = $('#email');
    if (!validateEmail(email.val())) {
        return {result: false, info: 'Mail format not correct!'};
    }

    let isEmailFree = false;
    $.getJSON(`api/check_user.php?email=${email.val()}`, function (data) {
        isEmailFree = !data['exists'];
    });

    if (isEmailFree)
        return {result: true, info: 'ok'};
    else
        return {result: false, info: 'Email is already taken'};
}

function tryEnableRegister() {
    if (checkUsername()['result'] && checkPassword()['result'] && checkPasswordConf()['result'] && checkEmail()['result']) {
        $('#register').prop('disabled', false);
        $('span').html('');
    }
    else
        $('#register').prop('disabled', true);
}

function checkInputs(changedInputFunction, selector) {
    const check = changedInputFunction();
    if (check['result']) {
        $(selector).html('');
    }
    else {
        $(selector).html(check['info']);
    }

   tryEnableRegister();
}


// binding functions to fields in registration form
$(document).ready(function () {
    $('#login').change(function (){checkInputs(checkUsername, '#loginerror')});
    $('#password').change(function (){checkInputs(checkPassword, '#passworderror')});
    $('#passwordconf').change(function (){checkInputs(checkPasswordConf, '#passwordconferror')});
    $('#email').change(function (){checkInputs(checkEmail,'#emailerror')});
});


