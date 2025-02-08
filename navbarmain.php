<?php
// You can include PHP logic here if needed, such as authentication checks or dynamic data
$currentFile = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navbar Custom CSS */
        .navbar {
            background-color: skyblue;
            padding: 10px 0;
        }

        .navbar .logo {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        .navbar-nav .nav-item .nav-link {
            color: #000;
            font-size: 16px;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #007bff;
            text-decoration: none;
        }

        .navbar-nav .dropdown-menu {
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .dropdown-item {
            font-size: 14px;
            padding: 10px;
            color: #333;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar-nav .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .logout-btn {
            background-color: skyblue;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #007bff;
            color: white;
        }
        .collapse-navbar.navbar-nav {
            margin-left: 50px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <img src="img/logo.jpg" alt="Admin Logo" class="logo">
            <a class="navbar-brand" href="#">eLearning</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="allcourses.php">Courses</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#about">About</a></li>
                    <li class="nav-item">
                        <?php if ($currentFile == 'mycourse.php'): ?>
                            <a class="btn logout-btn" href="index.php">Logout</a>
                        <?php else: ?>
                            <a class="btn logout-btn" href="../admin/login.php">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
