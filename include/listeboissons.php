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
        $nom = $Recettes[$i]["titre"];

        //Remplacement des espaces par des underscores pour pouvoir les passer en paramètres
        $changenom = str_replace(' ', '_', $nom);
        echo "<a href="."boissons.php"."?nom=".$changenom."> <li>".$nom."</li></a>";
    }
    ?>
</ul>
</body>
</html>