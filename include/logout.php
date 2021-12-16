<?php
// Initialiser la session
session_start();

// Détruire la session.
if(session_destroy())
{
    session_unset();
    // Redirection vers la page de connexion
    header("Location: ../index.php");
}
?>