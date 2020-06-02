<?php

    session_start();

    include('php/app.inc.php');

    $now_db = new books();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body class="teal lighten-3">
    <?php include_once('php/navbar.php') ?>
    <div class="container"><br><br>
        <!-- <h3 class="title">Welcome to OnlineLibrary</h3> -->
        <br><br>
        <h5 class="article">Check out our top 5 recent books!</h5><br>
        <ul class="collection">
            <?php foreach($now_db->fiveLatest() as $data) { ?>
            <li class="collection-item avatar">
                <span class="title"><strong><?php echo $data['book_name'] ?></strong> by <?php echo $data['book_author'] ?></span>
                <div></div><br>
                <p class="truncate"><?php echo $data['book_summary'] ?></p>
                <a href="<?php echo $data['book_url'] ?>">Click to read</a>
                </p>
            </li>
            <?php } ?>
        </ul>
    </div>

</body>
<script src="js/materialize.js"></script>
<script>
    
</script>
</html>