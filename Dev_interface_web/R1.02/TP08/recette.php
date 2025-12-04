<?php
require_once 'config.php';

// Get recipe ID from URL
$recipeId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Get recipe from database
try {
    $stmt = $pdo->prepare("SELECT * FROM recettes WHERE id = ?");
    $stmt->execute([$recipeId]);
    $recipe = $stmt->fetch();

    if (!$recipe) {
        header("Location: recettes.php");
        exit;
    }
} catch (PDOException $e) {
    die("Error fetching recipe: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['titre']); ?> - Mon Site Culinaire</title>
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
            <a class="nav-link" href="recettes.php">Recettes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="decouvrir.php">Nous découvrir</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4"><?php echo htmlspecialchars($recipe['titre']); ?></h1>
        <p class="lead">Découvrez les détails de cette délicieuse recette française.</p>
      </div>
    </div>

    <main class="container my-4">
      <div class="row">
        <div class="col-md-6">
          <img src="<?php echo htmlspecialchars($recipe['photo']); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($recipe['titre']); ?>">
        </div>
        <div class="col-md-6">
          <h2><?php echo htmlspecialchars($recipe['titre']); ?></h2>

          <div class="rating mb-3">
            <?php
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
            ?>
            <span class="ms-2"><?php echo htmlspecialchars($recipe['note']); ?>/5</span>
          </div>

          <h3>Description</h3>
          <p><?php echo nl2br(htmlspecialchars($recipe['description_longue'])); ?></p>

          <a href="recettes.php" class="btn btn-secondary">Retour aux recettes</a>
        </div>
      </div>
    </main>

    <footer class="bg-light py-3 mt-auto">
      <div class="container">
        <p class="text-center small">&copy; 2025 Mon Site Culinaire. Tous droits réservés.</p>
      </div>
    </footer>
  </body>

</html>