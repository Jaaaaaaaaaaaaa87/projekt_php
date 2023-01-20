<!-- logout script -->
<?php
    session_start();
    if(session_destroy()){
        header("Location: projekt_login.php"); ///go back to login page
    }
?>