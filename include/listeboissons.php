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
?>

<ul>
    <?php
    for ($i = 0; $i < count($Recettes); $i++){
        echo ("<li>".$Recettes[$i]["titre"]."</li>");
    }
    ?>
</ul>
</body>
</html>