<?php
session_start();
include '../db.php'; // Ensure this file contains your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT user_id, role FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $role);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role; // Store the role in the session

        // Redirect based on user role
        if ($role === 'teacher' || $role === 'admin') {
            header("Location: dashboard.php");
        } elseif ($role === 'student') {
            header("Location: /banu/homepage/mycourse.php");
        } else {
            echo "Invalid user role.";
        }
        exit();
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(207, 238, 236);
        }
        .btn-purple {
            background-color: black;
            color: white;
            border: none;
        }
        .btn-purple:hover {
            background-color: darkturquoise;
        }
        .login-form {
            border: 2px solid skyblue;
            padding: 30px;
            border-radius: 10px;
            background-color: rgb(182, 189, 188);
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .full-height {
            height: 100vh;
        }
        .form-control {
            height: 45px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center full-height">
        <div class="col-md-6 col-lg-4">
            <h2 class="text-center mb-4" style="color: white;">LOGIN</h2>
            <form action="" method="post" class="login-form">
                <div class="form-group">
                    <label for="username" style="color: white;">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password" style="color: white;">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-purple btn-block">Login</button>
                </div>
            </form>
            <center><a href="/banu/homepage/allcourses.php" style="color: black;">Don't have an account? Register Course here</a></center>
        </div>
    </div>
</body>
</html>
