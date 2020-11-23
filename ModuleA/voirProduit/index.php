<?php
require '../../BDD/database.php';

if (!empty($_GET['id'])) {
  $id = checkInput($_GET['id']);
}

$db = Database::connect();
$statement = $db->prepare("SELECT produit.pr_id, produit.pr_nom, produit.pr_description, produit.pr_cout,  ra_nom, stock.sto_type,  quantite, pr_image
    FROM est_associe
    join produit on pr_id = fk_produit
    join stock on stock.sto_id = fk_stock
    join rayon on ra_id = fk_rayon
    WHERE produit.pr_id = ? AND quantite > 0");
$statement->execute(array($id));
$item = $statement->fetch();
Database::disconnect();

function checkInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>All4Sport-Produit</title>
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
        <form>
          <div class="form-group">
            <label>Nom:</label><?php echo '  ' . $item['pr_nom']; ?>
          </div>
          <div class="form-group">
            <label>Description:</label><?php echo '  ' . $item['pr_description']; ?>
          </div>
          <div class="form-group">
            <label>Prix:</label><?php echo '  ' . number_format((float)$item['pr_cout'], 2, '.', '') . ' €'; ?>
          </div>
          <div class="form-group">
            <label>Catégorie:</label><?php echo '  ' . $item['pr_nom']; ?>
          </div>
          <div class="form-group">
            <label>Lieu de disponibilité:</label>
            <?php
            foreach ($statement as $statement) { ?>
            <?php echo '  ' . $item['sto_type'];
            } ?>
          </div>
          <div class="form-group">
            <label>Quantité:</label><?php echo '  ' . $item['quantite']; ?>
          </div>
        </form>
        <br>
        <div class="form-actions">
          <a class="btn btn-primary" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
        </div>
      </div>
      <div class="col-sm-6 site">
        <div class="thumbnail">
          <img src="<?php echo '../../images/' . $item['pr_image']; ?>" alt="...">
          <div class="price"><?php echo number_format((float)$item['pr_cout'], 2, '.', '') . ' €'; ?></div>
          <div class="caption">
            <h4><?php echo $item['pr_nom']; ?></h4>
            <p><?php echo $item['pr_description']; ?></p>
            <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>