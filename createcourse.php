<?php

include '../db.php'; // Make sure to include your database connection file
include 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $thumbnail = $_POST['thumbnail'];
    $video_url = $_POST['video_url'];  // Get the video URL from the form
    $created_by = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Insert the course into the courses table
    $sql = "INSERT INTO courses (title, description, duration, thumbnail, created_by) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $title, $description, $duration, $thumbnail, $created_by);

    if ($stmt->execute()) {
        // Get the last inserted course ID
        $course_id = $stmt->insert_id;

        // Insert the video URL into the course_videos table
        $sql_video = "INSERT INTO course_videos (course_id, video_url) VALUES (?, ?)";
        $stmt_video = $conn->prepare($sql_video);
        $stmt_video->bind_param("is", $course_id, $video_url);

        if ($stmt_video->execute()) {
            echo "New course created and video URL added successfully!";
        } else {
            echo "Error adding video URL: {$stmt_video->error}";
        }

        $stmt_video->close();
    } else {
        echo "Error: {$sql}<br>{$conn->error}";
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
    <title>Create Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkm6Yc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
    body {
        background-color:rgb(207, 238, 236); /* Light purple background */
    }
    .form-container {
        background-color:rgb(173, 176, 177); /* Slightly darker light purple */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(127, 197, 209, 0.2);
        width: 100%;
        max-width: 600px;
        margin-top: 150px;
        color: white;
    }
    .form-header {
        background-color:black; /* Deep purple header */
        color: white;
        padding: 15px;
        border-radius: 10px 10px 0 0;
        text-align: center;
    }
    .btn-purple {
        background-color:black; /* Deep purple button */
        color: white;
    }
    .btn-purple:hover {
        background-color:rgb(76, 131, 138);
    }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="form-container">
        <div class="form-header">
        <h3>Create a New Course</h3>
        </div>
        <form action="createcourse.php" method="post" class="mt-4">
        <div class="mb-3">
            <label for="title" class="form-label">Course Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Duration (in hours)</label>
            <input type="number" id="duration" name="duration" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail URL</label>
            <input type="text" id="thumbnail" name="thumbnail" class="form-control">
        </div>
        <div class="mb-3">
            <label for="video_url" class="form-label">Course Video URL</label>
            <input type="text" id="video_url" name="video_url" class="form-control">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-purple">Create Course</button>
        </div>
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>
