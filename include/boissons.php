<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BlegCocktail - Liste</title>
</head>
<body>
<?php
require "bddActions.php";
$database = 'toddscocktail_boissons';

$nom = str_replace('_', ' ', $_GET['nom']);

if (file_exists("../images/".$_GET['nom'].".jpg")){
    echo "<img  src=../images/".$_GET['nom'].".jpg>";
}

//On établit la connexion
$conn = connectDb();

//On vérifie la connexion
if($conn->connect_error){
    die('Erreur : ' .$conn->connect_error);
}

$connBd = mysqli_select_db($conn, $database);


$stmt = $conn->prepare("SELECT ingredients, preparation FROM recettes WHERE titre=?"); //Préparation de la requête préparée
$stmt->bind_param("s", $nom); // passage du paramètre
$stmt->execute(); //Execution de la requête
$result = $stmt->get_result()->fetch_row(); // récupération du résultat


$ingredient = explode("|", $result[0]);
$preparation = explode(".", $result[1]);
?>
<p>Ingrédients nécessaires :</p>
<ul>
    <?php
    foreach($ingredient as $i){
        echo "<li>$i</li>";
    }
    ?>

</ul>

<p>Préparations :</p>
<ol>
    <?php
    echo $result[1];
    ?>

</ol>
</body>
</html>