<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BlegCocktail - Accueil</title>
</head>
<body>
<?php
include('header.php'); ?>

<?php
session_start();
if ($_SESSION['username'] != "") {
    $user = $_SESSION['username'];
    // afficher un message
    echo "Bonjour $user, vous êtes connecté";
    echo "<a href='include/logout.php'> Déconnexion </a>";
}else{
    echo "<a href='include/login.php'> Connexion </a>";
    echo ' ou ';
    echo "<a href='include/register.php'> Créer un compte </a>";
}
?>

</body>
</html>