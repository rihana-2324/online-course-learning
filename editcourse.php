<?php

include "../db.php";
include 'navbar.php';

if(isset($_GET['course_id'])){

$course_id = $_GET['course_id'];

$sql = "SELECT * FROM courses WHERE course_id = $course_id";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    $course_data = mysqli_fetch_assoc($result);

    // Fetch video URL from course_videos table
    $video_sql = "SELECT video_url FROM course_videos WHERE course_id = $course_id";
    $video_result = mysqli_query($conn, $video_sql);

    if(mysqli_num_rows($video_result) > 0){
        $video_data = mysqli_fetch_assoc($video_result);
        $course_data['video_url'] = $video_data['video_url'];
    } else {
        $course_data['video_url'] = '';
    }
} else {
    echo "No course found with the given ID.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $thumbnail = $_POST['thumbnail'];
    $video_url = $_POST['video_url'];  

    $update_sql = "UPDATE courses SET title='$title', description='$description', duration='$duration', thumbnail='$thumbnail' WHERE course_id=$course_id";
    $update_video_sql = "UPDATE course_videos SET video_url='$video_url' WHERE course_id=$course_id";

    if (mysqli_query($conn, $update_sql) && mysqli_query($conn, $update_video_sql)) {
        echo "Course updated successfully.";
        header("Refresh:0");
        exit;
    } else {
        echo "Error updating course: " . mysqli_error($conn);
    }
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkm6Yc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
           
            background-color:rgb(207, 238, 236) ;
        }
        .form-container {
            background-color:rgb(166, 173, 173); /* Slightly darker light purple */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(127, 197, 209, 0.2);
            color: white;
            margin-top: 50px;
        }
        .form-header {
            background-color: black; /* Deep purple header */
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .btn-prima {
            background-color:black; /* Deep purple button */
            color: white;
            align-content: center;

        }
        .btn-prima:hover {
            background-color:rgb(76, 131, 138);
        }
    </style>
    </head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="form-container">
                <div class="form-header">
                    <h3>Edit Course</h3>
                </div>
                
<form method="post">

<div class="mb-3">
    <label for="title" class="form-label">Course Name</label>
    <input type="text" class="form-control" id="title" name="title" value="<?php echo $course_data['title']; ?>">

</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" id="description" name="description" value="<?php echo $course_data['description']; ?>">

</div>

<div class="mb-3">
    <label for="duration" class="form-label">Duration</label>
    <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $course_data['duration']; ?>">

</div>

<div class="mb-3">
    <label for="thumbnail" class="form-label">Thumbnail</label>
    <input type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?php echo $course_data['thumbnail']; ?>">

</div>
<div class="mb-3">
            <label for="video_url" class="form-label">Course Video URL</label>
            <input type="text" id="video_url" name="video_url" class="form-control" value="<?php echo $course_data['video_url'] ?? ''; ?>">
        </div>

<input type="hidden" class="form-control" id="course_id" name="course_id" value="<?php echo $course_data['course_id']; ?>">

<center><button type="submit" class="btn btn-prima">Update</button></center>

</form>



<?php



}else{

    echo "<a href='viewcourse.php'>Page Not found. Click to view all courses </a>";
    
    }
    
    
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>