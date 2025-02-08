<?php
include '../db.php'; // Database connection
include 'navbar.php';

// Assuming user is logged in and the session contains the user's ID and role
$user_id = $_SESSION['user_id']; // The logged-in user's ID
$role = $_SESSION['role']; // The logged-in user's role (admin, teacher, student)

// Check if the logged-in user is an admin or a teacher
switch ($role) {
    case 'admin':
        // Admin can view all courses and feedback
        $query = "SELECT * FROM courses";
        break;
    case 'teacher':
        // Teacher can only view courses they created
        $query = "SELECT * FROM courses WHERE created_by = ?";
        break;
    default:
        echo "No feedback found"; // Output a message if no feedback is found
        exit; // Exit the script
}

$stmt = mysqli_prepare($conn, $query); // Prepare an SQL statement for execution

if ($role == 'teacher') {
    mysqli_stmt_bind_param($stmt, 'i', $user_id); // Bind the teacher's user_id to the query as an integer
}
mysqli_stmt_execute($stmt); // Execute the prepared statement
$result = mysqli_stmt_get_result($stmt); // Get the result set from the executed statement

$courses = []; // Initialize an empty array to store course data

if (mysqli_num_rows($result) > 0) { // Check if there are any rows in the result set
    while ($row = mysqli_fetch_assoc($result)) { // Fetch each row as an associative array
        $courses[] = $row; // Add the row to the courses array
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkm6Yc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
    #body {
        background-color:rgb(207, 238, 236) ; /* Light purple background */
    }
    .card {
        background-color:rgb(190, 198, 199);
        border: 2px solid;
        border-radius: 10px;
        margin: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
    .card-title {
        color: #4682b4;
        font-weight: bold;
        text-align: center;
    }
    .btn-primary {
        background-color: #4682b4;
        border: none;
    }
    .row {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
    }
    .no-courses {
        margin-top: 50px;
        color: #dc3545;
        font-weight: bold;
    }
    .card img {
        object-fit: cover;
        height: 150px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .course-box {
        border: 1px solid skyblue;
        border-radius: 10px;
        padding: 10px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        margin-top: 40px;
    }
    .course-box:hover {
        background-color: rgb(188, 228, 233);
    }
    .course-box a {
        text-decoration: none;
        color: black;
        font-weight: bold;
    }
</style>
</head>
<body id="body">
    <!-- Header Buttons in Boxes -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="course-box">
                <h3>Course Feedback</h3>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card">
                            <img src="<?php echo $course['thumbnail']; ?>" class="card-img-top" alt="Course Thumbnail">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $course['title']; ?></h5>
                                <p class="card-text">Duration: <?php echo $course['duration']; ?> hours</p>
                                <p class="card-text"><?php echo $course['description']; ?></p>
                                <form action="viewfeedback.php" method="get">
                                    <input type="hidden" name="course_id" value="<?php echo $course['course_id']; ?>">
                                    <button type="submit" class="btn btn-primary">View Feedback</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h1 class="text-center no-courses">No courses found. Please add a new course.</h1>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>
