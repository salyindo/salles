<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($pageTitle ?? 'Réservation de salles', ENT_QUOTES, 'UTF-8') ?>
    </title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
        }

        header {
            background: #222;
            color: white;
            padding: 20px;
        }

        main {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background: white;
        }

        a {
            text-decoration: none;
        }

        .error {
            color: red;
            margin-top: 5px;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>

<header>
    <h1>Réservation de salles</h1>
</header>

<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>
