<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>BlegCocktail - Liste</title>

</head>
<body>

<header>
    <?php include('header.php');?>
</header>

<?php
echo "bleg";
require("include/bddActions.php");

session_start();
$favorite = array(); // Array des ID des favoris

// Récupération des ID si la personne est connectée
$conn = connectDb();
if ($_SESSION['username']) {
    $user = $_SESSION['username'];
    $query = mysqli_query($conn, "SELECT id_recette FROM panier WHERE login='$user'");
    $i = 0;
    while ($id = $query->fetch_row()) {
        $favorite[$i] = $id[0];
        $i++;
    }
} else{ //Si personne n'est identifiée

}
echo "<ul>";
for ($i = 0; $i<sizeof($favorite); $i++){
    $currentId = mysqli_query($conn, "SELECT r.titre FROM recettes r, panier p WHERE p.id_recette=r.id_recette AND p.id_recette='$favorite[$i]'");
    echo "<li>".$currentId->fetch_row()[0]."</li>";
}
echo "</ul>";
?>
</body>
</html>
