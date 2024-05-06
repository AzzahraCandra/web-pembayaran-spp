<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web SPP SMA PGRI 3 Bandung</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Use asset() to link to your CSS file -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500');

        body {
            overflow-x: hidden;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            padding-top: 58px; /* Add padding-top for fixed navbar */
        }

        /* Toggle Styles */

        #viewport {
            padding-left: 250px;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        #content {
            width: 100%;
            position: relative;
            margin-right: 0;
        }

        /* Sidebar Styles */

        #sidebar {
            z-index: 1000;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            overflow-y: auto;
            background: #37474F;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        #sidebar header {
            background-color: #263238;
            font-size: 20px;
            line-height: 52px;
            text-align: center;
        }

        #sidebar header a {
            color: #fff;
            display: block;
            text-decoration: none;
        }

        #sidebar header a:hover {
            color: #fff;
        }

        #sidebar .nav {}

        #sidebar .nav a {
            background: none;
            border-bottom: 1px solid #455A64;
            color: #CFD8DC;
            font-size: 14px;
            padding: 16px 24px;
        }

        #sidebar .nav a:hover {
            background: none;
            color: #ECEFF1;
        }

        #sidebar .nav a i {
            margin-right: 16px;
        }

        /* Navbar Styles */

        .navbar {
            background-color: #fff;
            z-index: 900; /* Ensure navbar is above sidebar */
            position: fixed;
            top: 0;
            left: 250px; /* Same as sidebar width */
            right: 0;
        }

        /* Separate Navbar Container */
        .navbar-container {
            padding-top: 58px; /* Adjust padding to avoid overlapping with navbar */
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar">
        @include('Component.navbar')
    </div>
    
    <!-- Separate Navbar Container -->
    <div class="navbar-container">
        <!-- Main content container -->
        <div class="content-container" id="viewport">
            @yield('content')
        </div>
        
        @include('Component.footer')
    </div>

    <script src="/js/bootstrap.js"></script>
</body>

</html>
