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
} else {
    echo 'Connexion réussie'.'<br>';
}

$connBd = mysqli_select_db($conn, $database);

if (!$connBd) {
    if (mysqli_query($conn, "CREATE DATABASE toddscocktail_boissons")) {
        echo 'Base de donnees crée'.'<br>';
    } else {
        echo 'Erreur lors de la création bd'.'<br>';
    }
} else {
    echo "Connecté à la bd".'<br>';

    if (mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.recettes (id_recette INT PRIMARY KEY, titre TEXT, ingredients TEXT, preparation TEXT);")) {
        echo "recette ok".'<br>';
    } else {
        echo 'recette fail'.'<br>';
    }

    if (mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.ingredients (id_recette INT, id_ingredient INT, nom_ingredient TEXT, PRIMARY KEY (id_recette, id_ingredient), FOREIGN KEY(id_recette) REFERENCES recettes(id_recette));")) {
        echo "ingredient ok".'<br>';
    } else {
        echo 'ingredient fail'.'<br>';
    }
}

$Recettes = null;
require('Donnees.inc.php');

for ($i = 0; $i < count($Recettes); $i++){
    $id = $i;
    $aled = mysqli_query($conn, "SELECT 1 FROM toddscocktail_boissons.recettes WHERE id_recette = ".$id);
    if ($aled->fetch_row() == null) {
        $titre = mysqli_real_escape_string($conn, $Recettes[$id]['titre']);
        $ingredients = mysqli_real_escape_string($conn, $Recettes[$id]['ingredients']);
        $preparation = mysqli_real_escape_string($conn, $Recettes[$id]['preparation']);
        mysqli_query($conn, "INSERT INTO recettes(id_recette, titre, ingredients, preparation) VALUES ('$id', '$titre', '$ingredients', '$preparation')");
    }
}

$nomRecette = mysqli_query($conn, "SELECT titre FROM recettes;");
if ($nomRecette) {
    while ($row = mysqli_fetch_row($nomRecette)) {
        echo $row[0] . '<br>';
    }
} else {
    echo 'Erreur lors de la requete'.'<br>';
}
?>
</body>
</html>