<h1><?= e($title) ?></h1>

<form method="post" action="<?= url($action) ?>">
    <div class="field">
        <label for="estudiante_id">Estudiante id</label>
        <input type="number" id="estudiante_id" name="estudiante_id" step="1" value="<?= e($entity->estudiante_id) ?>">
        <?php if (isset($errors['estudiante_id'])): ?>
            <small class="error"><?= e($errors['estudiante_id']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="profesor_id">Profesor id</label>
        <input type="number" id="profesor_id" name="profesor_id" step="1" value="<?= e($entity->profesor_id) ?>">
        <?php if (isset($errors['profesor_id'])): ?>
            <small class="error"><?= e($errors['profesor_id']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="materia">Materia</label>
        <input type="text" id="materia" name="materia" maxlength="100" value="<?= e($entity->materia) ?>" required>
        <?php if (isset($errors['materia'])): ?>
            <small class="error"><?= e($errors['materia']) ?></small>
        <?php endif; ?>
    </div>

    <div class="buttons">
        <button class="btn" type="submit">Guardar</button>
        <a href="<?= url('asignaciones') ?>">Cancelar</a>
    </div>
</form>
