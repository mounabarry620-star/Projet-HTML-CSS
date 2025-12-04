<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nous découvrir - Mon Site Culinaire</title>
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
            <a class="nav-link" href="recettes.php">Recettes <span class="badge bg-primary">6</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="decouvrir.php">Nous découvrir</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">Découvrez notre équipe</h1>
        <p class="lead">Apprenez-en plus sur notre passion pour la cuisine française.</p>
      </div>
    </div>

    <main class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <h2>Notre Histoire</h2>
                <p>Nous sommes une équipe de chefs passionnés dédiés à préserver et partager les traditions culinaires françaises.</p>
                <p>Notre site a été créé pour partager notre amour de la cuisine française avec le monde entier.</p>
            </div>
            <div class="col-md-6">
                <h2>Notre Mission</h2>
                <p>Nous voulons rendre la cuisine française accessible à tous, des débutants aux chefs expérimentés.</p>
                <p>Chaque recette est testée et perfectionnée pour garantir des résultats délicieux.</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Nos Valeurs</h2>
                <ul>
                    <li>Authenticité - Nous respectons les recettes traditionnelles</li>
                    <li>Qualité - Nous utilisons uniquement les meilleurs ingrédients</li>
                    <li>Passion - Nous aimons ce que nous faisons</li>
                    <li>Partage - Nous voulons transmettre notre savoir</li>
                </ul>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Notre Équipe de Cuisiniers</h2>
                <div class="row">
                    <?php
                    // Fetch chefs from database
                    $stmt = $pdo->query("SELECT * FROM cuisiniers");
                    $chefs = $stmt->fetchAll();

                    if (count($chefs) > 0) {
                        foreach ($chefs as $chef) {
                            echo '<div class="col-md-4 mb-4">';
                            echo '<div class="card">';
                            echo '<img src="' . htmlspecialchars($chef['photo']) . '" class="card-img-top" alt="' . htmlspecialchars($chef['nom']) . '">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . htmlspecialchars($chef['nom']) . '</h5>';
                            echo '<p class="card-text"><strong>Spécialité:</strong> ' . htmlspecialchars($chef['specialite']) . '</p>';
                            echo '<p class="card-text"><strong>Expérience:</strong> ' . htmlspecialchars($chef['experience']) . ' ans</p>';
                            echo '<p class="card-text">' . htmlspecialchars($chef['bio']) . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="col-md-12">';
                        echo '<p>Aucun cuisinier trouvé dans la base de données.</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
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