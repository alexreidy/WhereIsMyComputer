$(document).ready(function() {

    function startLocating() {
        navigator.geolocation.watchPosition(
            function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                $.post('scripts/app.php', {
                    action: 'UPDATE_LOCATION', lat: latitude, lon: longitude
                }, function(data) {

                });
            }
        );
    }

    $('#registerButton').click(function() {
        $.post('scripts/app.php', {
            action: 'ADD_USER',
            username: $('#unForRegister').val(),
            password: $('#pwForRegister').val()
        }, function(data) {
            alert(data);
        });
    });

    $('#signInButton').click(function() {
        $.post('scripts/app.php', {
            action: 'SIGN_IN',
            username: $('#unForSignIn').val(),
            password: $('#pwForSignIn').val()
        }, function(data) {
            alert(data);
        });
    });

});