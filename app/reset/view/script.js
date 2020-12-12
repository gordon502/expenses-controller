function checkUser() {
    const link = `api/check_user.php?login=${$('#login').val()}&email=${$('#email').val()}`;
    console.log(link);
    $.getJSON(link, function(data) {
        $('#spinningGif').css('visibility', 'visible');
        $('#checkButton').prop('disabled', true);
        $('#spin').css('visibility', 'visible');
        setTimeout(() => {
            if (data['exists']) {
                $('#newPasswordSubform').css('visibility', 'visible');
                $('#login').prop('disabled', true);
                $('#email').prop('disabled', true);
                console.log("eldo");
            }
            else {
                $('#error').html(data['message']);
                $('#checkButton').prop('disabled', false);
            }
            $('#spin').css('visibility', 'hidden');
        }, 3000);
    }
    );
}