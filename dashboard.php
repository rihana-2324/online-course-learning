<?php
// Include database connection
include '../db.php'; // Adjust path if needed
include 'navbar.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit;
}

// Retrieve user details from session
$userId = $_SESSION['user_id'];
$userRole = $_SESSION['role'];

// Function to get row count
function getRowCount($conn, $tableName, $condition = '') {
    $sql = "SELECT COUNT(*) as count FROM $tableName $condition";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    return 0;
}

// Initialize counts
$coursesCount = $feedbackCount = $enrollmentCount = $teachersCount = $studentsCount = 0;

// Fetch counts based on user role
if ($userRole == 'admin') {
    $coursesCount = getRowCount($conn, 'courses');
    $feedbackCount = getRowCount($conn, 'feedback');
    $enrollmentCount = getRowCount($conn, 'enrollments');
    $teachersCount = getRowCount($conn, 'users', "WHERE role = 'teacher'");
    $studentsCount = getRowCount($conn, 'users', "WHERE role = 'student'");
} elseif ($userRole == 'teacher') {
    $coursesCount = getRowCount($conn, 'courses', "WHERE created_by = $userId");
    $feedbackCount = getRowCount($conn, 'feedback', "WHERE course_id IN (SELECT course_id FROM courses WHERE created_by = $userId)");
    $enrollmentCount = getRowCount($conn, 'enrollments', "WHERE course_id IN (SELECT course_id FROM courses WHERE created_by = $userId)");
    $studentsCount = getRowCount($conn, 'enrollments', "WHERE course_id IN (SELECT course_id FROM courses WHERE created_by = $userId)");
}
$totalCount = max(1, $coursesCount + $feedbackCount + $enrollmentCount + $teachersCount + $studentsCount); // Avoid division by zero

// Fetch teacher details
$teacherDetails = [];
if ($userRole == 'admin') {
    // Use user_id instead of id
    $sql = "SELECT user_id, username FROM users WHERE role = 'teacher'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $teacherDetails[] = $row;
        }
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkm6Yc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color:rgb(207, 238, 236) ;
        }

        .card {
            border: 1px solid skyblue;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 100%;
        }

        .progress-bar {
            font-weight: bold;
        }

        .card-title {
            font-weight: bold;
            color: black;
        }
        .course-box {
            border: 1px solid skyblue;
            border-radius: 10px;
            padding: 5px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 60px;
        }
        .container {
            margin-top: 100px; /* Adjust to match the height of your navbar */
        }
        .course-box:hover {
            background-color:rgb(206, 245, 250);
        }
        .course-box a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
     
/* Table should take up full width with responsive design */
.table {
    width: 150%;
    max-width: 100%; /* Optional: Set max width for readability */
    margin-bottom: 20px;
}

/* Add some padding and margin for better spacing */
table th, table td {
    padding: 15px;
    text-align: center;
}

/* Button styles */
.text-center a {
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    text-decoration: none;
}

/* Optional: Button hover effect */
.text-center a:hover {
    background-color: #0056b3;
    color: white;
}
    </style>
</head>
<body>

<!-- Header Buttons in Boxes -->
<div class="container mt-4">
    <div class="row justify-content-center">
        
            <div class="course-box">
                <h3>Welcome to Dashboard</h3>
                <p>Manage and Analyse Your Work Efficiently</p>
            </div>
        </div>
        
    </div>

    <!-- Horizontal Divider -->
    <hr>
    <div class="row">
        <!-- Teachers Card -->
        <?php if ($userRole == 'admin'): ?>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Teachers</h5>
                    <p class="card-text">Total Teachers: <strong><?php echo $teachersCount; ?></strong></p>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" 
                            style="width: <?php echo ($teachersCount / $totalCount) * 100; ?>%;" 
                            aria-valuenow="<?php echo $teachersCount; ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo round(($teachersCount / $totalCount) * 100); ?>%
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Students Card -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Students</h5>
                    <p class="card-text">Total Students: <strong><?php echo $studentsCount; ?></strong></p>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" 
                            style="width: <?php echo ($studentsCount / $totalCount) * 100; ?>%;" 
                            aria-valuenow="<?php echo $studentsCount; ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo round(($studentsCount / $totalCount) * 100); ?>%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Card -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Courses</h5>
                    <p class="card-text">Total Courses: <strong><?php echo $coursesCount; ?></strong></p>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" 
                            style="width: <?php echo ($coursesCount / $totalCount) * 100; ?>%;" 
                            aria-valuenow="<?php echo $coursesCount; ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo round(($coursesCount / $totalCount) * 100); ?>%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback Card -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Feedback</h5>
                    <p class="card-text">Total Feedback: <strong><?php echo $feedbackCount; ?></strong></p>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" 
                            style="width: <?php echo ($feedbackCount / $totalCount) * 100; ?>%;" 
                            aria-valuenow="<?php echo $feedbackCount; ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo round(($feedbackCount / $totalCount) * 100); ?>%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enrollments Card -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Enrollments</h5>
                    <p class="card-text">Total Enrollments: <strong><?php echo $enrollmentCount; ?></strong></p>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" 
                            style="width: <?php echo ($enrollmentCount / $totalCount) * 100; ?>%;" 
                            aria-valuenow="<?php echo $enrollmentCount; ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo round(($enrollmentCount / $totalCount) * 100); ?>%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
    <!-- Charts Section -->
    <div class="row mt-5">
        <?php if ($userRole == 'admin'): ?>
        <div class="col-md-6">
           <canvas id="userDistributionChart"></canvas> 
        </div>
        <div class="col-md-6">
            <canvas id="dataCountsChart"></canvas>
        </div>
        <?php else: ?>
        <div class="col-md-12">
            <canvas id="dataCountsChart"></canvas>
        </div>
        <?php endif; ?>
    </div>
</div>
<hr>
<?php if ($userRole == 'admin'): ?>
 <!-- Teacher Details Table -->
<div class="container mt-5">
    <h3>Teacher Details</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Teacher ID</th>
                <th>Teacher Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teacherDetails as $teacher): ?>
                <tr>
                    <td><?php echo $teacher['user_id']; ?></td>
                    <td><?php echo $teacher['username']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

   
</div>
<?php endif; ?>

<script color = "white">
    <?php if ($userRole == 'admin'): ?>
    // User Distribution Chart
    const userDistributionCtx = document.getElementById('userDistributionChart').getContext('2d');
    new Chart(userDistributionCtx, {
        type: 'pie',
        data: {
            labels: ['Students', 'Teachers'],
            datasets: [{
                data: [<?php echo $studentsCount; ?>, <?php echo $teachersCount; ?>],
                backgroundColor: ['#36a2eb', '#ff6384'],
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'User Distribution'
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
    <?php endif; ?>

    // Data Counts Chart
    const dataCountsCtx = document.getElementById('dataCountsChart').getContext('2d');
    new Chart(dataCountsCtx, {
        type: 'bar',
        data: {
            labels: ['Courses', 'Feedback', 'Enrollments'],
            datasets: [{
                label: 'Counts',
                data: [<?php echo $coursesCount; ?>, <?php echo $feedbackCount; ?>, <?php echo $enrollmentCount; ?>],
                backgroundColor: ['#4bc0c0', '#ff9f40', '#9966ff'],
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Data Counts'
                }
            },
            responsive: true
        }
    });
</script>

</body>
</html>
