$(document).ready(function() {
    var PRIMARY_SCRIPT = 'scripts/app.php';
    var map = document.getElementById('map');
    var coordinates = document.getElementById('coordinates');
    var prevLatitude = 0, prevLongitude = 0;

    setInterval(updateMap, 3000);
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

    function get(type) {
        var ret;
        $.ajax({
            type: 'POST',
            url: PRIMARY_SCRIPT,
            async: false,
            data: {action: type}
        }).done(function(data) {
            ret = data;
        });
        return ret;
    }

    function updateMap() {

        if (!isLoggedIn())
            return;

        var latitude = get('LATITUDE'), longitude = get('LONGITUDE');
        if (latitude == prevLatitude && longitude == prevLongitude)
            return;

        prevLatitude = latitude, prevLongitude = longitude;

        map.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=17&size=600x300&maptype=roadmap&markers=color:red%7Clabel:x%7C" + latitude + "," + longitude + "&sensor=false";
        $('#coordinates').html(latitude + ', ' + longitude);
    }

    $('#trackButton').click(function() {
        if (!isLoggedIn()) {
            alert("Please sign in first");
        } else {
            if (confirm("WARNING\nAre you sure you want to start tracking this device? Doing so will overwrite the current location data.")) {
                monitorLocation();
            }
        }
    });

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
        $.post(PRIMARY_SCRIPT, {action: 'SIGN_OUT'}, updateLinks);
        map.src = 'style/img/MapLoadingPic.gif'; $('#coordinates').html("");
        prevLatitude = 0, prevLongitude = 0;
    });

});