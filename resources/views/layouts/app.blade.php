<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
        }
        
        header {
            background-color: #1e3a8a; /* Maroon - assuming university color */
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo img {
            height: 40px;
        }
        
        .breadcrumb {
            padding: 15px 0;
            color: #666;
        }
        
        .breadcrumb a {
            color: #1e3a8a;
            text-decoration: none;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        footer {
            padding: 20px;
            text-align: center;
            background-color: #1e3a8a;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="/api/placeholder/40/40" alt="RUN Logo">
            <h1>Redeemer's University</h1>
        </div>
        <div class="user-nav">
            <div class="user-info">
                <span class="user-name">John Doe</span>
                <div class="user-avatar">JD</div>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="breadcrumb">
            @yield('breadcrumb')
        </div>
        
        <main>
            @yield('content')
        </main>
    </div>

    <footer>
        <!-- Common footer content -->
        &copy; 2025 Redeemer's University. All rights reserved.
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>