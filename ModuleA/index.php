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
    <link rel="stylesheet" href="css/styles.css">
</head>


<body>
    <div class="form-actions">
        <a class="btn btn-warning" href="../ModuleB/connexion/connexion.php"><span class="glyphicon glyphicon-user"></span> Connexion</a>
    </div>
    <div class="container site">
        <h1 class="text-logo"><span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span>
            <a href="#" class="danger btn-lg disabled" role="button" aria-disabled="true"></a></h1>

        <?php
        require '../BDD/database.php';

        echo '<nav>
                        <ul class="nav nav-pills">';

        $db = Database::connect();
        $statement = $db->query('SELECT ra_id, ra_nom FROM rayon;');
        $categories = $statement->fetchAll();
        foreach ($categories as $category) {
            if ($category['ra_id'] == '1')
                echo '<li role="presentation" class="active"><a href="#' . $category['ra_id'] . '" data-toggle="tab">' . $category['ra_nom'] . '</a></li>';
            else
                echo '<li role="presentation"><a href="#' . $category['ra_id'] . '" data-toggle="tab">' . $category['ra_nom'] . '</a></li>';
        }

        echo    '</ul>
                      </nav>';

        echo '<div class="tab-content">';

        foreach ($categories as $category) {
            if ($category['ra_id'] == '1')
                echo '<div class="tab-pane active" id="' . $category['ra_id'] . '">';
            else
                echo '<div class="tab-pane" id="' . $category['ra_id'] . '">';

            echo '<div class="row">';

            $statement = $db->prepare('SELECT pr_id, pr_nom ,pr_cout, pr_image, pr_description FROM produit
            join rayon on ra_id = fk_rayon where ra_id = ?;');
            $statement->execute(array($category['ra_id']));
            while ($item = $statement->fetch()) {
                echo '<div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="../images/' . $item['pr_image'] . '" alt="...">
                                    <div class="price">' . number_format($item['pr_cout'], 2, '.', '') . ' €</div>
                                    <div class="caption">
                                        <h4>' . $item['pr_nom'] . '</h4>
                                        <a href="voirProduit/index.php?id=' . $item['pr_id'] . '" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Voir</a>
                                    </div>
                                </div>
                            </div>';
            }

            echo    '</div>
                        </div>';
        }
        Database::disconnect();
        echo  '</div>';
        ?>

    </div>
</body>

</html>