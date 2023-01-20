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

// Dodawanie nowego produktu
if(isset($_POST['add_product'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    // Zabezpieczenie przed sql injection
    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);
    $price = mysqli_real_escape_string($conn, $price);
    $image_url = mysqli_real_escape_string($conn, $image_url);

    // Dodanie do bazy danych
    $query = "INSERT INTO products (name, description, price, image_url) VALUES ('$name', '$description', '$price', '$image_url')";
    mysqli_query($conn, $query);
}

// Modyfikowanie produktu
if(isset($_POST['edit_product'])){
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    // Zabezpieczenie przed sql injection
    $product_id = mysqli_real_escape_string($conn, $product_id);
    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);
    $price = mysqli_real_escape_string($conn, $price);
    $image_url = mysqli_real_escape_string($conn, $image_url);

    // Modyfikacja w bazie danych
    $query = "UPDATE products SET name='$name', description='$description', price='$price', image_url='$image_url' WHERE id='$product_id'";
    mysqli_query($conn, $query);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Produkty</title>
    <link rel="stylesheet" href="projekt_product_style.css">
</head>
<body>
    <div class="container">
        <a href="projekt_order_management.php" id="order_management"> Zarządzaj zamówieniami klientów</a>
        <div class="user-options">
            <a href="projekt_change_email.php">Zmień email</a><br>
            <a href="projekt_change_password.php">Zmień hasło</a><br>
            <a href="projekt_logout.php">Wyloguj</a><br>
        </div>
        <div class="add-product">
            <form action="projekt_add_product.php" method="post">
                <input type="submit" value="Dodaj produkt">
            </form>
        </div>
        <?php while($row = mysqli_fetch_array($result)): ?>
            <div class="product">
                <img src="<?php echo $row['image_url']; ?>">
                <h3><center><?php echo $row['name']; ?></center></h3>
                <p class="product-description"><?php echo $row['description']; ?></p>
                <p>Cena: <?php echo $row['price']; ?> PLN</p>
                <form action="projekt_edit_product.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" value="Edytuj produkt">
                </form>
                <form action="projekt_adminside.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" value="Usuń produkt">
                    <?php
                        if(isset($_POST['product_id'])){
                            $product_id = $_POST['product_id'];
                            $query = "DELETE FROM products WHERE id = '$product_id'";
                            $result = mysqli_query($conn, $query);
                            if($result){
                                echo "Produkt został usunięty z bazy danych.";
                                header("Location: projekt_adminside.php");
                            } else {
                                echo "Wystąpił błąd podczas usuwania produktu z bazy danych.";
                                header("Location: projekt_adminside.php");
                            }
                        }
                        ?>
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