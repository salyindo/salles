<?php
$pageTitle = 'Détails de la salle';

ob_start();
?>

<h2>Détails de la salle</h2>

<p>
    <strong>ID :</strong>
    <?= htmlspecialchars((string) $salle->id, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    <strong>Nom :</strong>
    <?= htmlspecialchars($salle->nom, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    <strong>Bâtiment :</strong>
    <?= htmlspecialchars($salle->batiment, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    <strong>Capacité :</strong>
    <?= htmlspecialchars((string) $salle->capacite, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    <strong>Type :</strong>
    <?= htmlspecialchars($salle->type, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    <strong>Active :</strong>
    <?= $salle->active ? 'Oui' : 'Non' ?>
</p>

<p>
    <a href="/salles">← Retour aux salles</a>
    |
    <a href="/salles/<?= (int) $salle->id ?>/edit">Modifier</a>
</p>

<?php
$content = ob_get_clean();

require __DIR__ . '/../layout/base.php';
?>
