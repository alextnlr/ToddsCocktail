<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<div class="menu">
<ul>
    <li> <a href="index.php">Accueil</a></li>
    <li><a href="listeboissons.php">Liste des Boissons</a></li>
    <li><a href="include/listeingredients.php">Liste des Ingrédients</a></li>
<?php
session_start();
if ($_SESSION['username'] != "") {
    $user = $_SESSION['username'];
    // afficher un message
    echo "Bonjour $user, vous êtes connecté";
    echo "<li><a href='include/logout.php'> Déconnexion </a></li>";
}else{
    echo "<li><a href='include/login.php'> Connexion </a></li>";
    echo "<li><a href='include/register.php'> Créer un compte </a></li>";
}
?>
</ul>
</div>
<br>
</body>
</html>