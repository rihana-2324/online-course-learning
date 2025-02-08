<?php

include '../db.php'; 
include 'navbar.php';

// Start the session and check if user is logged in

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];  // Get the logged-in user's ID
$user_role = $_SESSION['role'];  // Get the logged-in user's role

// Modify the query based on the user's role
if ($user_role == 'admin') {
    $query = "SELECT * FROM courses";  // Admin can see all courses
} elseif ($user_role == 'teacher') {
    // Teacher can see only their own courses
    $query = "SELECT * FROM courses WHERE created_by = ?";
}
else {
    echo"no course found";
    exit;
}
$stmt = mysqli_prepare($conn, $query);

// Bind parameters if the user is a teacher
if ($user_role == 'teacher') {
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$courses = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];

    if (!empty($course_id)) {
        $delete_query = "DELETE FROM courses WHERE course_id = ?";
        $stmt = mysqli_prepare($conn, $delete_query);
        mysqli_stmt_bind_param($stmt, 'i', $course_id);

        if (mysqli_stmt_execute($stmt)) {
            echo header("Refresh:0");
            exit;
        } else {
            echo "Error deleting course: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Course ID is required.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkm6Yc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
             /* Light sky blue background */
            padding-top: 20px;
            background-color:rgb(207, 238, 236) ;
        }
        .card {
            background-color:rgb(190, 198, 199);
            border: 2px solid ; /* Sky blue border */
            border-radius: 10px;
            margin:10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: scale(1.02); /* Slight zoom on hover */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            color: #4682b4; /* Steel blue for title */
            font-weight: bold;
            text-align: center;
        }
        .btn-primary {
            background-color: #4682b4; /* Steel blue */
            border: none;
        }
        .btn-danger {
            background-color: #ff6347; /* Tomato red */
            border: none;
        }
        .btn {
            margin: 5px 0;
            width: 100%;
        }
        .card img {
            object-fit: cover;
            height: 150px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
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
            color: #dc3545; /* Danger red for no courses */
            font-weight: bold;
        }
        .card-body p {
            margin-bottom: 10px; /* Add space between paragraphs */
        }
        .card-body hr {
            border: 0;
            border-top: 1px solid #4682b4; /* Steel blue horizontal line */
            margin: 10px 0;
        }
        .course-box {
            border: 1px solid skyblue;
            border-radius: 10px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 20px;
        }
        .course-box:hover {
            background-color:rgb(206, 245, 250);
        }
        .course-box a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
    </style>
</head>

<body>
       <!-- Header Buttons in Boxes -->
<div class="container mt-4">
    <div class="row justify-content-center">
        
            <div class="course-box">
                <h3>Course List</h3>
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
                                <hr>
                                <p class="card-text">Description: <?php echo $course['description']; ?></p>
                                <hr>
                                <p class="card-text">Duration: <?php echo $course['duration']; ?> hours</p>
                                <hr>
                                <form method="post">
                                    <input type="hidden" name="course_id" value="<?php echo $course['course_id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <form action="editcourse.php" method="get">
                                    <input type="hidden" name="course_id" value="<?php echo $course['course_id']; ?>">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h1 class="text-center no-courses">Sorry, No Courses Found. Please create a new course.</h1>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
   
</body>
</html>
