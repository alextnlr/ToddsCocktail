<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BlegCocktail - Accueil</title>
</head>
<body>
<?php include('include/header.php'); ?>
<?php
session_start();
if($_SESSION['username'] !== ""){
    $user = $_SESSION['username'];
    // afficher un message
    echo "Bonjour $user, vous êtes connecté";
}
?>
</body>
</html>