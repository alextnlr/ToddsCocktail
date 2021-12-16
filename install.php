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
/*$servername = 'mysql-toddscocktail.alwaysdata.net';
$username = '251063';
$password = 'BlegTotoTata';*/
$servername = 'localhost';
$username = 'root';
$password = 'root';
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