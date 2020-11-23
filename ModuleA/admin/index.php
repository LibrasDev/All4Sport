<!DOCTYPE html>
<html>

<head>
  <title>All4Sport</title>
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
      <h1><strong>Liste des items </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require '../../BDD/database.php';
          $db = Database::connect();
          $statement = $db->query('SELECT produit.pr_id, produit.pr_nom, produit.pr_description , produit.pr_cout, rayon.ra_nom FROM produit LEFT JOIN rayon ON produit.fk_rayon = rayon.ra_id ORDER BY produit.pr_id DESC');
          while ($item = $statement->fetch()) {
            echo '<tr>';
            echo '<td>' . $item['pr_nom'] . '</td>';
            echo '<td>' . $item['pr_description'] . '</td>';
            echo '<td>' . number_format($item['pr_cout'], 2, '.', '') . '</td>';
            echo '<td>' . $item['ra_nom'] . '</td>';
            echo '<td width=300>';
            echo '<a class="btn btn-default" href="view.php?id=' . $item['pr_id'] . '"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
            echo ' ';
            echo '<a class="btn btn-primary" href="update.php?id=' . $item['pr_id'] . '"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
            echo ' ';
            echo '<a class="btn btn-danger" href="delete.php?id=' . $item['pr_id'] . '"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
            echo '</td>';
            echo '</tr>';
          }
          Database::disconnect();
          ?>
        </tbody>
      </table>
      <div class="form-actions">
        <a class="btn btn-primary" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
      </div>
    </div>
  </div>
</body>

</html>