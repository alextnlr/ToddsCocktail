<?php include('header.php');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>BlegCocktail - Liste</title>
    <link type="text/css" rel="stylesheet" href="cssmain.css">

</head>
<body>

<header>

</header>

<div class="favorite">
<?php
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
    echo "<table>";
    for ($i = 0; $i<sizeof($favorite); $i++){
        $currentId = mysqli_query($conn, "SELECT r.titre FROM recettes r, panier p WHERE p.id_recette=r.id_recette AND p.id_recette='$favorite[$i]'");
        $name = $currentId->fetch_row()[0];
        $replaceName = str_replace(' ', '_', $name);
        echo '<tr> <td> <a href="boissons.php?nom='.$replaceName.'">'.$name.'</a></td>
        <td><form action="include/rmtofavorite.php?nom='.$replaceName.'" method="post"><button class="panier" type="submit">Supprimer</button> </form></td></tr>';
    }
} else{ //Si personne n'est identifiée
    echo $_SESSION['favorite']."</br>";
    $favorite = explode("|", $_SESSION['favorite']);
    echo "<table>";
    for ($i = 1; $i<sizeof($favorite); $i++){
        $currentId = mysqli_query($conn, "SELECT r.titre FROM recettes r WHERE id_recette='$favorite[$i]'");
        $name = $currentId->fetch_row()[0];
        $replaceName = str_replace(' ', '_', $name);
        echo '<tr> <td> <a href="boissons.php?nom='.$replaceName.'">'.$name.'</a></td>
        <td><form action="include/rmtofavorite.php?nom='.$replaceName.'" method="post"><button class="panier" type="submit">Supprimer</button> </form></td></tr>';
    }
}
echo "</table>";
?>
</div>
</body>
</html>
