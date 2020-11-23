<?php
session_start();
if (isset($_POST["adresseElectronique"]) && isset($_POST["motDePasseUtilisateur"])) {
    include "../../BDD/Database.php";
    $connexion = Database::connect();
    $execution = $connexion->prepare("SELECT ut_id as ID FROM utilisateur WHERE ut_email=\"" . $_POST["adresseElectronique"] . "\" AND ut_mdp=\"" . $_POST["motDePasseUtilisateur"] . "\";");
    $execution->execute();
    $resultat = $execution->fetchall();
    $connexion = null;
    Database::disconnect();
    if (isset($resultat[0]["ID"])) {
        $_SESSION["ID"] = $resultat[0]["ID"];
        header("Location: ../pageClient/index.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>All4Sport-Connexion</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1 class="text-logo"><span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span></h1>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <br>
                <form method="POST" action="">
                    <div class="form-group">
                        <style>
                            label {
                                display: block;
                            }
                        </style>
                        <label>E-mail:</label><input type="text" name="adresseElectronique">
                        <br>
                        <label>Mot de passe:</label><input type="password" name="motDePasseUtilisateur">
                        <br><br>
                        <input type="submit" value="Connexion">
                    </div>
                </form>

                <br>
                <div class="form-actions">
                    <a class="btn btn-primary" href="../../ModuleA/index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    <a class="btn btn-warning" href="inscription.php"><span class="glyphicon glyphicon-envelope"></span> Inscription</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>