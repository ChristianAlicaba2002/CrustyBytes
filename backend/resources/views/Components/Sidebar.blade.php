<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sidebar</title>
</head>

<body>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background-color: orange;
            padding: 20px;
            width: 240px;
            float: left;
            min-height: 100vh;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin-top: 7rem;
        }

        .sidebar ul li {
            margin-bottom: 1.5rem;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 1.3rem;
        }

        .sidebar ul li a:hover {
            color: #ffffff;
        }

        .isActive {
            color: #ff6600;
            font-weight: bold;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: -2rem;
        }

        .logo img {
            border-radius: 50%;
            width: 50%;
            height: 55%;
            text-align: center;
        }
    </style>
    <div class="sidebar">
        <div class="logo">
            <img src="../../../assets/logo.webp" alt="Logo">
        </div>
        <ul>
            <li>
                <a class="{{ request()->is('admin.dashboard') ? 'isActive' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li><a href="#">User Management</a></li>
            <li><a href="#">Product Orders</a></li>
            <li><a href="{{ route('admin.archive') }}">Archive Products</a></li>
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
    </div>

</body>

</html>
