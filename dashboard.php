<?php

    session_start();

    if(!$_SESSION) {
        header("Location: /");
    }

    include('php/app.inc.php');

    $getAllBoosk = new books;

    $totalBooks = count($getAllBoosk->getAllBooks());

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
    <?php include_once('php/navbar.php') ?>
    <br><br>
    <div class="row">
        <div class="col s4"></div>
        <div class="col s4"></div>
        <div class="col s4 center-align"><form method="post">
        <button type="submit" class="btn" name="logout">Logout</button>
    </form></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Upload a new book</span><br>

                        <p>Uploaded books: <strong><?php echo $totalBooks; ?></strong></p>
                    </div>
                    <div class="card-action">
                        <a href="uploadbook.php">Upload</a>
                    </div>
                </div>
            </div>
            <div class="col l6 s12">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Check books</span><br>

                        <p>Uploaded books: <strong><?php echo $totalBooks; ?></strong></p>
                    </div>
                    <div class="card-action">
                        <a href="#">This is a link</a>
                        <a href="#">This is a link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/materialize.js"></script>
</html>