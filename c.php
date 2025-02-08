<?php
require_once '../db.php';
require_once 'payment.php'; // Ensure this file has the correct database connection

// Fetch course price from Courses table (assuming Python course has course_id = 2)
$course_id = 5; // Assuming course_id for Python
$stmt = $conn->prepare("SELECT price FROM Courses WHERE course_id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$stmt->bind_result($course_price);
$stmt->fetch();
$stmt->close();

// Check if email exists via AJAX request
if (isset($_GET['email_check'])) {
    $email = $_GET['email_check'];
    $stmt = $conn->prepare("SELECT user_id FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();
    echo json_encode(['exists' => $user_id ? true : false]);
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $amount = $course_price * 100; // Convert to smallest currency unit

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT user_id FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if (!$user_id) {
        // If user does not exist, they must provide a password
        if (!$password) {
            echo "<script>alert('Please enter a password to register.'); window.history.back();</script>";
            exit();
        }

        $role = 'student'; // Default role for new users
        $stmt = $conn->prepare("INSERT INTO Users (username, email, password, role, phonenumber) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $password, $role, $phone);
        if ($stmt->execute()) {
            $user_id = $stmt->insert_id; // Get newly created user ID
        } else {
            echo "<script>alert('Error registering user. Please try again.'); window.history.back();</script>";
            exit();
        }
        $stmt->close();
    }

    // Check if the user is already enrolled in the course
    $stmt = $conn->prepare("SELECT enrollment_id FROM enrollments WHERE student_id = ? AND course_id = ?");
    $stmt->bind_param("ii", $user_id, $course_id);
    $stmt->execute();
    $stmt->bind_result($enrollment_id);
    $stmt->fetch();
    $stmt->close();

    if (!$enrollment_id) {
        // Enroll user in the course
        $stmt = $conn->prepare("INSERT INTO enrollments (student_id, course_id, status, price, phonenumber) VALUES (?, ?, 'pending', ?, ?)");
        $stmt->bind_param("iids", $user_id, $course_id, $course_price, $phone);
        if ($stmt->execute()) {
            $enrollment_id = $stmt->insert_id;
            $reference_id = "payment-" . $enrollment_id;

            // Generate payment link
            $response = generatepaymentlink($name, $amount, $email, $reference_id, $phone);
            if (isset($response['short_url'])) {
                $payment_id = $response['id'];

                // Update payment ID in the enrollments table
                $stmt = $conn->prepare("UPDATE enrollments SET payment_id = ? WHERE enrollment_id = ?");
                $stmt->bind_param("si", $payment_id, $enrollment_id);
                $stmt->execute();
                $stmt->close();

                echo "<script>
                        alert('Enrollment successful. Please complete the payment to start the course.');
                        window.location.href='" . $response['short_url'] . "';
                      </script>";
            } else {
                echo "<script>alert('Error generating payment link.');</script>";
            }
        } else {
            echo "<script>alert('Error during enrollment.');</script>";
        }
    } else {
        echo "<script>alert('You are already enrolled in this course.');</script>";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enroll in Python Course</title>
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
              <div class="col-md-10 col-lg-6 col-xl-5">
                <center><p class="text-center h1 fw-bold mb-5">Register</p></center>
                <form id="enrollForm" method="POST">
                  <div class="mb-3">
                    <label for="name" class="form-label">* Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">* Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email" required>
                  </div>
                  <div class="mb-3">
                    <label for="phone" class="form-label">* Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your Phone Number" required>
                  </div>
                  <div class="mb-3" id="passwordContainer">
                    <label for="password" class="form-label">* Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter a Password (For new users)">
                  </div>
                  <div class="mb-3">
                    <label for="courses" class="form-label">* Course Name</label>
                    <input type="text" class="form-control" id="courses" name="courses" value="C" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="price" class="form-label">* Price (₹)</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $course_price; ?>" readonly>
                  </div>
                  <button type="submit" class="btn btn-primary w-100">Pay Now</button>
                </form>
              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center">
                <img src="img/cat-2.jpg" class="img-fluid" alt="Course image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
// Auto-detect existing users and show/hide password field
document.getElementById('email').addEventListener('blur', function() {
    var email = this.value;
    var passwordField = document.getElementById('passwordContainer');

    if (email !== '') {
        fetch('python.php?email_check=' + email)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    passwordField.style.display = 'none'; // Hide password field for existing users
                } else {
                    passwordField.style.display = 'block'; // Show password field for new users
                }
            });
    }
});
</script>
</script>
</body>
</html>