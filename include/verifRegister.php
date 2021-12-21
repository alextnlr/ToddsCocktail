<?php
require("../install.php");

if (isset($_POST['username']) && isset($_POST['password']))
{
    if (!checkCompte($_POST['username'])) {
        addCompte($_POST['username'], $_POST['password']);
        header('Location: register.php?result=1');
    } else {
        header('Location: register.php?erreur=2');
    }
}