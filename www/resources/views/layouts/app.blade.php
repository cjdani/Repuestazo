<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Repuestazo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .sidebar {
            width: 260px;
            background-color: #002b5c;
            color: white;
            min-height: 100vh;
            transition: width 0.3s;
        }
        .sidebar.collapsed {
            width: 80px;
        }
        .sidebar .nav-link {
            color: #ddd;
        }
        .sidebar .nav-link:hover {
            background-color: #003b80;
            color: white;
        }
        .sidebar.collapsed .nav-text {
            display: none;
        }
    </style>
</head>
<body class="d-flex">

@include('templates.left-menu')

<div class="flex-grow-1">
    @include('templates.header')

    <main class="container mt-4">
        @yield('content')
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('toggle-menu').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    });
</script>

@yield('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
