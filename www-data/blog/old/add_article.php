<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (!empty($title) && !empty($content)) {
        $articlesFile = 'articles.json';
        if (file_exists($articlesFile)) {
            $articles = json_decode(file_get_contents($articlesFile), true);
        } else {
            $articles = [];
        }

        $articles[] = [
            'title' => $title,
            'content' => $content,
            'date' => date('Y-m-d H:i:s'),
        ];

        file_put_contents($articlesFile, json_encode($articles, JSON_PRETTY_PRINT));
        header('Location: index.php');
        exit;
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un article</h1>
        <a href="index.php">Retour à l'accueil</a>
        <form action="add_article.php" method="post">
            <div>
                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="content">Contenu :</label>
                <textarea id="content" name="content" rows="5" required></textarea>
            </div>
            <button type="submit">Ajouter</button>
        </form>
        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
