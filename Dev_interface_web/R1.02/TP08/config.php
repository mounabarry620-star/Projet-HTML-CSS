<?php
// Database configuration
$host = 'localhost';
$dbname = 'recettes_db';
$username = 'root';
$password = '';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // If database doesn't exist, try to create it
    try {
        $pdo = new PDO("mysql:host=$host;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
        $pdo->exec("USE $dbname");

        // Create recipes table
        $pdo->exec("CREATE TABLE IF NOT EXISTS recettes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            titre VARCHAR(255) NOT NULL,
            photo VARCHAR(255) NOT NULL,
            note DECIMAL(3,1) NOT NULL,
            description_courte TEXT NOT NULL,
            description_longue TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // Create chefs table
        $pdo->exec("CREATE TABLE IF NOT EXISTS cuisiniers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(255) NOT NULL,
            specialite VARCHAR(255) NOT NULL,
            experience INT NOT NULL,
            bio TEXT NOT NULL,
            photo VARCHAR(255) NOT NULL
        )");

        // Insert sample data if table is empty
        $count = $pdo->query("SELECT COUNT(*) FROM recettes")->fetchColumn();
        if ($count == 0) {
            $recipes = [
                ['Boeuf Bourguignon', 'recette1.jpg', 4.5, 'Un classique de la cuisine française, ce ragoût de bœuf mijoté dans du vin rouge est riche et savoureux.', 'Le bœuf bourguignon est un plat traditionnel français originaire de Bourgogne. Il est préparé avec des morceaux de bœuf mijotés dans du vin rouge, généralement un Bourgogne, avec des lardons, des champignons, des oignons et des carottes. Ce plat est typiquement cuit lentement pour permettre aux saveurs de se développer pleinement. La viande devient tendre et fondante, tandis que la sauce prend une texture riche et onctueuse.'],
                ['Coq au Vin', 'recette2.webp', 4.0, 'Un plat traditionnel où le poulet est cuit lentement dans du vin rouge avec des champignons et des oignons.', 'Le coq au vin est un autre classique de la cuisine française. Ce plat consiste en un coq (ou plus communément un poulet) mijoté dans du vin rouge, traditionnellement un vin de Bourgogne, avec des lardons, des champignons, des oignons grelots et parfois une touche de cognac. Le plat est souvent garni de pommes de terre ou servi avec du pain frais pour absorber la sauce riche et savoureuse.'],
                ['Ratatouille', 'recette3.jpg', 5.0, 'Un plat végétarien provençal à base de légumes d\'été comme les aubergines, les courgettes et les poivrons.', 'La ratatouille est un plat végétarien emblématique de la cuisine provençale. Elle est composée de légumes d\'été coupés en dés et mijotés ensemble : aubergines, courgettes, poivrons, tomates et oignons. Les légumes sont cuits lentement avec de l\'ail, de l\'huile d\'olive et des herbes de Provence, ce qui crée une harmonie de saveurs méditerranéennes. Ce plat peut être servi chaud ou froid et est souvent accompagné de pain grillé ou de riz.'],
                ['Soupe à l\'oignon', 'recette4.avif', 5.0, 'Une soupe réconfortante à base d\'oignons caramélisés, de bouillon de bœuf et de fromage gratiné.', 'La soupe à l\'oignon est une soupe française classique faite à base d\'oignons caramélisés, de bouillon de bœuf et souvent gratinée avec du fromage et du pain grillé. Les oignons sont cuits lentement jusqu\'à ce qu\'ils deviennent doux et dorés, puis le bouillon est ajouté et le tout est mijoté pour créer une base riche et savoureuse. La soupe est traditionnellement servie avec des croûtons et du fromage fondu sur le dessus, souvent du gruyère ou de l\'emmental.'],
                ['Tarte Tatin', 'recette5.jpeg', 5.0, 'Une tarte renversée aux pommes caramélisées, un dessert français emblématique.', 'La tarte Tatin est un dessert français classique qui consiste en une tarte aux pommes renversée. Les pommes sont caramélisées dans du beurre et du sucre avant d\'être recouvertes d\'une pâte et cuites au four. Une fois cuite, la tarte est renversée pour révéler les pommes dorées et caramélisées. Ce dessert est souvent servi tiède avec de la crème fraîche ou de la glace à la vanille. La légende raconte que ce dessert a été créé par accident par les sœurs Tatin dans leur hôtel à Lamotte-Beuvron.'],
                ['Crème Brûlée', 'recette6.avif', 5.0, 'Un dessert crémeux à la vanille avec une croûte de sucre caramélisé.', 'La crème brûlée est un dessert français classique composé d\'une crème à base de jaunes d\'œufs, de sucre et de vanille, recouverte d\'une fine couche de sucre caramélisé. La crème est cuite au bain-marie jusqu\'à ce qu\'elle soit ferme mais encore tremblotante, puis refroidie. Avant de servir, une couche de sucre est saupoudrée sur le dessus et caramélisée à l\'aide d\'un chalumeau pour créer une croûte croustillante et sucrée qui contraste avec la crème onctueuse en dessous.']
            ];

            $stmt = $pdo->prepare("INSERT INTO recettes (titre, photo, note, description_courte, description_longue) VALUES (?, ?, ?, ?, ?)");
            foreach ($recipes as $recipe) {
                $stmt->execute($recipe);
            }
        }

        // Insert sample chefs data if table is empty
        $chefCount = $pdo->query("SELECT COUNT(*) FROM cuisiniers")->fetchColumn();
        if ($chefCount == 0) {
            $chefs = [
                ['Jean Dupont', 'Cuisine Française Traditionnelle', 15, 'Jean Dupont est un chef expérimenté avec plus de 15 ans d\'expérience dans la cuisine française traditionnelle. Il a travaillé dans plusieurs restaurants étoilés Michelin avant de rejoindre notre équipe.', 'chef1.jpg'],
                ['Marie Martin', 'Pâtisserie Française', 10, 'Marie Martin est une pâtissière talentueuse spécialisée dans les desserts français classiques. Elle a remporté plusieurs concours de pâtisserie et apporte une touche sucrée à notre équipe.', 'chef2.jpg'],
                ['Pierre Leroy', 'Cuisine Moderne', 8, 'Pierre Leroy est un jeune chef innovant qui apporte une touche moderne à la cuisine française. Il aime expérimenter avec des techniques culinaires contemporaines tout en respectant les traditions.', 'chef3.jpg']
            ];

            $stmt = $pdo->prepare("INSERT INTO cuisiniers (nom, specialite, experience, bio, photo) VALUES (?, ?, ?, ?, ?)");
            foreach ($chefs as $chef) {
                $stmt->execute($chef);
            }
        }
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
?>