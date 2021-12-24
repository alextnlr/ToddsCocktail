<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../cssmain.css"/>
</head>
<body>
<div id="container">

    <ul>
    <form action="verifRegister.php" method="POST">
        <h1>Création de compte</h1>

        <li><label><b>Nom d'utilisateur : </b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required></li>

        <li><label><b>Mot de passe : </b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required></li>

        <li><label>Nom de Famille : </label>
            <input type="text" placeholder="Entrer le nom de famille" name="surname" required></li>

        <li><label>Prénom : </label>
            <input type="text" placeholder="Entrer prenom" name="name" required></li>

        <li><label>Genre : </label>
        <select name="genre">
            <option value="homme">Homme</option>
            <option selected></option>
            <option value="femme">Femme</option>
            <option value="autre">Autre</option>
        </select>
        </li>

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