<?php
$hello = 'there';
$name = isset($_GET['who']) ? htmlspecialchars($_GET['who']) : 'Qui es tu?';

class Product
{
    public function __construct(
        public string $title,
        public string $color,
        public int $price, // prix est en centimes!!
        public string $imageUrl // j'ajoute mes images 
    ) {}
}

$productCollection = [
    new Product('Perfecto cuir', 'noir', 20000, 'images/perfecto.jpg'),
    new Product('Kway nylon', 'bleu marine', 12000, 'images/kway.jpg'),
    new Product('Doudoune fourrure', 'taupe', 80000, 'images/doudoune.jpg'),
];

// récupérer ID depuis URL 
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$product = null; // variable produit 

// si - ID, vérifier si produit existe
if (!is_null($id)) {
    if (!isset($productCollection[$id])) {
        header("HTTP/1.1 404 Not Found");
        header("Location: /404.html");
        exit();
    }
    $product = $productCollection[$id];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Hello <?= $hello ?></title>
</head>

<body>

    <h1>Hello! <?= $name ?></h1>

    <section>
        <ul>
            <li><a href="main.php?who=Anne">Anne</a></li>
            <li><a href="main.php?who=Eva">Eva</a></li>
        </ul>
    </section>

    <?php if (!empty($product)): ?>
        <section>
            <h2><?= $product->title ?></h2>
            <img src="<?= $product->imageUrl ?>" alt="<?= $product->title ?>" width="300">
            <p>Couleur : <?= $product->color ?></p>
            <p>Prix : <?= number_format($product->price / 100, 2, ',', ' ') ?> €</p>
        </section>
    <?php endif; ?>
    <!-- Liste des produits avec liens -->
    <section>
        <h3>Liste des produits</h3>
        <ul>
            <?php foreach ($productCollection as $index => $p): ?>
                <li><a href="main.php?id=<?= $index ?>"><?= $p->title ?></a></li>
            <?php endforeach; ?>
        </ul>
    </section>