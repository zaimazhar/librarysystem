<?php

    session_start();

    include('php/app.inc.php');

    if(!$_SESSION) {
        header("Location: /");
    }

    $uploadbook = new books;

    if(isset($_POST['upload'])) {
        $book_name = $_POST['book_name'];
        $book_author = $_POST['book_author'];
        $book_category = $_POST['book_category'];
        $book_summary = $_POST['book_summary'];
        $book_publisher = $_POST['book_publisher'];
        $file_name = $_FILES['book_file']['name'];
        $dir = "storage/" . $file_name;
        $file = $_FILES['book_file']['tmp_name'];
        $checkfile = $uploadbook->insertBook($book_name, $book_author, $book_category, $book_publisher, $book_summary, $file, $file_name);
        
        if($checkfile) {
            echo "Success";
        } else {
            header("Location: uploadbook.php?error=yes");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
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
    <!-- Modal Structure -->
    <div id="modal1" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h3>Something happened. &#128531;</h3><br>
            <p>There could be number of ways how this error occured. Some of them are listed below;</p>
            <ul class="collection">
                <li class="collection-item">Your <strong>summary</strong> is more than 250 characters</li>
                <li class="collection-item">Your file extension cannot be other than <strong>pdf</strong></li>
            </ul><br>
            <h6>Other than that, the most aggravated, the server might experiencing some problems. &#128552;</h6>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat red-text">Close</a>
        </div>
    </div>
    <?php include_once('php/navbar.php') ?>
    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="col s12 m7">
                <h3 class="header">Upload a book</h3>
                <div class="card horizontal">
                    <div class="card-stacked">
                    <div class="right-align">
                        <a href="dashboard.php" class="btn-large red lighten-2">Back to Dashboard</a>
                    </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">library_books</i>
                                    <input id="icon_prefix_book_name" name="book_name" type="text" class="validate">
                                    <label for="icon_prefix_book_name">Book Name</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">edit</i>
                                    <input id="icon_prefix_book_author" name="book_author" type="text" class="validate">
                                    <label for="icon_prefix_book_author">Book Author</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">folder</i>
                                    <input id="icon_prefix_book_category" name="book_category" type="text" class="validate">
                                    <label for="icon_prefix_book_category">Book Category</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">folder</i>
                                    <input id="icon_prefix_book_publisher" name="book_publisher" type="text" class="validate">
                                    <label for="icon_prefix_book_publisher">Book Publisher</label>
                                </div>
                            </div>
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>File upload</span>
                                    <input type="file" name="book_file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="row">
                                    <div class="input-field col s12">
                                    <textarea id="textarea1" class="materialize-textarea" name="book_summary"></textarea>
                                    <label for="textarea1">Book Summary</label>
                                    </div>
                                </div>
                            </div>
                            <div class="center-align">
                                <button type="reset" class="waves-effect waves-light btn-large red">Reset</button>
                                <button type="submit" name="upload" class="waves-effect waves-light btn-large">Upload</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </form>
    </div>

</body>
<script src="js/materialize.js"></script>
</html>