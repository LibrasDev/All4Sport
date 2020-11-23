<?php
include "../BDD/database.php";
if (isset($_POST["nomProduit"]) && isset($_POST["quantiteProduit"]) && isset($_POST["coutProduit"]) && isset($_POST["descriptionProduit"])) 
{
    $connexion = Database::connect();
    // On vérifie d'abord si le produit éxiste déjà en vérifiant si tout les infos sont exactements pareils (sauf la quantite et la description).
    $execution = $connexion->prepare("SELECT pr_id AS ID FROM produit WHERE pr_nom=\"" . $_POST["nomProduit"] . "\" and pr_cout=\"" . $_POST["coutProduit"] . "\";");
    $execution->execute();
    $siLeProduitExiste = $execution->fetchall();
    if ($siLeProduitExiste == null) {
        $execution = $connexion->prepare("SELECT ra_id AS ID FROM rayon WHERE ra_nom=\"" . $_POST["categorieProduit"] . "\";");
        $execution->execute();
        $idRayon = $execution->fetchall();
        if (isset($_FILES["image"])) 
        {
            if ($_FILES["image"]["size"] > 500000) 
            {
                $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
                if ($imageExtension == "jpg" || $imageExtension || "png" && $imageExtension || "jpeg" && $imageExtension || "gif") {
                    $imagePath = "../images/" . basename($_FILES["image"]["tmp_name"]);
                    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                        $execution = $connexion->prepare("INSERT INTO produit VALUES (NULL, \"" . $_POST["nomProduit"] . "\", " . $_POST["coutProduit"] . ", \"" . $_POST["descriptionProduit"] . "\", \"" . $_FILES["image"]["tmp_name"] . "\", " . $idRayon[0]["ID"] . ");");
                        $execution->execute();
                    }
                }
            }
        } 
        else 
        {
            $execution = $connexion->prepare("INSERT INTO produit (pr_id, pr_nom, pr_cout, pr_description, fk_rayon) VALUES (NULL, \"" . $_POST["nomProduit"] . "\", " . $_POST["coutProduit"] . ", \"" . $_POST["descriptionProduit"] . "\", " . $idRayon[0]["ID"] . ");");
            $execution->execute();
        }
        $execution = $connexion->prepare("SELECT pr_id AS ID FROM produit WHERE pr_nom=\"" . $_POST["nomProduit"] . "\" and pr_cout=" . $_POST["coutProduit"] . ";");
        $execution->execute();
        $idProduit = $execution->fetchall();
        echo $_POST["nomProduit"];
        echo $_POST["coutProduit"];
        print_r($idProduit);
        $execution = $connexion->prepare("INSERT INTO est_associe VALUES(" . $_POST["quantiteProduit"] . ", " . $_POST["lieuDeVente"] . ", " . $idProduit[0]["ID"] . ");");
        $execution->execute();
    } 
    else 
    {
        $execution = $connexion->prepare("UPDATE est_associe SET quantite = quantite + " . $_POST["quantiteProduit"] . " WHERE fk_produit =\"" . $resultats[0]["ID"] . "\";");
        $execution->execute();
    }
    session_start();
    $execution = $connexion->prepare("SELECT sto_id AS ID FROM stock WHERE sto_type = \"" . $_POST["lieuDeVente"] . "\";");
    $execution->execute();
    $leLieuDeVenteQueVeutLeVendeur = $execution->fetchall();
    if ($_POST["typeDeVente"] == 0) {
        $execution = $connexion->prepare("INSERT INTO vente VALUES(NULL, DATE(NOW()), " . $_POST["quantiteProduit"] . ", " . $leLieuDeVenteQueVeutLeVendeur[0]["ID"] . ", " . $_SESSION["ID"] . ", " . $siLeProduitExiste[0]["ID"] . ");");
        $execution->execute();
    } else {
        $execution = $connexion->prepare("INSERT INTO vente VALUES(NULL, DATE(NOW()), " . $_POST["quantiteProduit"] . ", " . $leLieuDeVenteQueVeutLeVendeur[0]["ID"] . ", 0, " . $siLeProduitExiste[0]["ID"] . ");");
        $execution->execute();
    }
    $connexion = null;
    Database::disconnect();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>All4Sport-Vendre Un Produit</title>
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
                <form method="POST" action="">
                    <div class="form-group">
                        <style>
                            label {
                                display: block;
                            }
                        </style>
                        <label>Nom du produit:</label><input type="text" name="nomProduit"><br><br>
                        <label>Quantité du produit:</label><input type="number" name="quantiteProduit"><br><br>
                        <label>Cout à l'unité:</label><input type="number" step="0.01" name="coutProduit"><br><br>
                        <label>Description du produit:</label><input type="text" rows="3" cols="35" name="descriptionProduit"><br><br>
                        <label>Type de vente:</label><select name="typeDeVente">
                            <option value="0">Vente identifié</option>
                            <option value="1">Vente anonyme</option>
                        </select><br>
                        <?php
                            echo "<br><label>Lieu de vente:</label><select name=\"lieuDeVente\">";
                            $connexion = Database::connect();
                            $execution = $connexion->prepare("SELECT sto_type AS lieuDeVenteNom FROM stock;");
                            $execution->execute();
                            $resultats = $execution->fetchall();
                            print_r($resultats);
                            foreach ($resultats as $resultat) 
                            {
                                echo "<option value=" . $resultat["lieuDeVenteNom"] . ">" . $resultat["lieuDeVenteNom"] . "</option>";
                            }
                            echo "</select><br>";
                            echo "<br><label>Categorie du produit:</label><select name=\"categorieProduit\">";
                            foreach ($connexion->query("SELECT ra_nom AS nom FROM rayon") as $rayon) 
                            {
                                echo "<option value=" . $rayon["nom"] . ">" . $rayon["nom"] . "</option>";
                            }
                            Database::disconnect();
                            echo "</select><br>";
                        ?>
                        <br><label>Image de votre produit:<label><input type="file" name="image"><br>
                        <input type="submit" value="Enregistrer le produit"><br><br>
                </form>
                <a class="btn btn-primary" href="../ModuleB/PageClient/index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>