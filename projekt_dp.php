<!--Connection with database -->
<?php
    $con = mysqli_connect("localhost","root","","Users");///connecting with database users
    if(mysqli_connect_errno()){
        echo "Failed to connect with database: ".mysqli_connect_error();///connection error 'handling'
    }
?>