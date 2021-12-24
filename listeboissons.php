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

<ul>
    <?php
    $conn = connectDb();
    if (isset($_GET['k']) && $_GET['k']) {
        $k = trim($_GET['k']);
        $keywords = explode(' ', $k);

        $queryRequest = "SELECT r.titre FROM recettes r, ingredients i WHERE r.id_recette = i.id_recette AND ";
        foreach ($keywords as $word) {
            $queryRequest .= " i.nom_ingredient LIKE '%".$word."%' OR ";
        }
        $queryRequest = substr($queryRequest, 0, strlen($queryRequest) - 3);

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
</body>
</html>