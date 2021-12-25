<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BlegCocktail - Liste</title>
    <link type="text/css" rel="stylesheet" href="cssmain.css"/>
</head>
<body>
<header>
    <?php include 'header.php'?>
</header>
<main>
<?php
require "include/bddActions.php";
$database = 'toddscocktail_boissons';

$nom = str_replace('_', ' ', $_GET['nom']);

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
    <h1><?php echo $nom; ?></h1>
    <table class="ficheBoisson">
        <tr>
            <td>
                <p><b>Ingrédients nécessaires :</b></p>
                <ul>
                    <?php
                    foreach($ingredient as $i){
                        echo "<li>$i</li>";
                    }
                    ?>

                </ul>

                <p><b>Préparations :</b></p>
                <ol>
                    <?php
                    echo $result[1];
                    ?>
                </ol>
            </td>

            <td>
                <?php if (file_exists("images/".$_GET['nom'].".jpg")){
                    echo "<img  src=images/".$_GET['nom'].".jpg>";
                }?>
            </td>
        </tr>
    </table>


</main>
</body>
</html>