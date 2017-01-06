<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/admin.css')); ?>" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <header>
            <?php if(Auth::check()): ?>
                <?php
                    $menuConfig = [
                        'name' => Auth::user()->name,
                        'menus' => [
                            ['name' => 'Bancos', 'url' => route('admin.banks.index'), 'active' => isRouteActive('admin.banks.index')],
                            ['name' => 'Contas a pagar', 'url' => '/bill-pay', 'dropdownId' => 'bill-pay'],
                            ['name' => 'Contas a receber', 'url' => '/bill-receive', 'dropdownId' => 'bill-receive']
                        ],
                        'menusDropdown' => [
                            [
                                'id' => 'bill-pay',
                                'items' => [
                                    ['name' => 'Listar contas', 'url' => '/listar'],
                                    ['name' => 'Criar conta', 'url' => '/criar']
                                ]
                            ],
                            [
                                'id' => 'bill-receive',
                                'items' => [
                                    ['name' => 'Listar contas', 'url' => '/listar'],
                                    ['name' => 'Criar conta', 'url' => '/criar']
                                ]
                            ]
                        ],
                        'urlLogout' => env('URL_ADMIN_LOGOUT'),
                        'csrfToken' => csrf_token()
                    ]
                ?>
                <admin-menu :config="<?php echo e(json_encode($menuConfig)); ?>"></admin-menu>
            <?php endif; ?>
        </header>

        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <footer class="page-footer">
            <div class="footer-copyright">
                <div class="container">
                    &copy; <?php echo e(date('Y')); ?> <a class="grey-text text-lighten-4" href="#">Financial System</a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="<?php echo e(asset('build/admin.bundle.js')); ?>"></script>
</body>
</html>
