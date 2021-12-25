<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Header</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="cssmain.css"/>
</head>

<body>
<div class="menu">
    <a class="btn active" href="index.php">Accueil</a>
    <a class="btn" href="listeboissons.php">Liste des Boissons</a>
    <a class="btn" href="listeingredients.php">Liste des Ingrédients</a>
    <div class="compteGestionnaire">
<?php
session_start();
if ($_SESSION['username'] != "") {
    $user = $_SESSION['username'];
    echo "<a class='btn' href='include/logout.php'> Déconnexion </a>";
}else {
    echo "<a class='btn' href='login.php'> Connexion </a>";
    echo "<a class='btn' href='register.php'> Créer un compte </a>";
}
?>
    </div>
</div>

</body>

</html>