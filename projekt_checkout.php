<?php
session_start();
// Pobranie produktów z koszyka z bazy danych
$conn = mysqli_connect("localhost", "root", "", "users");
$product_ids = implode(',', array_keys($_SESSION['cart']));
$query = "SELECT id, name, price FROM products WHERE id IN ($product_ids)";
$result = mysqli_query($conn, $query);

// Przetwarzanie i wyświetlanie koszyka
$cart_total = 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Kasa</title>
        <link rel="stylesheet" href="projekt_cart_style.css"/>
    </head>
    <body>
        <div class="container">
            <h1>Kasa</h1>
            <table>
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Cena</th>
                        <th>Ilość</th>
                        <th>Suma</th>
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
                        <td><?php echo $product_quantity; ?></td>
                        <td><?php echo $product_total; ?> PLN</td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Suma</td>
                        <td><?php echo $cart_total; ?> PLN</td>
                    </tr>
                </tfoot>
            </table>
            <form action="" method="post">
                <label for="name">Imię i nazwisko:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Adres email:</label>
                <input type="email" id="email" name="email" required>
                <label for="address">Adres:</label>
                <input type="text" id="address" name="address" required>
                <input type="submit" name="submit" value="Zamów">
                </form>
                <a href="projekt_userside.php">Wróć</a>
                <?php
                if(isset($_POST['submit'])) {
                // Pobranie ID zalogowanego użytkownika
                $conn = mysqli_connect("localhost", "root", "", "users");
                $user = $_SESSION['username'];
                $query = "SELECT id FROM users WHERE username='$user'";
                $result = mysqli_query($conn, $query);
                $user_id = mysqli_fetch_array($result)['id'];
                                // Konwersja tablicy z produktami na string z id produktów oddzielonymi przecinkami
                                $product_ids = implode(',', array_keys($_SESSION['cart']));
            
                                // Tworzenie zapytania INSERT
                                $query = "INSERT INTO orders (user_id, product_ids, cart_total) VALUES ('$user_id', '$product_ids', '$cart_total')";
                            
                                // Wykonanie zapytania i sprawdzenie czy zostało ono prawidłowo wykonane
                                if(mysqli_query($conn, $query)){
                                    // Opróżnienie koszyka
                                    unset($_SESSION['cart']);
                                    // Przekierowanie na stronę z potwierdzeniem zamówienia
                                    header("Location: projekt_success.php");
                                } else {
                                    echo "Błąd podczas zamawiania produktów. Proszę spróbować ponownie później.";
                                }
                            }
                        ?>
                    </div>
                </body>
</html>                