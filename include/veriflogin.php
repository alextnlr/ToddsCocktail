<?php
include 'bddActions.php';
session_start();

// Test si username et password est complété
if (isset($_POST['username']) && isset($_POST['password'])) {
    if (checkCompte($_POST['username'])) {
        if (tryConnexion($_POST['username'], $_POST['password'])) {
            $_SESSION['username'] = $_POST['username'];
            header('Location: ../index.php');
        } else {
            header('Location: login.php?erreur=2');
        }
    } else{
        header('Location: login.php?erreur=1');
    }
}