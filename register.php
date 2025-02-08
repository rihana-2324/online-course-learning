<?php
require_once '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = $_POST['username'];
  $email = $_POST['email'];
  $phonenumber = $_POST['phonenumber'];
  $password = $_POST['password']; // Use the plain password

  $stmt = $conn->prepare("INSERT INTO users (name, email, phonenumber, password) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $phonenumber, $password);

  if ($stmt->execute()) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $stmt->error;
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
  <title>Student Registration Form</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #eee;
    }

    .vh-100 {
        height: 100vh;
    }

    .container {
        max-width: 1200px;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 25px;
    }

    .form-outline {
        position: relative;
    }

    .form-outline .form-control {
        border-radius: 0.25rem;
        padding: 0.75rem;
    }

    .form-outline .form-label {
        position: absolute;
        top: -0.75rem;
        left: 0.75rem;
        background-color: #fff;
        padding: 0 0.25rem;
        font-size: 0.875rem;
        color: #495057;
    }

    .form-check-label a {
        color: #007bff;
        text-decoration: none;
    }

    .form-check-label a:hover {
        text-decoration: underline;
    }

    .btn-primary {
        background-color: skyblue;
        border-color: skyblue;
    }

    .btn-primary:hover {
        background-color: #007bff;
        border-color: #007bff;
    }
  </style>
</head>
<body>
<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>

                <form class="mx-1 mx-md-4" id="registerForm" method="POST" action="register.php">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="username" id="username" class="form-control" required />
                      <label class="form-label" for="username">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" name="email" id="email" class="form-control" required />
                      <label class="form-label" for="email">Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" name="password" id="password" class="form-control" required />
                      <label class="form-label" for="password">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="phonenumber" id="phonenumber" class="form-control" required />
                      <label class="form-label" for="phonenumber">Phone Number</label>
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-right mb-5">
                    <input class="form-check-input me-2" type="checkbox" id="terms" required />
                    <label class="form-check-label" for="terms">
                      I agree to all statements in <a href="#">Terms of Service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                <img src="img/cat-2.jpg"
                  class="img-fluid" alt="Sample image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
