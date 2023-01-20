<!-- main page -->
<?php
    include("projekt_session.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome!</title>
        <link rel="stylesheet" href="projekt_style.css"/>
    </head>
    <body>
        <div class="form">
            <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
            <?php
                // DB connection
                $conn = mysqli_connect("localhost", "root", "", "Users");

                // is user logged in?
                if(isset($_SESSION['username'])){
                    $username = $_SESSION['username'];

                    // info from DB
                    $query = "SELECT isadmin FROM users WHERE username='$username'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_array($result);

                    // is the user admin
                    if($row['isadmin'] == 1){
                        // for admin
                        echo "Witaj, administratorze! Masz dostęp do specjalnych funkcji.";
                    }else{
                        // for not admin
                        echo "Witaj, użytkowniku! Twoje konto nie posiada specjalnych uprawnień.";
                        header("Location: projekt_userside.php");

                    }
                }else{
                    // if not logged in (should ba automatically sent to login page, this is just in case something breaks)
                    echo "Musisz się zalogować, aby zobaczyć tę stronę.";
                }

                // closing conn with DB
                mysqli_close($conn);
                ?>
            <p><a href="projekt_logout.php">Log out</a></p>
        </div>
    </body>
</html>