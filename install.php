<?php
$servername = 'mysql-toddscocktail.alwaysdata.net';
$username = '251063';
$password = 'BlegTotoTata';
$database = 'toddscocktail_boissons';

//On établit la connexion
$conn = new mysqli($servername, $username, $password);

//On vérifie la connexion
if($conn->connect_error){
    die('Erreur : ' .$conn->connect_error);
}

$connBd = mysqli_select_db($conn, $database);

$Hierarchie = null;
$Recettes = null;
include 'Donnees.inc.php';

if (!$connBd) {
    mysqli_query($conn, "CREATE DATABASE toddscocktail_boissons");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.recettes (id_recette INT PRIMARY KEY, titre TEXT, ingredients TEXT, preparation TEXT);");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.ingredients (id_recette INT, id_ingredient INT, nom_ingredient TEXT, PRIMARY KEY (id_recette, id_ingredient), FOREIGN KEY(id_recette) REFERENCES recettes(id_recette));");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.adressePostale (id_adresse INT PRIMARY KEY, adresse TEXT NOT NULL, codePostal NUMBER(5) NOT NULL, ville TEXT NOT NULL)");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.comptes (login TEXT PRIMARY KEY, mdp TEXT NOT NULL, nom TEXT, prenom TEXT, nom TEXT, sexe NUMBER(1), mail TEXT, dateNaissance TEXT, id_adresse INT, tel NUMBER(10))");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.hierarchy (ingredient VARCHAR(50), sous_categorie VARCHAR(50), PRIMARY KEY (ingredient, sous_categorie));");

    for ($i = 0; $i < count($Recettes); $i++){
        $id = $i;
        $aled = mysqli_query($conn, "SELECT 1 FROM recettes WHERE id_recette = ".$id);
        if ($aled->fetch_row() == null) {
            $titre = mysqli_real_escape_string($conn, $Recettes[$id]['titre']);
            $ingredients = mysqli_real_escape_string($conn, $Recettes[$id]['ingredients']);
            $preparation = mysqli_real_escape_string($conn, $Recettes[$id]['preparation']);
            mysqli_query($conn, "INSERT INTO recettes(id_recette, titre, ingredients, preparation) VALUES ('$id', '$titre', '$ingredients', '$preparation')");
        }
        for ($j = 0; $j < count($Recettes[$i]['index']); $j++) {
            if (mysqli_query($conn, "SELECT 1 FROM ingredients WHERE id_recette = '$id' AND id_ingredient = '$j'")->fetch_row() == null) {
                $nom = mysqli_real_escape_string($conn, $Recettes[$i]['index'][$j]);
                mysqli_query($conn, "INSERT INTO ingredients(id_recette, id_ingredient, nom_ingredient) VALUES ('$i', '$j', '$nom')");
            }
        }
    }

    $HierarKey = array_keys($Hierarchie);
    for ($i = 0; $i < count($Hierarchie); $i++) {
        foreach ($Hierarchie[$HierarKey[$i]]['sous-categorie'] as &$value) {
            if (mysqli_query($conn, "SELECT 1 FROM toddscocktail_boissons.hierarchy WHERE ingredient = '$HierarKey[$i]' AND sous_categorie = '$value'")->fetch_row() == null) {
                mysqli_query($conn, "INSERT INTO toddscocktail_boissons.hierarchy(ingredient, sous_categorie) VALUES ('$HierarKey[$i]', '$value')");
            }
        }

        foreach ($Hierarchie[$HierarKey[$i]]['super-categorie'] as &$value) {
            if (mysqli_query($conn, "SELECT 1 FROM toddscocktail_boissons.hierarchy WHERE ingredient = '$value' AND sous_categorie = '$HierarKey[$i]'")->fetch_row() == null) {
                mysqli_query($conn, "INSERT INTO toddscocktail_boissons.hierarchy(ingredient, sous_categorie) VALUES ('$value', '$HierarKey[$i]')");
            }
        }

        unset($value);
    }
}
