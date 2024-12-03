<?php
session_start();

// Charger les articles
$articlesFile = 'articles.json';
if (file_exists($articlesFile)) {
    $articles = json_decode(file_get_contents($articlesFile), true);
} else {
    $articles = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur le Mini Blog</h1>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <a href="add_article.php">Ajouter un article</a>
            <a href="logout.php">Se déconnecter</a>
        <?php else: ?>
            <a href="login.php">Se connecter</a>
        <?php endif; ?>
        <h2>Articles :</h2>
        <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
                <article>
                    <h3><?= htmlspecialchars($article['title']); ?></h3>
                    <p><?= nl2br(htmlspecialchars($article['content'])); ?></p>
                    <hr>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun article pour le moment.</p>
        <?php endif; ?>
    </div>
</body>
</html>
