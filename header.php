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
    <a href="include/listeingredients.php">Liste des Ingrédients</a>
<?php
session_start();
if ($_SESSION['username'] != "") {
    $user = $_SESSION['username'];
    // afficher un message
    echo "Bonjour $user, vous êtes connecté";
    echo "<a href='include/logout.php'> Déconnexion </a>";
}else{
    echo "<a href='include/login.php'> Connexion </a>";
    echo "<a href='include/register.php'> Créer un compte </a>";
}
?>
</div>
<br>
</body>

</html>