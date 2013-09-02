<!DOCTYPE html>
<html>
    <head>
        <title>LocateMyPC</title>
        <link rel="stylesheet" href="style/css/bootstrap.min.css">
        <style type="text/css">
            body {
                margin:20px;
                margin-left:250px;
                margin-right:250px;
            } .navbar {margin-bottom:20px;}
        </style>
    </head>
    <body>
        <div class="container">

            <div class="navbar">
                <div class="navbar-inner">
                    <a class="brand" href="#">LocateMyPC</a>
                    <ul class="nav">
                        <li><a href="">About</a></li>
                        <li><a href="">Link</a></li>
                        <li class="pull-right"><a href="">Link</a></li>
                    </ul>
                    <ul class="nav pull-right">
                        <li><a id="signInMenuLink" href="#signInModal" data-toggle="modal">Sign in</a></li>
                        <li><a href="#registerModal" data-toggle="modal">Register</a></li>
                    </ul>
                </div>
            </div>
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