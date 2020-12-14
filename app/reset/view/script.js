function checkUser() {
    const link = `api/check_user.php?login=${$('#login').val()}&email=${$('#email').val()}`;
    console.log(link);
    $.getJSON(link, function(data) {
        $('#spinningGif').css('visibility', 'visible');
        $('#checkButton').prop('readonly', true);
        $('#login').prop('readonly', true);
        $('#email').prop('readonly', true);
        $('#spin').css('visibility', 'visible');
        setTimeout(() => {
            if (data['exists']) {
                $('#newPasswordSubform').css('visibility', 'visible');
                console.log("eldo");
            }
            else {
                $('#error').html(data['message']);
                $('#checkButton').prop('readonly', false);
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
    $.getJSON(link, function (data) {
        $('#generateCodeMessage').html(data['message']);
        if (data['success'])
            $('#generateCodeMessage').css('color', 'green');
        else
            $('#generateCodeMessage').css('color', 'red');
    });
}