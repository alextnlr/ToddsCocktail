<!DOCTYPE html>
<html>
<head>
    <title>Cours PHP / MySQL</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="cours.css">
</head>
<body>
<h1>Bases de données MySQL</h1>
<?php
$servername = 'mysql-toddscocktail.alwaysdata.net';
$username = '251063';
$password = 'BlegTotoTata';
/*$servername = 'localhost';
$username = 'root';
$password = 'root';*/
$database = 'toddscocktail_boissons';

//On établit la connexion
$conn = new mysqli($servername, $username, $password);

//On vérifie la connexion
if($conn->connect_error){
    die('Erreur : ' .$conn->connect_error);
}

$connBd = mysqli_select_db($conn, $database);

if (!$connBd) {
    mysqli_query($conn, "CREATE DATABASE toddscocktail_boissons");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.recettes (id_recette INT PRIMARY KEY, titre TEXT, ingredients TEXT, preparation TEXT);");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.ingredients (id_recette INT, id_ingredient INT, nom_ingredient TEXT, PRIMARY KEY (id_recette, id_ingredient), FOREIGN KEY(id_recette) REFERENCES recettes(id_recette));");

    $Recettes = null;
    require('Donnees.inc.php');

    for ($i = 0; $i < count($Recettes); $i++){
        $id = $i;
        $aled = mysqli_query($conn, "SELECT 1 FROM recettes WHERE id_recette = ".$id);
        if ($aled->fetch_row() == null) {
            $titre = mysqli_real_escape_string($conn, $Recettes[$id]['titre']);
            $ingredients = mysqli_real_escape_string($conn, $Recettes[$id]['ingredients']);
            $preparation = mysqli_real_escape_string($conn, $Recettes[$id]['preparation']);
            mysqli_query($conn, "INSERT INTO recettes(id_recette, titre, ingredients, preparation) VALUES ('$id', '$titre', '$ingredients', '$preparation')");
        }
        for ($j = 0; $j < count($Recettes[$i]['index']); $j++) {
            if (mysqli_query($conn, "SELECT 1 FROM ingredients WHERE id_recette = '$id' AND id_ingredient = '$j'")->fetch_row() == null) {
                $nom = mysqli_real_escape_string($conn, $Recettes[$i]['index'][$j]);
                mysqli_query($conn, "INSERT INTO ingredients(id_recette, id_ingredient, nom_ingredient) VALUES ('$i', '$j', '$nom')");
            }
        }
    }
}

}
?>
</body>
</html>