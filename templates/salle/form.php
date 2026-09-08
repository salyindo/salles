<?php
$pageTitle = isset($salle) ? 'Modifier une salle' : 'Créer une salle';

ob_start();

$isEdit = isset($salle);
$action = $isEdit
    ? '/salles/' . (int) $salle->id . '/edit'
    : '/salles';
?>

<h2>
    <?= $isEdit ? 'Modifier une salle' : 'Créer une salle' ?>
</h2>

<?php if (!empty($errors['general'])): ?>
    <p class="error">
        <?= htmlspecialchars($errors['general'], ENT_QUOTES, 'UTF-8') ?>
    </p>
<?php endif; ?>

<form method="POST" action="<?= htmlspecialchars($action, ENT_QUOTES, 'UTF-8') ?>">

    <div>
        <label for="nom">Nom</label><br>
        <input
            type="text"
            id="nom"
            name="nom"
            value="<?= htmlspecialchars($data['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (!empty($errors['nom'])): ?>
            <p class="error">
                <?= htmlspecialchars($errors['nom'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <br>

    <div>
        <label for="batiment">Bâtiment</label><br>
        <input
            type="text"
            id="batiment"
            name="batiment"
            value="<?= htmlspecialchars($data['batiment'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (!empty($errors['batiment'])): ?>
            <p class="error">
                <?= htmlspecialchars($errors['batiment'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <br>

    <div>
        <label for="capacite">Capacité</label><br>
        <input
            type="number"
            id="capacite"
            name="capacite"
            value="<?= htmlspecialchars((string) ($data['capacite'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (!empty($errors['capacite'])): ?>
            <p class="error">
                <?= htmlspecialchars($errors['capacite'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <br>

    <div>
        <label for="type">Type</label><br>

        <select id="type" name="type">
            <option value="">-- Choisir --</option>

            <?php
            $types = [
                'cours',
                'informatique',
                'laboratoire',
                'amphitheatre',
                'reunion'
            ];
            ?>

            <?php foreach ($types as $type): ?>
                <option
                    value="<?= htmlspecialchars($type, ENT_QUOTES, 'UTF-8') ?>"
                    <?= (($data['type'] ?? '') === $type) ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($type, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>

        <?php if (!empty($errors['type'])): ?>
            <p class="error">
                <?= htmlspecialchars($errors['type'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <br>

    <div>
        <label>
            <input
                type="checkbox"
                name="active"
                <?= !empty($data['active']) ? 'checked' : '' ?>
            >
            Salle active
        </label>

        <?php if (!empty($errors['active'])): ?>
            <p class="error">
                <?= htmlspecialchars($errors['active'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <br>

    <button type="submit">
        <?= $isEdit ? 'Modifier' : 'Créer' ?>
    </button>

    <a href="/salles">Annuler</a>

</form>

<?php
$content = ob_get_clean();

require __DIR__ . '/../layout/base.php';
?>
