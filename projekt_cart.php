<?php
session_start();
// Jeśli nie ma tablicy koszyka w sesji, utwórz ją
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

// Dodanie produktu do koszyka
if(isset($_POST['product_id']) && isset($_POST['quantity'])){
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    // Sprawdzenie czy produkt już jest w koszyku
    if(array_key_exists($product_id, $_SESSION['cart'])){
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

// Usuwanie produktu z koszyka
if(isset($_GET['remove_id'])){
    $remove_id = $_GET['remove_id'];
    unset($_SESSION['cart'][$remove_id]);
}

// Edycja ilości produktów w koszyku
if(isset($_POST['edit_id']) && isset($_POST['quantity'])){
    $edit_id = $_POST['edit_id'];
    $quantity = $_POST['quantity'];
    $_SESSION['cart'][$edit_id] = $quantity;
}

// Pobranie produktów z koszyka z bazy danych
$conn = mysqli_connect("localhost", "root", "", "users");
$product_ids = implode(',', array_keys($_SESSION['cart']));
$query = "SELECT id, name, price FROM products WHERE id IN ($product_ids)";
if(empty($_SESSION['cart'])){
    echo "<link rel='stylesheet' href='projekt_cart_style.css'/>Koszyk jest pusty. <a href='projekt_userside.php'>Wróć do sklepu</a>";
}else{
$result = mysqli_query($conn, $query);

// Przetwarzanie i wyświetlanie koszyka
$cart_total = 0;
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Koszyk</title>
            <link rel="stylesheet" href="projekt_cart_style.css"/>
        </head>
        <body>
            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Cena</th>
                            <th>Ilość</th>
                            <th>Suma</th>
                            <th>Opcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_array($result)): 
                        $product_id = $row['id'];
                        $product_name = $row['name'];
                        $product_price = $row['price'];
                        $product_quantity = $_SESSION['cart'][$product_id];
                        $product_total = $product_price * $product_quantity;
                        $cart_total += $product_total;
                        ?>
                        <tr>
                        <td><?php echo $product_name; ?></td>
                        <td><?php echo $product_price; ?> PLN</td>
                        <td>
                        <form action="projekt_cart.php" method="post">
                        <input type="hidden" name="edit_id" value="<?php echo $product_id; ?>">
                        <input type="number" name="quantity" value="<?php echo $product_quantity; ?>" min="1">
                        <input type="submit" value="Zapisz">
                        </form>
                        </td>
                        <td><?php echo $product_total; ?> PLN</td>
                        <td>
                        <a href="projekt_cart.php?remove_id=<?php echo $product_id; ?>">Usuń</a>
                        </td>
                        <td>
                        <a href="projekt_userside.php">Wróć do sklepu</a>
                        </td>
                        </tr>
                        <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                        <td colspan="3">Suma:</td>
                        <td><?php echo $cart_total; ?> PLN</td>
                        </tr>
                        </tfoot>
                        </table>
            </div>
        </body>
    </html>
    <?php }?>
<?php
// Zamykanie połączenia z bazą danych
mysqli_close($conn);
?>