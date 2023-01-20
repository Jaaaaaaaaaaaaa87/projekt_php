<!-- session -->
<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: projekt_login.php");///if username is not set, go back to login
        exit();
    }
?>