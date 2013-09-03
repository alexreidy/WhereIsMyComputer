$(document).ready(function() {
    var PRIMARY_SCRIPT = 'scripts/app.php';

    $('#signOutMenuLink').hide();
    updateLinks();

    function isLoggedIn() {
        var online;
        $.ajax({
            type: 'POST',
            url: PRIMARY_SCRIPT,
            async: false,
            data: {action: 'CHECK_SESSION'}
        }).done(function(data) {
            if (data == 'SET') online = true;
            else online = false;
        });
        return online;
    }

    function updateLinks() {
        if (isLoggedIn()) {
            $('#signInMenuLink').hide();
            $('#signOutMenuLink').show();
            $('#registerLink').hide();
        } else {
            $('#signOutMenuLink').hide();
            $('#signInMenuLink').show();
            $('#registerLink').show();
        }
    }

    function monitorLocation() {
        navigator.geolocation.watchPosition(
            function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                $.post('scripts/app.php', {
                    action: 'UPDATE_LOCATION',
                    lat: latitude, lon: longitude
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
            var username = $('#unForRegister').val();
            if (data == 'OK') {
                $('#registerModal').modal('hide');
                $('#unForSignIn').val(username);
                $('#signInModal').modal('show');
            } else {
                alert('Sorry, the username "' + username + '" is taken.');
            }
        });
    });

    $('#signInButton').click(function() {
        if (!isLoggedIn()) {
            $.post(PRIMARY_SCRIPT, {
                action: 'SIGN_IN',
                username: $('#unForSignIn').val(),
                password: $('#pwForSignIn').val()
            }, function(data) {
                if (data == 'OK') {
                    $('#signInModal').modal('hide');
                } else {
                    alert("We couldn't sign you in. Make sure you enter your username and password correctly.");
                }
            });
        }
        $('#pwForSignIn').val('');
        updateLinks();
    });

    $('#signOutMenuLink').click(function() {
        $.post(PRIMARY_SCRIPT, {action: 'SIGN_OUT'},
        function() {
            updateLinks();
        });
    });

});