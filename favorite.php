<?php
echo "bleg";
require("include/bddActions.php");
$conn = connectDb();
session_start();
$user = $_SESSION['username'];
$query = mysqli_query($conn, "SELECT id_recette FROM panier WHERE login='$user'");
while ($result = $query->fetch_row()){
    echo $result[0];
}