<?php
session_start();
// Połączenie z bazą danych
$conn = mysqli_connect("localhost", "root", "", "users");

// Jeśli nie ma tablicy koszyka w sesji, utwórz ją
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

// Pobranie wszystkich produktów z bazy danych
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Produkty</title>
    <link rel="stylesheet" href="projekt_product_style.css">
</head>
<body>
    <div class="container">
        <a href="projekt_cart.php" id="kosz"> Koszyk</a>
        <div class="user-options">
            <a href="projekt_change_email.php">Zmień email</a><br>
            <a href="projekt_change_password.php">Zmień hasło</a><br>
            <a href="projekt_logout.php">Wyloguj</a><br>
        </div>
        <?php while($row = mysqli_fetch_array($result)): ?>
            <div class="product">
                <img src="<?php echo $row['image_url']; ?>">
                <h3><center><?php echo $row['name']; ?></center></h3>
                <p class="product-description"><?php echo $row['description']; ?></p>
                <p>Cena: <?php echo $row['price']; ?> PLN</p>
                <form action="projekt_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <label for="quantity">Ilość:</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1">
                    <input type="submit" value="Dodaj do koszyka">
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
<?php
// Zamykanie połączenia z bazą danych
mysqli_close($conn);
?>