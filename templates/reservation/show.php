<?php
$pageTitle = 'Détails de la réservation';

ob_start();
?>

<h2>Détails de la réservation</h2>

<p>
    <strong>ID :</strong>
    <?= htmlspecialchars((string) $reservation->id, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    <strong>Salle :</strong>
    <?= htmlspecialchars(
        (string) $reservation->salle_id,
        ENT_QUOTES,
        'UTF-8'
    ) ?>
</p>

<p>
    <strong>Responsable :</strong>
    <?= htmlspecialchars($reservation->responsable, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    <strong>Email :</strong>
    <?= htmlspecialchars($reservation->email, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    <strong>Motif :</strong>
    <?= htmlspecialchars($reservation->motif, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    <strong>Date de début :</strong>
    <?= htmlspecialchars(
        (string) $reservation->date_debut,
        ENT_QUOTES,
        'UTF-8'
    ) ?>
</p>

<p>
    <strong>Date de fin :</strong>
    <?= htmlspecialchars(
        (string) $reservation->date_fin,
        ENT_QUOTES,
        'UTF-8'
    ) ?>
</p>

<p>
    <strong>Statut :</strong>
    <?= htmlspecialchars($reservation->statut, ENT_QUOTES, 'UTF-8') ?>
</p>

<?php if ($reservation->statut === 'confirmée'): ?>

    <form method="POST"
          action="/reservations/<?= (int) $reservation->id ?>/cancel">

        <button type="submit">
            Annuler la réservation
        </button>

    </form>

<?php endif; ?>

<p>
    <a href="/reservations">← Retour aux réservations</a>
</p>

<?php
$content = ob_get_clean();

require __DIR__ . '/../layout/base.php';
?>
