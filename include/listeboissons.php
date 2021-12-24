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
    require('bddActions.php')
?>

<ul>
    <?php

    $database = 'toddscocktail_boissons';
    $conn = connectDb();
    $connBd = mysqli_select_db($conn, $database);

    $query = mysqli_query($conn, "SELECT titre FROM recettes");
    while ($result = $query->fetch_row()){
        $changenom = str_replace(' ', '_', $result[0]);
        echo "<a href="."boissons.php"."?nom=".$changenom."> <li>".$result[0]."</li></a>";
    }

    ?>
</ul>
</body>
</html>