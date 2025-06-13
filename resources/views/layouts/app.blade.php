<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Vehicle Hire')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        .sidebar {
            width: 220px;
            background-color: #333;
            color: #fff;
            flex-shrink: 0;
            height: 100vh;
            position: fixed;
        }

        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #444;
            margin: 0;
            font-size: 20px;
        }

        .sidebar nav {
            padding: 10px;
        }

        .sidebar nav a {
            display: block;
            padding: 10px 15px;
            color: #ccc;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 5px;
        }

        .sidebar nav a:hover {
            background-color: #555;
            color: #fff;
        }

        .main {
            margin-left: 220px;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background-color: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .topbar .auth-links a {
            margin-left: 15px;
            color: #333;
            text-decoration: none;
        }

        .topbar .auth-links form {
            display: inline;
        }

        .content {
            padding: 20px;
            background-color: #f9f9f9;
            flex: 1;
        }

        .logout-button {
            background: none;
            border: none;
            color: #c00;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>HireZone</h2>
        <nav>
            <a href="{{ route('vehicles.index') }}">Browse Vehicles</a>
            @auth
                <a href="{{ route('vehicles.create') }}">Post Vehicle</a>
                <a href="#">My Listings</a>
            @endauth
        </nav>
    </div>

    <div class="main">
        <div class="topbar">
            <h1>@yield('page_title', '')</h1>
            <div class="auth-links">
                @auth
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                @else
                    {{-- <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a> --}}
                @endauth
            </div>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>

</body>
</html>
