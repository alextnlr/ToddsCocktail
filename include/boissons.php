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

$nom = str_replace('_', ' ', $_GET['nom']);


//On établit la connexion
$conn = new mysqli($servername, $username, $password);

//On vérifie la connexion
if($conn->connect_error){
    die('Erreur : ' .$conn->connect_error);
}

$connBd = mysqli_select_db($conn, $database);


$stmt = $conn->prepare("SELECT ingredients, preparation FROM recettes WHERE titre=?"); //Préparation de la requête préparée
$stmt->bind_param("s", $nom); // passage du paramètre
$stmt->execute(); //Execution de la requête
$result = $stmt->get_result()->fetch_row(); // récupération du résultat

printf("%s, %s\n", $result[0], $result[1]);

?>
</body>
</html>