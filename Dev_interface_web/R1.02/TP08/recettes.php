<!DOCTYPE html>
<html lang="fr">

  <head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="bootstrap-5.2.3-dist/css/bootstrap.css">
    <script src="bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="custom.css">
  </head>

  <body>
    <header>
      <h1>Mon Site Culinaire</h1>
    </header>
    <nav>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="index.html">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="recettes.php">Recettes <span class="badge bg-primary">6</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="decouvrir.html">Nous découvrir</a>
        </li>
      </ul>
    </nav>
<div class="alert alert-info alert-dismissible fade show" role="alert">
  Pour une alimentation saine, évitez les aliments gras et sucrés et pratiquez régulièrement du sport !
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Trier les recettes
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="#">Trier par nom ascendant</a></li>
    <li><a class="dropdown-item" href="#">Trier par nom descendant</a></li>
    <li><a class="dropdown-item" href="#">Trier par note ascendante</a></li>
    <li><a class="dropdown-item" href="#">Trier par note décroissante</a></li>
  </ul>
</div>
<?php
$conn = new mysqli('localhost', 'root', '', 'recettes_db');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM recipes";
$result = $conn->query($sql);
$counter = 0;
if ($result->num_rows > 0) {
  echo '<div class="row">';
  while($row = $result->fetch_assoc()) {
    if ($counter % 3 == 0 && $counter != 0) {
      echo '</div><div class="row">';
    }
    echo '<div class="col-sm-4">';
    echo '<div class="card">';
    echo '<img src="' . $row['photo'] . '" class="card-img-top" alt="' . $row['title'] . '">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $row['title'] . '</h5>';
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
      if ($i <= $row['rating']) {
        $stars .= '<span class="fas fa-star jaune"></span>';
      } else {
        $stars .= '<span class="fas fa-star blanc"></span>';
      }
    }
    echo '<p>Note: ' . $stars . '</p>';
    echo '<p class="card-text">' . $row['short_desc'] . '</p>';
    echo '<a href="#" class="btn btn-primary">Voir la recette</a>';
    echo '</div></div></div>';
    $counter++;
  }
  echo '</div>';
} else {
  echo "0 results";
}
$conn->close();
?>
<nav aria-label="Page navigation example">
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
<footer><p class="text-center small">&copy; 2025 Mon Site Culinaire</p></footer>
  </body>

</html>