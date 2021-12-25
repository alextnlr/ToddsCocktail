<?php
require("bddActions.php");
session_start();
if ($_SESSION['username'] != "") {
    $user = $_SESSION['username'];
    $conn = connectDb();
    $recette = str_replace('_', ' ', $_GET['nom']);
    $queryID = mysqli_query($conn, "SELECT id_recette FROM recettes WHERE recettes.titre='$recette'");
    $id = $queryID->fetch_row();
    echo $id[0];
    mysqli_query($conn, "DELETE FROM panier WHERE id_recette='$id[0]' AND login='$user'");
    header('Location: ../favorite.php');
}

header('Location: ../favorite.php');