<?php
include 'bddActions.php';

if (isset($_POST['username']) && isset($_POST['password']))
{
    if (!checkCompte($_POST['username'])) {
        addCompte($_POST['username'], password_hash($_POST['password'], PASSWORD_BCRYPT), $_POST['surname'], $_POST['name'], $_POST['genre'], $_POST['mail'], $_POST['birthdate'], $_POST['address'], $_POST['tel']);
        header('Location: login.php?result=1');
    } else {
        header('Location: register.php?erreur=2');
    }
}
else
{
    header('Location: register.php?erreur=1');
}