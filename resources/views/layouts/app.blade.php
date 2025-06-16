<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Vehicle Hire')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h2>🚗 Vehicle Hire</h2>
        <nav>
            {{-- General Menus (All Users) --}}
            <a href="{{ route('vehicles.index') }}">🏠 Home</a>
            <a href="#">🔍 Search Vehicles</a>
            <a href="#">📍 Browse by Location</a>
            <a href="#">🚘 Vehicle Types</a>
            <a href="#">📖 FAQs </a>
            <a href="#">📞 Contact / Support</a>
            <a href="#">🌍 About Us</a>
    
            {{-- Logged-In Hirer Menus --}}
            @auth
                @if(auth()->user()->role === 'hirer')
                    <hr>
                    <strong>👤 Hirer</strong>
                    <a href="#">📅 My Bookings</a>
                    <a href="#">❤️ Saved Vehicles</a>
                    <a href="#">💳 Payment History</a>
                    <a href="#">🔔 Notifications</a>
                    <a href="#">✉️ Messages</a>
                    <a href="#">📝 My Reviews</a>
                    <a href="#">👤 Profile Settings</a>
                @endif
    
                {{-- Vehicle Owner Menus --}}
                @if(auth()->user()->role === 'owner')
                    <hr>
                    <strong>🚗 Vehicle Owner</strong>
                    <a href="{{ route('vehicles.create') }}">📤 Post a Vehicle</a>
                    <a href="{{ route('vehicles.my') }}">🚗 My Vehicles</a>
                    <a href="{{ route('bookings.requests') }}">📥 Booking Requests</a>
                    <a href="{{ route('availability.schedule') }}">📆 Availability Schedule</a>
                    <a href="{{ route('reviews.received') }}">⭐ Ratings & Reviews</a>
                    <a href="{{ route('earnings') }}">💰 My Earnings</a>
                    <a href="{{ route('verification.status') }}">🛡️ Verification Status</a>
                    <a href="{{ route('profile.settings') }}">👤 Profile Settings</a>
                @endif
    
                {{-- Admin Menus --}}
                @if(auth()->user()->role === 'admin')
                    <hr>
                    <strong>⚙️ Admin Panel</strong>
                    <a href="{{ route('admin.users') }}">👥 Manage Users</a>
                    <a href="{{ route('admin.vehicles') }}">🚐 Manage Vehicles</a>
                    <a href="{{ route('admin.analytics') }}">📊 Booking Analytics</a>
                    <a href="{{ route('admin.payouts') }}">💸 Payout Requests</a>
                    <a href="{{ route('admin.verifications') }}">📝 Vehicle Verifications</a>
                    <a href="{{ route('admin.flags') }}">🚩 Flagged Content</a>
                    <a href="{{ route('admin.audits') }}">📚 Audit Logs</a>
                    <a href="{{ route('admin.settings') }}">⚙️ Site Settings</a>
                @endif
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
