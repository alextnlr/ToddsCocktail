<?php
include 'bddActions.php';

if (isset($_POST['username']) && isset($_POST['password']))
{
    if (!checkCompte($_POST['username'])) {
        addCompte($_POST['username'], password_hash($_POST['password'], PASSWORD_BCRYPT));
        header('Location: login.php?result=1');
    } else {
        header('Location: register.php?erreur=2');
    }
}
else
{
    header('Location: register.php?erreur=1');
}