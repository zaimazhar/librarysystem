<?php

    session_start();

    include('php/app.inc.php');

    $login_instance = new users;

    if(isset($_POST['submit'])) {
        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_password'];
        $login_status = $login_instance->authenticateUser($login_username, $login_password);

        if($login_status) {
            header("Location: dashboard.php");
        } else {
            header("Location: login.php?error=yes");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body class="teal lighten-3">
    <?php if(isset($_GET['error']) == 'yes') {
        echo "<input type='hidden' value='error' id='checkError'>";
    } else {
        echo "<input type='hidden' id='checkError'>";
    } ?>
    <div id="modalLogin" class="modal modal-fixed-footer">
        <div class="modal-content">
        <h3>Something happened. &#128531;</h3><br>
        <p>There could be number of ways how this error occured. Some of them are listed below;</p>
        <ul class="collection">
            <li class="collection-item">Incorrect password</li>
            <li class="collection-item">The username is not exist</li>
        </ul><br>
        <h6>Other than that, the most aggravated, the server might experiencing some problems. &#128552;</h6>
        </div>
        <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat red-text">Close</a>
        </div>
    </div>
    <?php include_once('php/navbar.php') ?>
    <div class="container">
        <div class="row center-align">
            <div class="col l12 s12">
                <div class="card-panel white"><h5>Login</h5><br>
                    <div class="row">
                        <div class="col s12">
                            <form method="post">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="icon_prefix_username" name="login_username" type="text" class="validate">
                                    <label for="icon_prefix_username">Username</label>
                                </div><br>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">fingerprint</i>
                                    <input id="icon_prefix_password" name="login_password" type="password" class="validate">
                                    <label for="icon_prefix_password">Password</label>
                                </div>
                                <div class="input-field col s12">
                                    <button class="waves-effect waves-light btn red darken-2" type="reset">Reset</button>
                                    <button class="waves-effect waves-light btn" name="submit" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>

</body>
<script src="js/materialize.js"></script>
</html>