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

    /// Création de toutes les tables
    // Gestion des recette
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.recettes (id_recette INT PRIMARY KEY, titre TEXT, ingredients TEXT, preparation TEXT);");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.ingredients (id_recette INT, id_ingredient INT, nom_ingredient TEXT, PRIMARY KEY (id_recette, id_ingredient), FOREIGN KEY(id_recette) REFERENCES recettes(id_recette));");
    // Gestion des comptes
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.adressePostale (id_adresse INT PRIMARY KEY, adresse TEXT NOT NULL, codePostal NUMBER(5) NOT NULL, ville TEXT NOT NULL)");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.comptes (login TEXT PRIMARY KEY, mdp TEXT NOT NULL, nom TEXT, prenom TEXT, nom TEXT, sexe NUMBER(1), mail TEXT, dateNaissance TEXT, id_adresse INT, tel NUMBER(10))");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS toddscocktail_boissons.panier(login VARCHAR(150), id_recette INT, PRIMARY KEY (login, id_recette), FOREIGN KEY (login) REFERENCES comptes(login), FOREIGN KEY (id_recette) REFERENCES recettes(id_recette));");
    //Gestion de la hierarchie
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS categories (id_category INT NOT NULL PRIMARY KEY, nom_category TEXT NOT NULL);");
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS category_rel (id_category INT NOT NULL, pid_category INT NOT NULL, PRIMARY KEY (id_category, pid_category), FOREIGN KEY (id_category) REFERENCES categories (id_category), FOREIGN KEY (pid_category) REFERENCES categories (id_category));");

    //Remplissage des recettes et ingredients
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

    //Remplissage des categories
    $HierarKey = array_keys($Hierarchie);
    for ($i = 0; $i < count($HierarKey); $i++) {
        $nom = mysqli_real_escape_string($conn, $HierarKey[$i]);
        if (mysqli_query($conn, "SELECT 1 FROM categories WHERE nom_category = '$nom'")->num_rows == 0) {
            mysqli_query($conn, "INSERT INTO categories(id_category, nom_category) VALUES ('$i', '$nom')");
        }
    }

    //Remplissage des liens entre categories (super categories)
    foreach ($Hierarchie as $value1) {
        foreach ($value1['super-categorie'] as $value) {
            $i = array_search(array_search($value1, $Hierarchie), $HierarKey);
            $pi = array_search($value, $HierarKey);
            if (mysqli_query($conn, "SELECT 1 FROM category_rel WHERE id_category = '$i' AND pid_category = '$pi'")->num_rows == 0) {
                mysqli_query($conn, "INSERT INTO category_rel(id_category, pid_category) VALUES ('$i', '$pi')");
                echo $conn->error;
            }
        }
    }

}

