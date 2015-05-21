<?php
    if (!isset ($_SESSION['username']) || !isset ($_SESSION['pass'])) {
        echo "<br /><a href=\"index.php\">Home</a><br />";
        echo "<h1>Password Successfully Updated !</h1>";
    }
?>
