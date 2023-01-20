<?php
session_start();
require('projekt_dp.php');

// Sprawdzenie czy użytkownik jest zalogowany
if(!isset($_SESSION['username'])){
    header("Location: projekt_login.php");
}

if(isset($_POST['submit'])){
    $username = $_SESSION['username'];
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Sprawdzenie czy podane hasło jest prawidłowe
    $query = "SELECT * FROM Users WHERE username='$username' AND password='".md5($password)."'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);

    if($rows == 1){
        // Sprawdzenie czy nowe hasło i potwierdzenie hasła są takie same
        if($new_password == $confirm_password){
            $new_password = md5($new_password);
            $query = "UPDATE Users SET password='$new_password' WHERE username='$username'";
            $result = mysqli_query($con, $query);
            if($result){
                echo "<div class='form'>
                        <h3 style='color: black;'>Hasło zostało zmienione.</h3>
                        <br><a href='projekt_login.php'>Zaloguj się</a>
                      </div>";
            }
        }else{
            echo "<div class='form'>
                    <h3 style='color: black;'>Nowe hasło i potwierdzenie hasła nie są takie same.</h3>
                    <br><a href='projekt_change_password.php'>Spróbuj ponownie</a>
                  </div>";
        }
    }else{
        echo "<div class='form'>
        <h3 style='color: black;'>Podane hasło jest nieprawidłowe.</h3>
        <br><a href='projekt_change_password.php'>Spróbuj ponownie</a>
      </div>";
    }}?>
        <!DOCTYPE html>
            <html>
            <head>
                <title>Zmiana hasła</title>
                <link rel="stylesheet" href="projekt_style.css">
            </head>
            <body style="color: azure;">
                <div class="container">
                    <form action="projekt_change_password.php" method="post">
                        <h1>Zmiana hasła</h1>
                        <label for="password">Obecne hasło:</label>
                        <input type="password" id="password" name="password" required><br>
                        <label for="new_password">Nowe hasło:</label>
                        <input type="password" id="new_password" name="new_password" required><br>
                        <label for="confirm_password">Potwierdź hasło:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required><br>
                        <input type="submit" name="submit" value="Zmień hasło">
                    </form>
                </div>
            </body>
            </html>
<?php /*}*/ mysqli_close($con); ?>