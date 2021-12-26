<?php
require("bddActions.php");
session_start();
$conn = connectDb();
if ($_SESSION['username'] != "") {
    $user = $_SESSION['username'];
    $recette = str_replace('_', ' ', $_GET['nom']);
    $queryID = mysqli_query($conn, "SELECT id_recette FROM recettes WHERE recettes.titre='$recette'");
    $id = $queryID->fetch_row();
    echo $id[0];
    mysqli_query($conn, "DELETE FROM panier WHERE id_recette='$id[0]' AND login='$user'");
    header('Location: ../favorite.php');
}else{
    $recette = str_replace('_', ' ', $_GET['nom']);
    $queryID = mysqli_query($conn, "SELECT id_recette FROM recettes WHERE recettes.titre='$recette'");
    $id = $queryID->fetch_row();
    //On sépare au niveau d'où on trouve l'id et on remet dans la session
    $toRemove = "|".$id[0]."|";
    echo $toRemove;
    $val = explode($toRemove, $_SESSION['favorite']);
    $replace = $val[0]."|".$val[1];
    echo $replace;
    $_SESSION['favorite']=$replace;
}

header('Location: ../favorite.php');