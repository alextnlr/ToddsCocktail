<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Header</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="cssmain.css"/>
</head>

<body>
<div class="menu">
    <a class="active" href="index.php">Accueil</a>
    <a href="listeboissons.php">Liste des Boissons</a>
    <a href="listeingredients.php">Liste des Ingrédients</a>
    <div class="compteGestionnaire">
<?php
session_start();
if ($_SESSION['username'] != "") {
    $user = $_SESSION['username'];
    echo "<a href='include/logout.php'> Déconnexion </a>";
}else {
    echo "<a href='include/login.php'> Connexion </a>";
    echo "<a href='include/register.php'> Créer un compte </a>";
}
?>
    </div>
</div>
<br>
</body>

</html>