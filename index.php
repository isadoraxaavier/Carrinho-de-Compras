<?php
require 'Cart.php';
require 'Product.php';
session_start();

$products = [
    1 => ['id' => 1, 'name' => 'geladeira', 'price' => 1000, 'quantity' => 1],
    2 => ['id' => 2, 'name' => 'mouse', 'price' => 100, 'quantity' => 1],
    3 => ['id' => 3, 'name' => 'teclado', 'price' => 350, 'quantity' => 1],
    4 => ['id' => 4, 'name' => 'monitor', 'price' => 12000, 'quantity' => 1],
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [
        "products" => [],
        'total' => 0
    ];
}

$cart = new Cart;

if (isset($_GET['add'])) {
    $id = strip_tags($_GET['id']);
    $productInfo = $products[$id];
    $product = new Product;
    $product->setId($productInfo['id']);
    $product->setName($productInfo['name']);
    $product->setPrice($productInfo['price']);
    $product->setQuantity($productInfo['quantity']);

    $cart->add($product);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <ul>
        <li>Geladeira <a href="?add&id=1" class="button">Add</a> R$ 1000</li>
        <li>Mouse <a href="?add&id=2" class="button">Add</a> R$ 100</li>
        <li>Teclado <a href="?add&id=3" class="button">Add</a> R$ 350</li>
        <li>Monitor <a href="?add&id=4" class="button">Add</a> R$ 12000</li>
    </ul>

    <h2>Carrinho de Compras</h2>
    <?php if (!empty($cart->getCart())): ?>
        <ul>
            <?php foreach ($cart->getCart() as $product): ?>
                <li><?php echo $product->getName(); ?> - R$ <?php echo $product->getPrice(); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>O carrinho está vazio.</p>
    <?php endif; ?>

    <p>Total: R$ <?php echo $_SESSION['cart']['total'] ?? 0; ?></p>
</body>
</html>