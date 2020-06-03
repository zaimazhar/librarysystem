<?php

    session_start();

    include('php/app.inc.php');

    $total_data_per_page = 4;

    $books = new books;

    if(isset($_POST['search'])) {
        $search_book = $_POST['search_book'];
        if($search_book == '' || $search_book == null || empty($search_book)) {
            header("Location: library.php?page=1");
        } else {
            $totalBooks = $books->searchBooks($search_book);
            $books->paginate($totalBooks, $total_data_per_page);

            header("Location: library.php?book=$search_book&page=1");
        }
    }

    if(isset($_GET['page']) && isset($_GET['book'])) {
        $books_return = $books->getThisPage($_GET['book'], $_GET['page'], $total_data_per_page);
        $totalBooks = $books->searchBooks($_GET['book']);
        $total_pages = $books->paginate($totalBooks, $total_data_per_page);
    } else if(isset($_GET['page']) && !isset($_GET['book'])) {
        $books_return = $books->getThisPage( null, $_GET['page'], $total_data_per_page);
        $totalBooks = $books->searchBooks(null);
        $total_pages = $books->paginate($totalBooks, $total_data_per_page);
    } else {
        $allBooks = $books->getAllBooks();
        $books_return = $books->getThisPage(null, $_GET['page'], $total_data_per_page);
        header("Location: library.php?page=1");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body class="teal lighten-3">
    <?php include_once('php/navbar.php') ?>
    <div class="container">
        <div class="row">
            <div class="col s12 l8 center-align">
                <h3>Search for your book!</h3>
            </div>
            <div class="col s12 l4">
                <div class="card">
                    <div class="card-content">
                        <form method="POST">
                            <div class="input-field">
                                <i class="material-icons prefix">search</i>
                                <input id="icon_prefix_search" name="search_book" type="text" class="validate">
                                <label for="icon_prefix_search">Search book...</label>
                            </div>
                            <div class="center-align">
                                <button type="submit" name="search" class="btn">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-content">
            <ul class="collection with-header">
                <li class="collection-header"><h4>Search result</h4></li>
                <?php
                    foreach($books_return as $book) {
                ?>
                <li class="collection-item">
                    <div><h6><strong><?php echo $book['book_name']; ?></strong></h6><a href="<?php echo $book['book_url'] ?>" class="secondary-content"><i class="material-icons">send</i></a>
                    <p>by <?php echo $book['book_author'] ?></p>
                </div>
                </li>
                <?php } ?>
                </ul>
                <ul class="pagination center-align">
                <?php

                    $curr_book = isset($_GET['book']) ? $_GET['book'] : null;

                    if(!isset($curr_book)) {
                        for( $i=1; $i <= $total_pages; $i++) {
                            if($_GET['page'] == $i) {
                                echo "<li class='active'><a href='library.php?page=$i'>$i</a></li>";
                            } else {
                                echo "<li class='waves-effect'><a href='library.php?page=$i'>$i</a></li>";
                            }
                        }
                    } else {
                        for( $i=1; $i <= $total_pages; $i++) {
                            if($_GET['page'] == $i) {
                                echo "<li class='active'><a href='library.php?page=$i&book=$curr_book'>$i</a></li>";
                            } else {
                                echo "<li class='waves-effect'><a href='library.php?page=$i&book=$curr_book'>$i</a></li>";
                            }
                        }
                    }
                        
                ?>
                </ul>
            </div>
        </div>
    </div>

</body>
<script src="js/materialize.js"></script>
</html>