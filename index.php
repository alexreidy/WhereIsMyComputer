<!DOCTYPE html>
<html>
    <head>
        <title>Where is my computer?</title>
        <link rel="stylesheet" href="style/css/bootstrap.min.css">
        <style type="text/css">
            #footer {
                position:absolute;
                text-align:center;
                bottom:0;
                width:100%;
                height:40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <center><h2 style="color:#6E8D6E; font-family:verdana;">WhereIsMyComputer? (Beta)</h2></center>
            <div class="navbar">
                <div class="navbar-inner">
                    <button id="trackButton" class="btn"><i class="icon-map-marker"></i><i class="icon-screenshot"></i><i class="icon-globe"></i></button>
                    <ul class="nav pull-right">
                        <li><a id="signInMenuLink" href="#signInModal" data-toggle="modal"><i class="icon-user"></i> Sign in</a></li>
                        <li><a id="signOutMenuLink" href="#"><i class="icon-off"></i> Sign out</a></li>
                        <li><a id="registerLink" href="#registerModal" data-toggle="modal"><i class="icon-plus-sign"></i> Register</a></li>
                    </ul>
                </div>
            </div>
            <div id="mapArea" class="container" style="text-align:center;">
                <img id="map"></img>
                <p class="muted" id="coordinates"></p>
            </div>
        </div>
        <div id="footer" style="text-align:center;">
            <p class="muted">Created by <a class="muted" href="http://alexreidy.me">Alex Reidy</a></p>
        </div>

        <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="primaryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Sign in</h4>
                    </div>
                    <div class="modal-body">
                        <input id="unForSignIn" type="text" placeholder="Username">
                        <input id="pwForSignIn" type="password" placeholder="Password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="signInButton" type="button" class="btn btn-primary">Sign in</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="primaryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Register</h4>
                    </div>
                    <div class="modal-body">
                        <input id="unForRegister" type="text" placeholder="Username">
                        <input id="pwForRegister" type="password" placeholder="Password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="registerButton" type="button" class="btn btn-primary">Create my account</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="style/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="scripts/app.js"></script>
    </body>
</html>