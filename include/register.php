<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../cssmain.css" media="screen" type="text/css" />
</head>
<body>
<div id="container">

    <form action="verifRegister.php" method="POST">
        <h1>Création de compte</h1>

        <label><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <input type="submit" id='submit' value='REGISTER' >

        <?php
        if(isset($_GET['erreur'])){
            $err = $_GET['erreur'];
            if($err==2)
                echo "<p style='color:red'>Le nom d'utilisateur existe dèjà</p>";
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