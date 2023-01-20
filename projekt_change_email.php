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
    $new_email = $_POST['new_email'];
    $confirm_email = $_POST['confirm_email'];

    // Sprawdzenie czy podane hasło jest prawidłowe
    $query = "SELECT * FROM Users WHERE username='$username' AND password='".md5($password)."'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);

    if($rows == 1){
        // Sprawdzenie czy nowy email i potwierdzenie emaila są takie same
        if($new_email == $confirm_email){
            $query = "UPDATE Users SET email='$new_email' WHERE username='$username'";
            $result = mysqli_query($con, $query);
            if($result){
                echo "<div class='form'>
                        <h3>Email został zmieniony.</h3>
                        <br><a href='projekt_login.php'>Zaloguj się ponownie</a>
                      </div>";
            }
        }else{
            echo "<div class='form'>
                    <h3>Nowy email i potwierdzenie emaila nie są takie same.</h3>
                    <br><a href='projekt_change_email.php'>Spróbuj ponownie</a>
                  </div>";
        }
    }else{
        echo "<div class='form'>
                <h3>Podane hasło jest nieprawidłowe.</h3>
                <br><a href='projekt_change_email.php'>Spróbuj ponownie</a>
              </div>";
    }
}else{
?>
<!DOCTYPE html>
<html>
<head>
    <title>Zmiana emaila</title>
    <link rel="stylesheet" href="projekt_style.css">
</head>
<body>
    <div class="container">
        <form action="projekt_change_email.php" method="post">
            <h1>Zmiana emaila</h1>
            <label for="password">Podaj swoje hasło:</label>
            <input type="password" id="password" name="password" required><br>
            <label for="new_email">Podaj nowy email:</label>
            <input type="email" id="new_email" name="new_email" required><br>
            <label for="confirm_email">Potwierdź nowy email:</label>
            <input type="email" id="confirm_email" name="confirm_email" required><br>
            <input type="submit" name="submit" value="Zmień email">
        </form>
    </div>
</body>
</html>
<?php } mysqli_close($con); ?>