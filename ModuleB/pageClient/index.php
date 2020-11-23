<!DOCTYPE html>
<html>

<head>
    <title>All4Sport-Espace Client</title>
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
                <h3><span>Page client</span></h3>
                <br>
                <?php
                session_start();
                if (isset($_SESSION["ID"])) {
                ?>
                    <a class="btn btn-warning" href="PageCommandesUtilisateur.php"><span class="glyphicon glyphicon-send"></span> Vos commandes</a><br><br>
                    <a class="btn btn-warning" href="../connexion/Deconnexion.php"><span class="glyphicon glyphicon-alert"></span> Se déconecter</a>
                <?php
                }
                ?>
                <br>
                <br>
                <div class="form-actions">
                    <a class="btn btn-primary" href="../../ModuleA/index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>
            </div>
        </div>
    </div>
</body>


</html>