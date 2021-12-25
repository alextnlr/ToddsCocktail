<?php
/*http://www.codeurjava.com/2016/12/formulaire-de-login-avec-html-css-php-et-mysql.html
https://waytolearnx.com/2020/01/formulaire-dauthentification-login-mot-de-passe-avec-php-et-mysql.html
 */?>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="cssmain.css" media="screen" type="text/css" />
</head>
<body>
<header>
    <?php include "header.php" ?>
</header>
<div id="container">
    <!-- zone de connexion -->

    <form action="include/veriflogin.php" method="POST">
        <h1>Connexion</h1>

        <label><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <input type="submit" id='submit' value='LOGIN' >
        <?php
        if(isset($_GET['erreur'])){
            $err = $_GET['erreur'];
            if($err==1 || $err==2)
                echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
        }

        // A supprimer plus tard, sert juste de test
        if(isset($_GET['result']) && $_GET['result'] == 1){
            echo "<p> Compte créé </p>";
        }
        ?>
    </form>
</div>
</body>
</html>