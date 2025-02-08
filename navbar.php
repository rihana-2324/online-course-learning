<?php
session_start();

// Get the current page name (e.g., "dashboard.php")
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .logo {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .navbar {
            background-color: skyblue;
            height: 80px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand span {
            margin-left: 10px;
        }
        .offcanvas-body {
            background-color: rgb(207, 238, 236);
        }
       
        .search-form {
            display: flex;
            align-items: center;
            margin-left: 500px;
        }
        .search-form input {
            margin-right: 10px;
            width: 500px; /* Adjust the width as needed */
        }
        .search-form button {
           
            width: 100px; /* Adjust the width as needed */
            height: 35px;
            display: flex;
            align-items: center;
        }
    </style> 
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="adminlogo.png" alt="Admin Logo" class="logo">
            <span>Admin</span>
        </a>
        <form class="search-form" role="search">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
           <button class="btn btn-outline-primary" type="submit"><center>Search</center>
        </button>
        </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <?php if ($current_page != 'dashboard.php'): ?>
                        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <?php endif; ?>
                    <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher'): ?>
                        <?php if ($current_page != 'createcourse.php'): ?>
                            <li class="nav-item"><a class="nav-link" href="createcourse.php">Create Course</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($current_page != 'viewcourse.php'): ?>
                        <li class="nav-item"><a class="nav-link" href="viewcourse.php">View Course</a></li>
                    <?php endif; ?>
                    <?php if ($current_page != 'viewfeedbackcourse.php'): ?>
                        <li class="nav-item"><a class="nav-link" href="viewfeedbackcourse.php">View Feedback</a></li>
                    <?php endif; ?>
                    <?php if ($current_page != 'settings.php'): ?>
                        <li class="nav-item"><a class="nav-link" href="settings.php">Settings</a></li>
                    <?php endif; ?>
                    <?php if ($current_page != 'logout.php'): ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
</body>
</html>
