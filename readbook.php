<?php

$get_file_name = $_GET['book'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    header('Content-type:application/pdf');
    header("Content-disposition: inline; filename=$get_file_name");
    header('content-Transfer-Encoding:binary');
    header('Accept-Ranges:bytes');
    @readfile('storage/' . $get_file_name);

    ?>
</body>
</html>