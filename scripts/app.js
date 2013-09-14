$(document).ready(function() {
    var PRIMARY_SCRIPT = 'scripts/app.php';
    var map = document.getElementById('map');
    var WORLD_MAP_URL = 'style/img/world-map.png';
    var LOADING_GIF_URL = 'style/img/map-loader.gif';
    var coordinates = document.getElementById('coordinates');
    var prevLatitude = 0, prevLongitude = 0;

    var userIsOnline = isLoggedIn();

    setInterval(updateMap, 5000);
    $('#signOutMenuLink').hide();
    updateLinks(userIsOnline);
    if (userIsOnline) map.src = LOADING_GIF_URL;
    else map.src = WORLD_MAP_URL;

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

    function updateLinks(online) {
        if (online) {
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

        map.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=17&size=1000x400&maptype=roadmap&markers=color:red%7Clabel:x%7C" + latitude + "," + longitude + "&sensor=false";
        $('#coordinates').html('Last seen: ' + latitude + ', ' + longitude);
    }

    $('#trackButton').click(function() {
        if (!isLoggedIn()) {
            alert("Please sign in first");
        } else {
            if (confirm("Are you sure you want to periodically send your location to the server? Your previous location will be overwritten.")) {
                monitorLocation();
                alert("While this web app is running, you can see this computer's location by logging in on another device.");
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
                    map.src = 'style/img/map-loader.gif';
                    $('#signInModal').modal('hide');
                    updateLinks(isLoggedIn());
                } else {
                    alert("We couldn't sign you in. Make sure you enter your username and password correctly.");
                }
            });
        }
        $('#pwForSignIn').val('');
    });

    $('#signOutMenuLink').click(function() {
        $.post(PRIMARY_SCRIPT, {action: 'SIGN_OUT'}, function() {});
        map.src = WORLD_MAP_URL;
        $('#coordinates').html("");
        prevLatitude = 0, prevLongitude = 0;
        updateLinks(false);
    });

});