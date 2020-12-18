function checkUser() {
    const link = `api/check_user.php?login=${$('#login').val()}&email=${$('#email').val()}`;
    console.log(link);
    $.getJSON(link, function(data) {
        $('#spinningGif').css('visibility', 'visible');
        $('#checkButton').prop('disabled', true);
        $('#login').prop('readonly', true);
        $('#email').prop('readonly', true);
        $('#spin').css('visibility', 'visible');
        setTimeout(() => {
            if (data['exists']) {
                $('#newPasswordSubform').css('visibility', 'visible');
                $('#error').html('');
                console.log("eldo");
            }
            else {
                $('#error').html(data['message']);
                $('#checkButton').prop('disabled', false);
                $('#login').prop('readonly', false);
                $('#email').prop('readonly', false);
            }
            $('#spin').css('visibility', 'hidden');
        }, 3000);
    }
    );
}

function generateCode() {
    const link = `api/generate_reset_code.php?login=${$('#login').val()}&email=${$('#email').val()}`;
    $('#spin2').css('visibility', 'visible');
    $('#generateCodeButton').prop('disabled', true);
    $.getJSON(link, function (data) {
        if (data['success'])
            $('#generateCodeMessage').css('color', 'green');
        else
            $('#generateCodeMessage').css('color', 'red');
        setTimeout(() => {
            $('#generateCodeMessage').html(data['message']);
            if (!data['success'])
                $('#generateCodeButton').prop('disabled', false);
            $('#spin2').css('visibility', 'hidden');
        }, 2000);
    });
}

function checkPasswordField() {
    const pass = $('#password');
    return 6 <= pass.val().length && pass.val().length <= 20;
}

function checkPasswordConfField() {
    const pass = $('#password');
    const passconf = $('#passwordconf');
    return pass.val() === passconf.val();
}


function tryEnableChange() {
    if (checkPasswordField() && checkPasswordConfField() && checkCodeField()) {
        $('#reset').prop('disabled', false);
        $('span').css('visibility', 'hidden');
    }
    else
        $('#reset').prop('disabled', true);
}

function checkInputs(changedInputFunction, selector) {
    const check = changedInputFunction();
    if (check) {
        $(selector).css('visibility', 'hidden');
    }
    else {
        $(selector).css('visibility', 'visible');
    }

    tryEnableChange();
}

function checkCodeField() {
    const code = $('#code');
    return code.val().length === 6;
}

$(document).ready(function () {
    $('#password').change(function (){checkInputs(checkPasswordField, '#passworderror')});
    $('#passwordconf').change(function (){checkInputs(checkPasswordConfField, '#passwordconferror')});
    $('#code').change(function (){checkInputs(checkCodeField, '#codeerror')});
});


