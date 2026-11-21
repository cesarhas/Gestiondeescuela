<div class="toolbar">
    <h1>Estudiantes</h1>
    <a class="btn" href="<?= url('estudiantes/create') ?>">Nuevo</a>
</div>

<?php if (empty($items)): ?>
    <p>No hay registros.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
            <th>Estudiante id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha nacimiento</th>
            <th>Grado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
            <td><?= e($item->estudiante_id) ?></td>
            <td><?= e($item->nombre) ?></td>
            <td><?= e($item->apellido) ?></td>
            <td><?= e($item->fecha_nacimiento) ?></td>
            <td><?= e($item->grado) ?></td>
                <td class="actions">
                    <a href="<?= url('estudiantes/edit/' . $item->estudiante_id) ?>">Editar</a>

                    <form method="post"
                          action="<?= url('estudiantes/delete/' . $item->estudiante_id) ?>"
                          onsubmit="return confirm('Eliminar este registro?')">
                        <button class="link danger" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
