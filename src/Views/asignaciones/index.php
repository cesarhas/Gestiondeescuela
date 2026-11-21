<div class="toolbar">
    <h1>Asignaciones</h1>
    <a class="btn" href="<?= url('asignaciones/create') ?>">Nuevo</a>
</div>

<?php if (empty($items)): ?>
    <p>No hay registros.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
            <th>Asignacion id</th>
            <th>Estudiante id</th>
            <th>Profesor id</th>
            <th>Materia</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
            <td><?= e($item->asignacion_id) ?></td>
            <td><?= e($item->estudiante_id) ?></td>
            <td><?= e($item->profesor_id) ?></td>
            <td><?= e($item->materia) ?></td>
                <td class="actions">
                    <a href="<?= url('asignaciones/edit/' . $item->asignacion_id) ?>">Editar</a>

                    <form method="post"
                          action="<?= url('asignaciones/delete/' . $item->asignacion_id) ?>"
                          onsubmit="return confirm('Eliminar este registro?')">
                        <button class="link danger" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
