<?php

    if(isset($_POST['logout'])) {
        session_destroy();
        header("Location: /");
    }

?>

<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo center">library</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="index.php" style="vertical-align: middle;"><span class="material-icons" style="vertical-align: text-bottom; margin-right: 1px;">home</span> Home</a></li>
            <li><a href="library.php" style="vertical-align: middle;"><span class="material-icons" style="vertical-align: text-bottom; margin-right: 1px;">search</span> Browse</a></li>
            
            <?php if(!$_SESSION) { ?>
                <li><a href="login.php" style="vertical-align: middle;"><span class="material-icons" style="vertical-align: text-bottom; margin-right: 1px;">perm_identity</span> Login</a></li>
            <?php } else { ?>
                <li><a href="dashboard.php" style="vertical-align: middle;"><span class="material-icons" style="vertical-align: text-bottom; margin-right: 1px;">assignment_ind</span> Dashboard</a></li>
            <?php } ?>            
        </ul>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <br>
    <li><a href="index.php" style="vertical-align: middle;"><span class="material-icons" style="vertical-align: text-bottom; margin-right: 5px;">home</span> Home</a></li>
    <li><a href="library.php" style="vertical-align: middle;"><span class="material-icons" style="vertical-align: text-bottom; margin-right: 5px;">search</span> Browse</a></li>
    <?php if(!$_SESSION) { ?>
        <li><a href="login.php"><span class="material-icons" style="vertical-align: text-bottom; margin-right: 5px;">perm_identity</span> Login</a></li>
    <?php } else { ?>
        <li><a href="dashboard.php"><span class="material-icons" style="vertical-align: text-bottom; margin-right: 5px;">assignment_ind</span> Dashboard</a></li>
    <?php } ?>
</ul>