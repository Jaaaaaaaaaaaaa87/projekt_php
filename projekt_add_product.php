<?php
session_start();
require('projekt_dp.php');

// Sprawdzenie czy użytkownik jest zalogowany
if(!isset($_SESSION['username'])){
    header("Location: projekt_login.php");
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    // Walidacja danych
    if(empty($name) || empty($description) || empty($price) || empty($image_url)){
        echo "<div class='form'>
                <h3>Nie wszystkie pola zostały wypełnione.</h3>
                <br><a href='projekt_add_product.php'>Spróbuj ponownie</a>
              </div>";
    }else{
        // Dodawanie produktu do bazy danych
        $query = "INSERT INTO products (name, description, price, image_url) VALUES ('$name', '$description', '$price', '$image_url')";
        $result = mysqli_query($con, $query);
        if($result){
            echo "<div class='form'>
                    <h3>Produkt został dodany.</h3>
                    <br><a href='projekt_adminside.php'>Wróć do panelu administracyjnego</a>
                  </div>";
        }else{
            echo "<div class='form'>
                    <h3>Wystąpił błąd podczas dodawania produktu.</h3>
                    <br><a href='projekt_add_product.php'>Spróbuj ponownie</a>
                    </div>";
                    }
                    }
                    }else{
                    ?>
                    
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Dodawanie produktu</title>
                        <link rel="stylesheet" href="projekt_style.css">
                    </head>
                    <body>
                        <div class="container">
                            <form action="projekt_add_product.php" method="post">
                                <h1>Dodawanie produktu</h1>
                                <label for="name">Nazwa:</label>
                                <input type="text" id="name" name="name" required><br>
                                <label for="description">Opis:</label>
                                <textarea id="description" name="description" required></textarea><br>
                                <label for="price">Cena:</label>
                                <input type="number" step="0.01" id="price" name="price" required><br>
                                <label for="image_url">Link do zdjęcia:</label>
                                <input type="text" id="image_url" name="image_url" required><br>
                                <input type="submit" name="submit" value="Dodaj produkt">
                            </form>
                        </div>
                    </body>
                    </html>
                    <?php } mysqli_close($con); ?>