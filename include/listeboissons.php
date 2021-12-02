<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BlegCocktail - Liste</title>
</head>
<body>
<?php
    include('header.php');
    $Recettes = null;
    require('../Donnees.inc.php');
    echo($Recettes[1]["titre"]);
?>
</body>
</html>