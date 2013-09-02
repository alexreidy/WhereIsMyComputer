$(document).ready(function() {

    function start_tracking() {
        navigator.geolocation.watchPosition(
            function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                $.post(
                    'scripts/app.php',
                    {action: 'UPDATE_LOCATION', lat: latitude, lon: longitude},
                    function(data) {}
                );
            }
        );
    }

    $.post(
        'scripts/app.php',
        {action: 'SIGN_IN', username: 'admin', password: 'abc123'},
        start_tracking
    );

});