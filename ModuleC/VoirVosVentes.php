<?php
session_start();
include "../BDD/database.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>All4Sport-Vos Ventes</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1 class="text-logo"><span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span></h1>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <h3><span>Page client</span></h3><br><br>
                <?php
                $connexion = Database::connect();
                $execution = $connexion->prepare("SELECT ve_id AS ID, pr_nom AS NomDuProduit, ve_quantite AS QuantiteDuProduit, ve_date AS DateDeCommencementDeCetteVente, sto_type AS EmplacementDeVente FROM vente JOIN produit ON fk_produit = pr_id JOIN stock ON fk_stock = sto_id;");
                $execution->execute();
                $resultats = $execution->fetchall();
                foreach ($resultats as $resultat) {
                    echo "<form method=\"POST\" action=\"\"><p>Nom du produit: " . $resultat["NomDuProduit"] . "</p><br><p>Quantité du produit: " . $resultat["QuantiteDuProduit"] . "<br>Date du commencement de cette vente: " . $resultat["DateDeCommencementDeCetteVente"] . "<br>Emplacement de la vente: " . $resultat["EmplacementDeVente"] . "</form><br><br>";
                }
                $connexion = null;
                Database::disconnect();
                ?>
                <a class="btn btn-primary" href="../ModuleB/PageClient/index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
        </div>
    </div>
    </div>
</body>

</html>