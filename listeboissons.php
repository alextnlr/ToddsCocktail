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

<main>
<?php
    $Recettes = null;
    require('Donnees.inc.php');
    require('include/bddActions.php')
?>

<form action="" method="get" name="searchbar">
    <table class="searchArea">
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
        $queryRequest = "SELECT DISTINCT titre FROM recettes LEFT JOIN ingredients i on recettes.id_recette = i.id_recette";
        foreach ($keywords as $word) {
            //Recherche de chaque mots cle dans le titre ou les ingredients
            $queryRequest .= " nom_ingredient LIKE '%".$word."%' OR titre LIKE '%".$word."%' OR ";
        }
        //Supression du dernier OR
        $queryRequest = substr($queryRequest, 0, strlen($queryRequest) - 3);

        //Requete et affichage
        $query = mysqli_query($conn, $queryRequest);
        if ($query->num_rows > 0) {
            echo '<div> <b><u>'.$query->num_rows.'</u></b> résultats trouvés </div> <br/>';
            echo '<table class="search">';
            while ($result = $query->fetch_row()) {
                $changenom = str_replace(' ', '_', $result[0]);
                echo '<tr> <td> <a href="boissons.php?nom='.$changenom.'">'.$result[0].'</a></td>
                    <td> <form action="include/addtofavorite.php?nom='.$changenom.'" method="post"><input class="panier" type="submit">Ajouter au panier</input> </form></td> </tr>';
            }
            echo '</table>';
        } else {
            echo "Aucun résultat trouvé";
        }
        $query->close();
    } else {
        $query = mysqli_query($conn, "SELECT titre FROM recettes");
        echo '<table class="search">';
        while ($result = $query->fetch_row()) {
            $changenom = str_replace(' ', '_', $result[0]);
            echo '<tr> <td> <a href="boissons.php?nom='.$changenom.'">'.$result[0].'</a></td>
                    <td> <form action="include/addtofavorite.php?nom='.$changenom.'" method="post"><button class="panier" type="submit">Ajouter au panier</button> </form></td> </tr>';
        }
        echo '</table>';
    }

    ?>
</ul>
</div>
</main>
</body>
</html>