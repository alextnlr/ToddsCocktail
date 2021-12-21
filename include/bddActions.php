<?php
function addCompte($login, $mdp) {
    $conn = connectDb();

    mysqli_query($conn, "INSERT INTO comptes(login, mdp) VALUES('$login', '$mdp')");
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

function connectDb() {
    $servername = 'mysql-toddscocktail.alwaysdata.net';
    $username = '251063';
    $password = 'BlegTotoTata';
    $database = 'toddscocktail_boissons';
    return mysqli_connect($servername, $username, $password, $database);
}