<?php
if (!empty($_POST["nomUtilisateur"]) && !empty($_POST["motDePasseUtilisateur"]) && !empty($_POST["motDePasseUtilisateur2"]) && !empty($_POST["adresseElectronique"]) && !empty($_POST["adresseElectronique2"]) && isset($_POST["nom"]) && !empty($_POST["adresse"])) {
    include "VerificationInscription.php";
    $message = VerificationInscription::startVerification($_POST["nomUtilisateur"], $_POST["adresseElectronique"], $_POST["adresseElectronique2"], $_POST["motDePasseUtilisateur"], $_POST["motDePasseUtilisateur2"], $_POST["nom"], $_POST["adresse"]);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>All4Sport-Inscription</title>
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
                        <label>Nom utilisateur</label><input type="text" name="nomUtilisateur">
                        <br>
                        <label>Nom</label><input type="text" name="nom">
                        <br>
                        <label>Adresse</label><input type="text" name="adresse">
                        <br>
                        <label>E-mail</label><input type="email" name="adresseElectronique">
                        <br>
                        <label>Confirmez votre E-mail</label><input type="email" name="adresseElectronique2">
                        <br>
                        <label>Mot de passe</label><input type="password" name="motDePasseUtilisateur">
                        <br>
                        <label>Confirmez votre mot de passe</label><input type="password" name="motDePasseUtilisateur2">
                        <br><br>
                        <input type="submit" value="Inscription" location="">
                    </div>
                    <br>
                    <div class="form-actions">
                        <a class="btn btn-primary" href="connexion.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    </form>
</body>

</html>