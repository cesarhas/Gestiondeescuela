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
        <label for="fecha_nacimiento">Fecha nacimiento</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= e($entity->fecha_nacimiento) ?>" required>
        <?php if (isset($errors['fecha_nacimiento'])): ?>
            <small class="error"><?= e($errors['fecha_nacimiento']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="grado">Grado</label>
        <input type="text" id="grado" name="grado" maxlength="20" value="<?= e($entity->grado) ?>" required>
        <?php if (isset($errors['grado'])): ?>
            <small class="error"><?= e($errors['grado']) ?></small>
        <?php endif; ?>
    </div>

    <div class="buttons">
        <button class="btn" type="submit">Guardar</button>
        <a href="<?= url('estudiantes') ?>">Cancelar</a>
    </div>
</form>
