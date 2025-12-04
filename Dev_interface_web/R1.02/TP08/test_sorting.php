<?php
require_once 'config.php';

// Test sorting functionality
echo "<h1>Test des fonctionnalités de tri</h1>";

$sorts = ['name_asc', 'name_desc', 'rating_asc', 'rating_desc'];

foreach ($sorts as $sort) {
    echo "<h2>Test du tri: $sort</h2>";

    try {
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

        $stmt = $pdo->query($query);
        $recipes = $stmt->fetchAll();

        echo "<p>Nombre de recettes: " . count($recipes) . "</p>";
        echo "<ul>";
        foreach ($recipes as $recipe) {
            echo "<li>" . htmlspecialchars($recipe['titre']) . " (Note: " . $recipe['note'] . ")</li>";
        }
        echo "</ul>";

    } catch (PDOException $e) {
        echo "<p>Erreur: " . $e->getMessage() . "</p>";
    }
}

echo "<p><a href='recettes.php'>Retour à la page des recettes</a></p>";
?>