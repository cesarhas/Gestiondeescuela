<h1><?= e($title) ?></h1>

<form method="post" action="<?= url($action) ?>">
    <div class="field">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" maxlength="50" value="<?= e($entity->nombre) ?>" required>
        <?php if (isset($errors['nombre'])): ?>
            <small class="error"><?= e($errors['nombre']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" maxlength="50" value="<?= e($entity->apellido) ?>" required>
        <?php if (isset($errors['apellido'])): ?>
            <small class="error"><?= e($errors['apellido']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="especialidad">Especialidad</label>
        <input type="text" id="especialidad" name="especialidad" maxlength="100" value="<?= e($entity->especialidad) ?>" required>
        <?php if (isset($errors['especialidad'])): ?>
            <small class="error"><?= e($errors['especialidad']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" maxlength="100" value="<?= e($entity->email) ?>" required>
        <?php if (isset($errors['email'])): ?>
            <small class="error"><?= e($errors['email']) ?></small>
        <?php endif; ?>
    </div>

    <div class="buttons">
        <button class="btn" type="submit">Guardar</button>
        <a href="<?= url('profesores') ?>">Cancelar</a>
    </div>
</form>
