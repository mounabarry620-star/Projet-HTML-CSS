<?php
require_once 'config.php';

// Get recipes from database with sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
$query = "SELECT * FROM recettes ";

switch ($sort) {
    case 'name_desc':
        $query .= "ORDER BY titre DESC";
        break;
    case 'rating_asc':
        $query .= "ORDER BY note ASC";
        break;
    case 'rating_desc':
        $query .= "ORDER BY note DESC";
        break;
    case 'name_asc':
    default:
        $query .= "ORDER BY titre ASC";
        break;
}

try {
    $stmt = $pdo->query($query);
    $recipes = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching recipes: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site Culinaire - Recettes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="cuisinier.css">
    <link rel="stylesheet" href="custom.css">
  </head>

  <body>
    <header class="bg-light py-3 custom-header">
      <div class="container">
        <h1 class="text-center">Mon Site Culinaire</h1>
      </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="recettes.php">Recettes <span class="badge bg-primary"><?php echo count($recipes); ?></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="decouvrir.php">Nous découvrir</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">Nos recettes culinaires</h1>
        <p class="lead">Explorez notre collection de recettes délicieuses et apprenez à cuisiner comme un chef professionnel.</p>
        <a href="decouvrir.php" class="btn btn-info" role="button">Nous découvrir</a>
      </div>
    </div>

    <main class="container my-4">
      <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Conseil santé:</strong> Pour une alimentation saine, évitez les aliments gras et sucrés et pratiquez régulièrement du sport !
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      <div class="row mb-4">
        <div class="col-md-8">
          <h2>Nos Recettes</h2>
          <p>Découvrez nos délicieuses recettes de cuisine.</p>
        </div>
        <div class="col-md-4">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Trier les recettes
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="recettes.php?sort=name_asc">Trier par nom ascendant</a></li>
              <li><a class="dropdown-item" href="recettes.php?sort=name_desc">Trier par nom descendant</a></li>
              <li><a class="dropdown-item" href="recettes.php?sort=rating_asc">Trier par note ascendante</a></li>
              <li><a class="dropdown-item" href="recettes.php?sort=rating_desc">Trier par note décroissante</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Recipe content generated dynamically -->
      <div class="row">
        <?php
        // Sorting is now handled by SQL query, no need for PHP sorting

        // Display recipes in chunks of 3 per row
        $chunkedRecipes = array_chunk($recipes, 3);
        foreach ($chunkedRecipes as $rowRecipes) {
            echo '<div class="row' . (array_search($rowRecipes, $chunkedRecipes) > 0 ? ' mt-4' : '') . '">';
            foreach ($rowRecipes as $recipe) {
                echo '<div class="col-sm-4">';
                echo '<div class="card">';
                echo '<img src="' . htmlspecialchars($recipe['photo']) . '" class="card-img-top" alt="' . htmlspecialchars($recipe['titre']) . '">';
                echo '<div class="card-body">';
                echo '<h3 class="card-title">' . htmlspecialchars($recipe['titre']) . '</h3>';
                echo '<div class="rating">';

                // Display star rating
                $fullStars = floor($recipe['note']);
                $halfStar = ($recipe['note'] - $fullStars) >= 0.5 ? 1 : 0;
                $emptyStars = 5 - $fullStars - $halfStar;

                for ($i = 0; $i < $fullStars; $i++) {
                    echo '<i class="fas fa-star text-warning"></i>';
                }
                if ($halfStar) {
                    echo '<i class="fas fa-star-half-alt text-warning"></i>';
                }
                for ($i = 0; $i < $emptyStars; $i++) {
                    echo '<i class="far fa-star text-warning"></i>';
                }

                echo '<span class="ms-2">' . htmlspecialchars($recipe['note']) . '/5</span>';
                echo '</div>';
                echo '<p class="card-text">' . htmlspecialchars($recipe['description_courte']) . '</p>';
                echo '<a href="recette.php?id=' . htmlspecialchars($recipe['id']) . '" class="btn btn-primary">Voir la recette</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>
      </div>

      <nav aria-label="Page navigation example" class="my-4">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
          </li>
          <li class="page-item active" aria-current="page">
            <a class="page-link" href="#">1</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Suivant</a>
          </li>
        </ul>
      </nav>
    </main>

    <footer class="bg-light py-3 mt-auto">
      <div class="container">
        <p class="text-center small">&copy; 2025 Mon Site Culinaire. Tous droits réservés.</p>
      </div>
    </footer>
  </body>

</html>