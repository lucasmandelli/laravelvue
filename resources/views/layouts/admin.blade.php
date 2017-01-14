<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

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
            @if (Auth::check())
                <?php
                    $menuConfig = [
                        'name' => Auth::user()->name,
                        'menus' => [
                            ['name' => 'Banks', 'url' => route('admin.banks.index'), 'active' => isRouteActive('admin.banks.index')],
                            /*['name' => 'Contas a pagar', 'url' => '/bill-pay', 'dropdownId' => 'bill-pay'],
                            ['name' => 'Contas a receber', 'url' => '/bill-receive', 'dropdownId' => 'bill-receive']*/
                        ],
                        /*'menusDropdown' => [
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
                        ],*/
                        'urlLogout' => env('URL_ADMIN_LOGOUT'),
                        'csrfToken' => csrf_token()
                    ]
                ?>
                <admin-menu :config="{{ json_encode($menuConfig) }}"></admin-menu>
            @endif
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="page-footer">
            <div class="footer-copyright">
                <div class="container">
                    &copy; {{ date('Y') }} <a class="grey-text text-lighten-4" href="#">Financial System</a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('build/admin.bundle.js') }}"></script>
</body>
</html>
