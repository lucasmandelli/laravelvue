<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/spa.css')); ?>" rel="stylesheet">

</head>
<body>
    <app></app>
    <!-- Scripts -->
    <script src="<?php echo e(asset('build/spa.bundle.js')); ?>"></script>
</body>
</html>
