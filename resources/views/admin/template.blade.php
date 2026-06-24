<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Web Profile')</title>
    <link href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css">
    <script>
    const API_TOKEN = "{{ session('api_token') }}";
    console.log("API Token:", API_TOKEN);
    </script>
</head>

<style>
    body {
        background-color: #f8f9fa;
    }

    .sidebar {
    width: 200px;
    min-height: 100vh;
    background-color: #343a40;
    position: fixed;
    top: 56px;
}

    .sidebar a {
        display: block;
        color: #fff;
        padding: 10px 15px;
        text-decoration: none;
    }
.sidebar a:hover {
        background-color: #495057;
    }

    .content {
        margin-top: 70px;
        margin-left: 250px;
        padding: 20px;
    }

    .card {
        border: 0;
        border-radius: 10px;
    }
</style>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-warning fixed-top shadow-sm px-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('bootstrap-5.3.8-dist/images/logo.png') }}" alt="Logo" height="45">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ Auth::user()->name }}
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
    <li class="dropdown-item-text text-muted">
        <small>{{ Auth::user()->email }}</small>
    </li>
    <li>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="dropdown-item">Logout</button>
                         </form>
                    </li>
                </ul>
             </li>
            </ul>
        </div>
    </div>
</nav>

<div class="sidebar shadow-sm">
    <h5 class="text-center text-white py-3">Admin Menu</h5>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('projects.index') }}">Data Project</a>
    <a href="{{ route('admin.users') }}">Data Users</a>
</div>

<div class="content p-3 d-flex flex-column">
        <div class="flex-grow-1">
            @yield('content')
        </div>
    </div>

    <!-- footer -->
<footer class="bg-white text-dark text-center border-top py-3 mt-5">
        <p class="mb-0">&copy; 2026 MyProfile. All rights reserved.</p>
        </footer>

    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
    @yield('scripts')
</body>

</html>