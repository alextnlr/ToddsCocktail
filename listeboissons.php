<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>BlegCocktail - Liste</title>

</head>
<body>
<?php
    include('header.php');
    $Recettes = null;
    require('Donnees.inc.php');
    require('include/bddActions.php')
?>

<br> <br> <br>
<form action="" method="get" name="">
    <table>
        <tr>
            <td><input type="text" name="k" placeholder="Search..." autocomplete="off"></td>
            <td><input type="submit" name="" value="Search"></td>
        </tr>
    </table>
</form>

<div class="listeboissons">
<ul>
    <?php
    $conn = connectDb();

    //S'il y a des choses dans la bar de recherche
    if (isset($_GET['k']) && $_GET['k']) {
        $k = trim($_GET['k']); //Enleve les double spaces
        $keywords = explode(' ', $k); //Separatiojn dans un tableau des mots cles

        //Debut de la requete avec jointure
        $queryRequest = "SELECT DISTINCT titre FROM recettes LEFT JOIN ingredients i on recettes.id_recette = i.id_recette WHERE ";
        foreach ($keywords as $word) {
            //Recherche de chaque mots cle dans le titre ou les ingredients
            $queryRequest .= " nom_ingredient LIKE '%".$word."%' OR titre LIKE '%".$word."%' OR ";
        }
        //Supression du dernier OR
        $queryRequest = substr($queryRequest, 0, strlen($queryRequest) - 3);

        //Requete et affichage
        $query = mysqli_query($conn, $queryRequest);
        while ($result = $query->fetch_row()) {
            $changenom = str_replace(' ', '_', $result[0]);
            echo "<a href=" . "boissons.php" . "?nom=" . $changenom . "> <li>" . $result[0] . "</li></a>";
        }
    } else {
        $query = mysqli_query($conn, "SELECT titre FROM recettes");
        while ($result = $query->fetch_row()) {
            $changenom = str_replace(' ', '_', $result[0]);
            echo "<a href=" . "boissons.php" . "?nom=" . $changenom . "> <li>" . $result[0] . "</li></a>";
        }
    }

    ?>
</ul>
</div>
</body>
</html>