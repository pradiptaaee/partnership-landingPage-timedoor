<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Partnership</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #2d3e50;
            padding: 20px;
            color: white;
        }

        .sidebar a {
            color: #d9e3f0;
            text-decoration: none;
            display: block;
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background: #1b2735;
        }

        .content-wrapper {
            margin-left: 270px;
            padding: 30px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            /* smooth scroll */
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4 class="fw-bold mb-4">Timedoor Academy</h4>

        <a href="{{ route('admin.partners.index') }}">📌 Partner List</a>
        <hr style="border-color: #45586b;">
        <a href="#">⚙ Settings</a>
        <a href="#">📊 Analytics</a>
    </div>

    <div class="content-wrapper">
        @yield('content')
    </div>

</body>

</html>
