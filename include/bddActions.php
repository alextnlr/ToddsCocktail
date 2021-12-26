<?php
function addCompte($login, $mdp, $nom, $prenom, $sexe, $mail, $dateNaissance, $id_adresse, $tel) {
    $conn = connectDb();

    mysqli_query($conn, "INSERT INTO comptes(login, mdp, nom, prenom, sexe, mail, dateNaissance, id_adresse, tel) VALUES('$login', '$mdp', '$nom', '$prenom', '$sexe', '$mail', '$dateNaissance', '$id_adresse', '$tel')");
}

function checkCompte($login) {
    $conn = connectDb();

    $trouve = false;
    if (mysqli_query($conn, "SELECT 1 FROM comptes WHERE login = '$login'")->fetch_row() != null) {
        $trouve = true;
    }
    return $trouve;
}

function tryConnexion($login, $mdp) {
    $conn = connectDb();

    $result = mysqli_query($conn, "SELECT mdp FROM comptes WHERE login = '$login'");
    $row = mysqli_fetch_assoc($result);

    return password_verify($mdp, $row["mdp"]);
}

//Fonction qui renvoie une liste complete des mots clé en fonction de la hierarchie
function getHierarchyKey($keywords) {
    $n = 0;
    $conn = connectDb();
    while(count($keywords) != $n) { //Boucle tant que la taille du tableau est la meme qu'a la derniere iteration
        $n = count($keywords);
        for ($i = 0; $i < $n; $i++) { //Parcoure de tous les mots
            $word = mysqli_real_escape_string($conn, $keywords[$i]);
            //Récuperation des sous categories
            $result = mysqli_query($conn, "SELECT c2.nom_category FROM categories c2 WHERE c2.id_category IN (SELECT cr.id_category FROM category_rel cr, categories c WHERE cr.pid_category = c.id_category AND c.nom_category LIKE '%".$word."%');");
            while ($name = $result->fetch_row()) {
                if (!in_array($name[0], $keywords)) { //Check si le mot est déjà présent
                    $keywords[] = $name[0]; //Ajout dans le tableau
                }
            }
        }
    }
    return $keywords;
}

function connectDb() {
    $servername = 'mysql-toddscocktail.alwaysdata.net';
    $username = '251063';
    $password = 'BlegTotoTata';
    $database = 'toddscocktail_boissons';
    return mysqli_connect($servername, $username, $password, $database);
}