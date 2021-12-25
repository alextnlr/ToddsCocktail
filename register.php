<html>
<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link type="text/css" rel="stylesheet" href="cssmain.css"/>
</head>
<body>
<header>
    <?php include "header.php" ?>
</header>
<div class="container">
    <a href="index.php">Retour à l'accueil</a>

    <ul>
    <form action="include/verifRegister.php" method="POST">
        <h1>Création de compte</h1>

        <li><label><b>Nom d'utilisateur : </b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required></li>

        <li><label><b>Mot de passe : </b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required></li>

        <li><label>Nom de Famille : </label>
            <input type="text" placeholder="Entrer le nom de famille" name="surname" ></li>

        <li><label>Prénom : </label>
            <input type="text" placeholder="Entrer prenom" name="name"></li>

        <li><label>Genre : </label>
        <select name="genre">
            <option selected disabled></option>
            <option value="homme">Homme</option>
            <option value="femme">Femme</option>
            <option value="autre">Autre</option>
        </select>
        </li>
        <li><label>Adresse e-mail :</label>
        <input type="email" placeholder="Entrer email" name="mail"></li>

        <li><label>Date de Naissance</label> <input type="date" name="birthdate"></li>
        <li><label>Adresse et Ville: </label> <input type="text" placeholder="Adresse " name="address"></li>
        <li><label>Numéro de Téléphone : </label><input type="tel" name="tel"></li>


        <li><input type="submit" id='submit' value='REGISTER' ></li>

        <?php
        if(isset($_GET['erreur'])){
            $err = $_GET['erreur'];
            if($err==2)
                echo "<p style='color:red'>Le nom d'utilisateur existe dèjà</p>";
            else if($err == 1) {
                echo "<p style='color:red'>Nom d'utilisateur et mot de passe nécessaire</p>";
            }
        }

        // A supprimer plus tard, sert juste de test
        if(isset($_GET['result']) && $_GET['result'] == 1){
            echo "<p> Compte créé </p>";
        }
        ?>
    </form>
    </ul>
</div>
</body>
</html>