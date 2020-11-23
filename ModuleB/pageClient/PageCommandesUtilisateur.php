<?php
session_start();
include "../../BDD/Database.php";
$connexion = Database::connect();
$execution = $connexion->prepare("SELECT pr_nom AS nomProduitCommande, com_date AS dateCommande, com_quantite AS quantiteCommande, pr_cout AS prixUnitaireProduitCommande, com_quantite*pr_cout AS totalCommande, sto_type AS lieuExpedition, ut_adresse AS adresseLivraison, et_nom AS etatCommande FROM commandes JOIN produit ON pr_id = fk_produit JOIN utilisateur ON ut_id = fk_utilisateur JOIN etats ON et_id = fk_etats JOIN stock ON sto_id = fk_stock WHERE ut_id =" . $_SESSION["ID"] . ";");
$execution->execute();
$resultats = $execution->fetchall();
$connexion = null;
Database::disconnect();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>All4Sport-Vos commandes</title>
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
                <h1> Vos commandes: </h1>
                <?php
                foreach ($resultats as $resultat) {
                    if (isset($resultat["nomProduitCommande"]) && isset($resultat["dateCommande"]) && isset($resultat["quantiteCommande"]) && isset($resultat["prixUnitaireProduitCommande"]) && isset($resultat["totalCommande"]) && isset($resultat["lieuExpedition"]) && isset($resultat["adresseLivraison"])) {
                        echo "<br><strong> Nom du produit: </strong>" . $resultat["nomProduitCommande"] . "<br><br><strong> Date de la commande: </strong>" . $resultat["dateCommande"] . "<br><strong>Quantité du produit: </strong>" . $resultat["quantiteCommande"] . "<br><strong>Prix unitaire: </strong>" . $resultat["prixUnitaireProduitCommande"] . "<br><strong>Prix total: </strong>" . $resultat["totalCommande"] . "<br><strong>Lieu d'expédition: </strong>" . $resultat["lieuExpedition"] . "<br><strong>Adresse d'expédition: </strong>" . $resultat["adresseLivraison"] . "<br><strong>Etat de la commande: </strong>" . $resultat["etatCommande"] . "<br><br><br>";
                    }
                }
                ?>
                <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
        </div>
    </div>
    </div>
</body>


</html>