<?php
session_start();
include '../db.php'; // Ensure this path is correct based on your directory structure
include 'navbarmain.php';

// Check if the user is logged in and is a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    echo "Access denied. Please log in as a student.";
    exit();
}

$student_id = $_SESSION['user_id'];

// Fetch courses the student is enrolled in
$sql = "
    SELECT c.course_id, c.title
    FROM courses c
    INNER JOIN enrollments e ON c.course_id = e.course_id
    WHERE e.student_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$courses = [];
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
                    /* Footer styles */
    .footer {
        background-color: #000; /* Black background */
        color: #fff; /* White text color */
        padding: 2rem 0; /* Reduced padding */
        width: 100%; /* Ensure full width */
        margin: 0; /* Remove default margins */
        box-sizing: border-box; /* Include padding and border in element's total width and height */
    }

    /* Footer links */
    .footer a {
        color: #87CEEB; /* Sky blue link color */
        text-decoration: none;
    }

    .footer a:hover {
        color: #00BFFF; /* Deep sky blue on hover */
        text-decoration: underline;
    }

    /* Footer headings */
    .footer h4 {
        color: #fff; /* White color for headings */
        margin-bottom: 1rem; /* Reduced margin */
    }

    /* Social media buttons */
    .footer .btn-social {
        border-radius: 50%;
        background-color: transparent;
        border: 1px solid #fff;
        color: #fff;
        width: 30px; /* Reduced size */
        height: 30px; /* Reduced size */
        text-align: center;
        line-height: 30px; /* Adjusted line height */
        margin-right: 0.5rem;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .footer .btn-social i {
        line-height: 1; /* Ensure icons are centered */
    }

    .footer .btn-social:hover {
        background-color: #87CEEB; /* Sky blue background on hover */
        border-color: #87CEEB;
        color: #000; /* Black icon color on hover */
    }

    /* Footer bottom */
    .footer .copyright {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 0.5rem; /* Reduced padding */
        margin-top: 1rem; /* Reduced margin */
        font-size: 0.875rem;
    }

    /* Footer menu */
    .footer .footer-menu a {
        color: #fff; /* White color for footer menu links */
        margin-right: 0.5rem; /* Reduced margin */
    }

    .footer .footer-menu a:hover {
        color: #87CEEB; /* Sky blue on hover */
    }

    /* Align contact details */
    #contact p {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem; /* Reduced margin */
    }

    #contact p i {
        margin-right: 0.5rem; /* Space between icon and text */
    }
    </style>
        
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">My Enrolled Courses</h2>
        <?php if (!empty($courses)): ?>
            <div class="accordion" id="courseAccordion">
                <?php foreach ($courses as $course): ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo $course['course_id']; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse<?php echo $course['course_id']; ?>" 
                                    aria-expanded="false" aria-controls="collapse<?php echo $course['course_id']; ?>">
                                <?php echo htmlspecialchars($course['title']); ?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $course['course_id']; ?>" 
                             class="accordion-collapse collapse" 
                             aria-labelledby="heading<?php echo $course['course_id']; ?>" 
                             data-bs-parent="#courseAccordion">
                            <div class="accordion-body">
                                <h4>Videos:</h4>
                                <?php
                                // Fetch videos for the current course
                                include '../db.php'; // Re-establish the database connection
                                $video_sql = "SELECT video_url FROM course_videos WHERE course_id = ?";
                                $video_stmt = $conn->prepare($video_sql);
                                $video_stmt->bind_param("i", $course['course_id']);
                                $video_stmt->execute();
                                $video_result = $video_stmt->get_result();

                                if ($video_result->num_rows > 0):
                                ?>
                                    <div class="row">
                                        <?php while ($video = $video_result->fetch_assoc()): ?>
                                            <div class="col-md-6 mb-4">
                                                <?php
                                                if (strpos($video['video_url'], 'youtube.com') !== false || strpos($video['video_url'], 'youtu.be') !== false):
                                                    preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', 
                                                        $video['video_url'], $matches);
                                                    $youtube_id = $matches[1] ?? null;

                                                    if ($youtube_id):
                                                ?>
                                                        <iframe width="100%" height="315" 
                                                                src="https://www.youtube.com/embed/<?php echo htmlspecialchars($youtube_id); ?>" 
                                                                title="YouTube video player" 
                                                                frameborder="0" 
                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                                allowfullscreen>
                                                        </iframe>
                                                <?php 
                                                    endif;
                                                else:
                                                ?>
                                                    <video width="100%" controls>
                                                        <source src="<?php echo htmlspecialchars($video['video_url']); ?>" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                <?php endif; ?>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php else: ?>
                                    <p>No videos available for this course.</p>
                                <?php endif; ?>

                                <?php $video_stmt->close(); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>You are not enrolled in any courses.</p>
        <?php endif; ?>
    </div>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="about">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="index.php#testimonial">FAQs & Help</a>
                </div>
                <div class="col-lg-3 col-md-6" id="contact">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, vandaloor, chennai</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>9087654321</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>abcd@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Ask</h4>
                    <p>If any queries contact in mail</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email" id="emailInput">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2" onclick="sendEmail()">Send</button>
                    </div>
                </div>

                <script>
                    function sendEmail() {
                        var email = document.getElementById('emailInput').value;
                        window.location.href = 'https://mail.google.com/mail/?view=cm&fs=1&to=abcd@gmail.com&su=Query&body=Email: ' + email;
                    }
                </script>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                &copy; <a class="border-bottom" href="www.harxatech.com">Your Site Name</a>, All Right Reserved.
                Designed By <a class="border-bottom" href="www.harxatech.com">Rihan Banu</a><br><br>
                Distributed By <a class="border-bottom" href="www.harxatech.com">HarxaTech</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                <div class="footer-menu">
                    <a href="index.php">Home</a>
                    <a href="index.php#testimonial">FQAs</a>
                </div>
                </div>
            </div>
            </div>
        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>
