<?php
require_once 'config.php';

echo "<h1>Database Test</h1>";

try {
    // Test database connection
    echo "<p>Testing database connection...</p>";

    // Try to get recipe count
    $count = $pdo->query("SELECT COUNT(*) FROM recettes")->fetchColumn();
    echo "<p>✅ Database connection successful!</p>";
    echo "<p>Number of recipes in database: " . $count . "</p>";

    if ($count > 0) {
        echo "<p>Sample recipe data:</p>";
        $recipe = $pdo->query("SELECT * FROM recettes LIMIT 1")->fetch();
        echo "<pre>";
        print_r($recipe);
        echo "</pre>";
    }

    echo "<p>🎉 All systems ready! You can now use the PHP recipe website.</p>";
    echo "<p><a href='index.php'>Go to homepage</a></p>";
} catch (PDOException $e) {
    echo "<p>❌ Database connection failed: " . $e->getMessage() . "</p>";
    echo "<p>Please make sure MySQL/MariaDB is running and the database has been created.</p>";
    echo "<p>You can try running: <code>sudo service mysql start</code></p>";
}
?>