<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BlegCocktail - Liste</title>
</head>
<body>
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
$nom = str_replace('_', ' ', $_GET['nom']);
echo $nom;
$aled = mysqli_query($conn, "SELECT 1 FROM recettes WHERE  = ".$nom);
?>
</body>
</html>