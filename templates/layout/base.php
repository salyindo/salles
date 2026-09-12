<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Réservation de salles', ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<header>
    <div class="site-header">
        <a class="brand" href="/">
            <span class="brand-mark">RS</span>
            <span>
                <strong>Réservation</strong>
                <small>Campus universitaire</small>
            </span>
        </a>
        <nav class="main-nav" aria-label="Navigation principale">
            <a href="/salles">Salles</a>
            <a href="/reservations">Réservations</a>
        </nav>
    </div>
</header>
<main class="page-shell">
    <?= $content ?? '' ?>
</main>
</body>
</html>
