<?php
$pageTitle = 'Créer une réservation';

ob_start();
?>

<h2>Créer une réservation</h2>

<?php if (!empty($errors['general'])): ?>
    <p class="error">
        <?= htmlspecialchars($errors['general'], ENT_QUOTES, 'UTF-8') ?>
    </p>
<?php endif; ?>

<form method="POST" action="/reservations">

    <div>
        <label for="salle_id">Salle</label><br>

        <select id="salle_id" name="salle_id">
            <option value="">-- Choisir une salle --</option>

            <?php foreach ($salles as $salle): ?>
                <option
                    value="<?= (int) $salle->id ?>"
                    <?= ((int) ($data['salle_id'] ?? 0) === (int) $salle->id)
                        ? 'selected'
                        : '' ?>
                >
                    <?= htmlspecialchars(
                        $salle->nom,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <?php if (!empty($errors['salle_id'])): ?>
            <p class="error">
                <?= htmlspecialchars(
                    $errors['salle_id'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>
        <?php endif; ?>
    </div>

    <br>

    <div>
        <label for="responsable">Responsable</label><br>

        <input
            type="text"
            id="responsable"
            name="responsable"
            value="<?= htmlspecialchars(
                $data['responsable'] ?? '',
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
        >

        <?php if (!empty($errors['responsable'])): ?>
            <p class="error">
                <?= htmlspecialchars(
                    $errors['responsable'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>
        <?php endif; ?>
    </div>

    <br>

    <div>
        <label for="email">Email</label><br>

        <input
            type="email"
            id="email"
            name="email"
            value="<?= htmlspecialchars(
                $data['email'] ?? '',
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
        >

        <?php if (!empty($errors['email'])): ?>
            <p class="error">
                <?= htmlspecialchars(
                    $errors['email'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>
        <?php endif; ?>
    </div>

    <br>

    <div>
        <label for="motif">Motif</label><br>

        <textarea
            id="motif"
            name="motif"
            rows="4"
        ><?= htmlspecialchars(
            $data['motif'] ?? '',
            ENT_QUOTES,
            'UTF-8'
        ) ?></textarea>

        <?php if (!empty($errors['motif'])): ?>
            <p class="error">
                <?= htmlspecialchars(
                    $errors['motif'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>
        <?php endif; ?>
    </div>

    <br>

    <div>
        <label for="date_debut">Date de début</label><br>

        <input
            type="datetime-local"
            id="date_debut"
            name="date_debut"
            value="<?= htmlspecialchars(
                $data['date_debut'] ?? '',
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
        >

        <?php if (!empty($errors['date_debut'])): ?>
            <p class="error">
                <?= htmlspecialchars(
                    $errors['date_debut'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>
        <?php endif; ?>
    </div>

    <br>

    <div>
        <label for="date_fin">Date de fin</label><br>

        <input
            type="datetime-local"
            id="date_fin"
            name="date_fin"
            value="<?= htmlspecialchars(
                $data['date_fin'] ?? '',
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
        >

        <?php if (!empty($errors['date_fin'])): ?>
            <p class="error">
                <?= htmlspecialchars(
                    $errors['date_fin'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>
        <?php endif; ?>
    </div>

    <br>

    <button type="submit">
        Créer la réservation
    </button>

    <a href="/reservations">Annuler</a>

</form>

<?php
$content = ob_get_clean();

require __DIR__ . '/../layout/base.php';
?>
