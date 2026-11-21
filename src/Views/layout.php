<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= e($title ?? 'App') ?> - <?= e(\App\Core\Env::get('APP_NAME', 'App')) ?></title>

    <link rel="stylesheet" href="<?= url('css/style.css') ?>"> 
</head>
<body>
<nav>
    <a href="<?= url('') ?>">Inicio</a>
    <a href="<?= url('estudiantes') ?>">Estudiantes</a>
    <a href="<?= url('profesores') ?>">Profesores</a>
    <a href="<?= url('asignaciones') ?>">Asignaciones</a>
    <!-- MENU -->
</nav>

<main>
    <?php if ($flash = \App\Core\Flash::pull()): ?>
        <div class="flash <?= e($flash['t']) ?>">
            <?= e($flash['m']) ?>
        </div>
    <?php endif; ?>

    <?= $content ?>
</main>
</body>
</html>
