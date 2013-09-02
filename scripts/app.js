$(document).ready(function() {
    var PRIMARY_SCRIPT = 'scripts/app.php';
    var isLoggedIn = false;

    $('#signOutMenuLink').hide();

    function isLoggedIn() {
        return false;
    }

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
        $.post(PRIMARY_SCRIPT, {
            action: 'ADD_USER',
            username: $('#unForRegister').val(),
            password: $('#pwForRegister').val()
        }, function(data) {
            alert(data);
        });
    });

    $('#signInButton').click(function() {
        if (!isLoggedIn) {
            $.post(PRIMARY_SCRIPT, {
                action: 'SIGN_IN',
                username: $('#unForSignIn').val(),
                password: $('#pwForSignIn').val()
            }, function(data) {
                if (data == "OK") {
                    $('#signInMenuLink').hide();
                    $('#signOutMenuLink').show();
                    $('#signInModal').modal('hide');
                    isLoggedIn = true;
                }
            });
            $('#pwForSignIn').val('');
        }
    });

    $('#signOutMenuLink').click(function() {
        $.post(PRIMARY_SCRIPT, {action: 'SIGN_OUT'},
        function() {
            isLoggedIn = false;
            $('#signOutMenuLink').hide();
            $('#signInMenuLink').show();
        });
    });

});