
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BlegCocktail - Liste</title>
</head>
<body>
<?php
    include('header.php');
    $Recettes = null;
    require('../Donnees.inc.php');
    require('bddActions.php');
?>
<ul>
    <?php
    $database = 'toddscocktail_boissons';

    $conn = connectDb();
    $connBd = mysqli_select_db($conn, $database);

    //Récupération des ingrédients racines
    $niveau_1_query = mysqli_query($conn, "SELECT DISTINCT h.ingredient FROM hierarchy h WHERE h.ingredient NOT IN (SELECT h.sous_categorie FROM hierarchy h)");
    $niveau_1 = array();
    $i = 0;
    while ($result = $niveau_1_query->fetch_row()){
        $niveau_1[$i] = $result[0];
        $i++;
    }

    $stmt = $conn->prepare("SELECT DISTINCT h.sous_categorie FROM hierarchy h WHERE h.ingredient =?");
    $stmt->bind_param("s", $niveau_1[0]);
    $stmt->execute();
    $query = $stmt->get_result();
    while ($result = $query->fetch_row()){
        printf("%s, \n", $result[0]);
    }

    for ($i = 0; $i<count($niveau_1); $i++){
        echo $niveau_1[$i];
    }


    ?>
</ul>
</body>
</html>
