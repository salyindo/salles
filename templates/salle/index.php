<?php
$pageTitle = 'Liste des salles';

ob_start();
?>

<h2>Liste des salles</h2>

<p>
    <a href="/salles/create">➕ Ajouter une salle</a>
</p>

<?php if (empty($salles)): ?>

    <p>Aucune salle disponible.</p>

<?php else: ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Bâtiment</th>
                <th>Capacité</th>
                <th>Type</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($salles as $salle): ?>
            <tr>
                <td>
                    <?= htmlspecialchars((string) $salle->id, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= htmlspecialchars($salle->nom, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= htmlspecialchars($salle->batiment, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= htmlspecialchars((string) $salle->capacite, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= htmlspecialchars($salle->type, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= $salle->active ? 'Oui' : 'Non' ?>
                </td>

                <td>
                    <a href="/salles/<?= (int) $salle->id ?>">
                        Voir
                    </a>

                    |

                    <a href="/salles/<?= (int) $salle->id ?>/edit">
                        Modifier
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
