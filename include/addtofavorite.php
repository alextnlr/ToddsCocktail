<?php
require("bddActions.php");
session_start();
$conn = connectDb();
$recette = str_replace('_', ' ', $_GET['nom']);
$queryID = mysqli_query($conn, "SELECT id_recette FROM recettes WHERE recettes.titre='$recette'");
$id = $queryID->fetch_row();
if ($_SESSION['username'] != "") {
    $user = $_SESSION['username'];
    echo $id[0];
    mysqli_query($conn, "INSERT INTO panier(login, id_recette) VALUES ('$user', '$id[0]')");
    header('Location: ../listeboissons.php');
} else{
    $current = $_SESSION['favorite'];
    if (strlen($current) == 0){
        $current = "|";
    }
    $test = "|".$id[0]."|";

    //Obligé de vérifier les types, pour éviter l'assimilation 0 = false
    if (gettype(strpos($current, $test)) == "boolean") {
        $current = $current.$id[0]."|";
        $_SESSION['favorite'] = $current;
    }

}

header('Location: ../listeboissons.php');