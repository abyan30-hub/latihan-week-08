<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Shopping Cart Test</title>
</head>
<body>
<h1>Items available</h1>
<form action="latihan-week08-5.php" method="post">
<table>
<tr><th>Item</th><th>Quantity</th></tr>
<tr><td>Apples</td><td><input type="text" name="apples" size="2"></td></tr>
<tr><td>Bananas</td><td><input type="text" name="bananas" size="2"></td></tr>
</table>
<input type="submit" value="Click to add to cart">
</form>
<br>
<?php
// Proses penambahan kuantitas (akumulasi)
if (isset($_POST['apples'])) {
    if (is_numeric($_POST['apples'])) {
        $qty = (int)$_POST['apples'];
        if ($qty > 0) {
            if (!isset($_SESSION['cart']['apples'])) {
                $_SESSION['cart']['apples'] = 0;
            }
            $_SESSION['cart']['apples'] += $qty;
        }
    } elseif ($_POST['apples'] == "Remove") {
        // Tombol Remove mengurangi kuantitas apples
        if (isset($_SESSION['cart']['apples'])) {
            $_SESSION['cart']['apples']--;
            if ($_SESSION['cart']['apples'] <= 0) {
                unset($_SESSION['cart']['apples']);
            }
        }
    }
}

if (isset($_POST['bananas'])) {
    if (is_numeric($_POST['bananas'])) {
        $qty = (int)$_POST['bananas'];
        if ($qty > 0) {
            if (!isset($_SESSION['cart']['bananas'])) {
                $_SESSION['cart']['bananas'] = 0;
            }
            $_SESSION['cart']['bananas'] += $qty;
        }
    } elseif ($_POST['bananas'] == "Remove") {
        // Tombol Remove mengurangi kuantitas bananas
        if (isset($_SESSION['cart']['bananas'])) {
            $_SESSION['cart']['bananas']--;
            if ($_SESSION['cart']['bananas'] <= 0) {
                unset($_SESSION['cart']['bananas']);
            }
        }
    }
}
?>
<fieldset style="width:300px">
<legend>Your Shopping Cart</legend>
<?php
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    echo "Your shopping cart is empty\n";
} else {
    echo "<form action=\"latihan-week08-5.php\" method=\"post\">\n";
    echo "<table>\n";
    echo "<tr><th>Item</th><th>Quantity</th><th>Action</th></tr>\n";
    foreach($_SESSION['cart'] as $key => $value) {
        echo "<tr><td>$key</td><td>$value</td>\n";
        echo "<td><input type=\"submit\" name=\"$key\" value=\"Remove\"></td></tr>\n";
    }
    echo "</table>\n";
    echo "</form>\n";
}
?>
</fieldset>
</body>
</html>