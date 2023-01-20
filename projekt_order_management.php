<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "users");

// Pobranie listy użytkowników z bazy danych
$query = "SELECT id, username FROM users";
$result = mysqli_query($conn, $query);

// Sprawdzenie czy formularz został przesłany
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];

    // Pobranie zamówień dla wybranego użytkownika
    $query = "SELECT * FROM orders WHERE user_id = $user_id";
    $orders_result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zamówienia</title>
</head>
<body>
    <div class="container">
        <form action="orders.php" method="post">
            <label for="user_id">Wybierz użytkownika:</label>
            <select name="user_id" id="user_id">
                <?php while($row = mysqli_fetch_array($result)): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
                <?php endwhile; ?>
            </select>
            <input type="submit" value="Wyświetl zamówienia">
        </form>

        <?php if(isset($orders_result)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID zamówienia</th>
                        <th>ID produktu</th>
                        <th>Ilość</th>
                        <th>Data zamówienia</th>
                        <th>Opcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($order = mysqli_fetch_array($orders_result)): ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo $order['product_id']; ?></td>
                            <td><?php echo $order['quantity']; ?></td>
                            <td><?php echo $order['created_at']; ?></td>
                            <td>
                                <form action="delete_order.php" method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                    <input type="submit" value="Usuń">
                                </form>
                            </td>
                       
