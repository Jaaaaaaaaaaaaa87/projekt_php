<!-- register -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Rejestracja nowego konta</title>
        <link rel="stylesheet" href="projekt_style.css"/>
    </head>
    <body>
        <?php
            require('projekt_dp.php');          
            if(isset($_REQUEST['username'])){
                $username = stripslashes($_REQUEST['username']);        
                $username = mysqli_real_escape_string($con, $username);     
                $email = stripslashes($_REQUEST['email']);      
                $email = mysqli_real_escape_string($con, $email);       
                $password = stripslashes($_REQUEST['password']);        
                $password = mysqli_real_escape_string($con, $password);    
                $time_created = date("Y-m-d H:i:s");
                $query = "SELECT * FROM users WHERE username='$username'";
                $result = mysqli_query($con, $query);
                $rows = mysqli_num_rows($result);
                if($rows==1){
                    echo "<div class='form'>
                            <h3>Nazwa zajęta</h3><br>
                            <p class='link'><a href='projekt_register.php'>Spróbuj ponownie.</a></p>
                            </div>";
                }else {
                    $query = "INSERT INTO `users` (username, password, email, time_created)  
                            VALUES ('$username','".md5($password)."','$email','$time_created')";  
                    $result = mysqli_query($con, $query);
                    if($result){        
                        echo "<div class='form'>
                                <h3>Konto zarejestrowane pomyślnie</h3><br>
                                <p class='link'><a href='projekt_login.php'>Zaloguj się</a></p>
                                </div>";
                    }else{              
                        echo "<div class='form'>
                                <h3>Wypełnij wszystkie pola</h3><br>
                                <p class='link'><a href='projekt_register.php'>Spróbuj ponownie</a></p>
                                </div>";
                    }
                }
            }else{
        ?>
                <form class="form" action="" method="post">         <!-- registration form -->
                    <h1 class="login_title">Registration</h1>
                    <input type="text" class="login_input" name="username" placeholder="Nazwa użytkownika" required />
                    <input type="text" class="login_input" name="email" placeholder="Email" required>
                    <input type="password" class="login_input" name="password" placeholder="Hasło" required>
                    <input type="submit" class="login_button" name="submit" value="Zarejestruj się" >
                    <p class="link">Masz już konto?<br><a href="projekt_login.php">Zaloguj się</a></p>
                </form>
        <?php
            }
        ?>
    </body>
</html>