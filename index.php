<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BlegCocktail - Accueil</title>
    <link rel="stylesheet" href="cssmain.css">
</head>
<body>
<header>
<?php
include('header.php'); ?>
</header>
<main>
<?php
if ($_SESSION['username'] != "") {

}else{
    echo "<h1> Bienvenue sur Todds Cocktail</h1>";
    echo "<p><a href='listeboissons.php'>Ici</a>, vous pourrez retrouvez une sélection de nos meilleurs recettes</p>";
    echo "<p>Vous pouvez également chercher des recettes par leurs ingrédients, en se rendant sur <a href='include/listeingredients.php'>cette page</a></p>";
}

?>
</main>
</body>
</html>