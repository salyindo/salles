<?php
$pageTitle = 'Liste des réservations';

ob_start();
?>

<h2>Liste des réservations</h2>

<p>
    <a href="/reservations/create">➕ Nouvelle réservation</a>
</p>

<?php if (empty($reservations)): ?>

    <p>Aucune réservation trouvée.</p>

<?php else: ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Salle</th>
                <th>Responsable</th>
                <th>Email</th>
                <th>Motif</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($reservations as $reservation): ?>
            <tr>
                <td>
                    <?= htmlspecialchars((string) $reservation->id, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        (string) $reservation->salle_id,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </td>

                <td>
                    <?= htmlspecialchars($reservation->responsable, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= htmlspecialchars($reservation->email, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= htmlspecialchars($reservation->motif, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        (string) $reservation->date_debut,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        (string) $reservation->date_fin,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </td>

                <td>
                    <?= htmlspecialchars($reservation->statut, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <a href="/reservations/<?= (int) $reservation->id ?>">
                        Voir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<?php
$content = ob_get_clean();

require __DIR__ . '/../layout/base.php';
?>
