<div class="toolbar">
    <h1>Profesores</h1>
    <a class="btn" href="<?= url('profesores/create') ?>">Nuevo</a>
</div>

<?php if (empty($items)): ?>
    <p>No hay registros.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
            <th>Profesor id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Especialidad</th>
            <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
            <td><?= e($item->profesor_id) ?></td>
            <td><?= e($item->nombre) ?></td>
            <td><?= e($item->apellido) ?></td>
            <td><?= e($item->especialidad) ?></td>
            <td><?= e($item->email) ?></td>
                <td class="actions">
                    <a href="<?= url('profesores/edit/' . $item->profesor_id) ?>">Editar</a>

                    <form method="post"
                          action="<?= url('profesores/delete/' . $item->profesor_id) ?>"
                          onsubmit="return confirm('Eliminar este registro?')">
                        <button class="link danger" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
