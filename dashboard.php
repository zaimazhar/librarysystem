<?php

    session_start();

    if(isset($_POST['logout'])) {
        session_destroy();
        header("Location: /");
    }

    if(!$_SESSION) {
        header("Location: /");
    }

    include('php/app.inc.php');

    $getAllBooks = new books;

    $totalBooks = count($getAllBooks->getAllBooks());

    $getLatestResult = $getAllBooks->Latest();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        <button type="submit" class="btn red lighten-2" name="logout">Logout</button>
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
                        <span class="card-title">Latest book!</span><br>
                        <div class="row">
                            <div class="col s12 l3">
                                <p>Book Name</p>
                                <p>Book Author</p>
                                <p>Book Category</p>
                                <p>Book Publisher</p>
                            </div>
                            <div class="col s12 l9">
                                <strong><p><?php echo $getLatestResult[0]['book_name'] ?></p></strong>
                                <strong><p><?php echo $getLatestResult[0]['book_author'] ?></p></strong>
                                <strong><p><?php echo $getLatestResult[0]['book_category'] ?></p></strong>
                                <strong><p><?php echo $getLatestResult[0]['book_publisher'] ?></p></strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="adminbrowse.php">Browse Books</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/materialize.js"></script>
</html>