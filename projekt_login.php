<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Zaloguj się</title>
        <link rel="stylesheet" href="projekt_style.css"/>
    </head>
    <body>
        <?php
            require('projekt_dp.php');      // Importuj plik z danymi połączenia z bazą danych
            session_start();        // Start sesji
            // Jeśli formularz z logowaniem został wysłany
            if(isset($_POST['username'])){
                // Pobierz dane z formularza
                $username = stripslashes($_REQUEST['username']);        
                $username = mysqli_real_escape_string($con, $username);     
                $password = stripslashes($_REQUEST['password']);        
                $password = mysqli_real_escape_string($con, $password);     
                // Zapytanie do bazy danych, sprawdzenie czy podane dane istnieją w tabeli Users
                $query = "SELECT * FROM `Users` WHERE username='$username' AND password='".md5($password)."'";
                $result = mysqli_query($con, $query) or die(mysql_error());
                $rows = mysqli_num_rows($result);
                // Jeśli znaleziono użytkownika o podanych danych
                if($rows == 1){
                     // Ustaw zmienną sesji na nazwę użytkownika i przekieruj do strony projekt_BT.php
                    $_SESSION['username'] = $username;      
                    header("Location: projekt_BT.php");     
                }else{                                      
                    echo "<div class='form'>        
                            <h3>Błędna nazwa użytkownika/hasło</h3><br>
                            <p class='link'><a href='projekt_login.php'>Spróbuj ponownie</a></p>
                          </div>";
                }
            }else{
        ?>
                <form class="form" action="" method="post">
                    <h1 class="login_title">Zaloguj się</h1>
                    <input type="text" class="login_input" name="username" placeholder="Nazwa użytkownika" autofocus="true"/>
                    <input type="password" class="login_input" name="password" placeholder="Hasło">
                    <input type="submit" class="login_button" name="submit" value="Zaloguj" >
                    <p class="link">Nie masz konta?<br><a href="projekt_register.php">Zarejestruj się!</a></p>
                </form>
        <?php
                }
        ?>
    </body>
</html>