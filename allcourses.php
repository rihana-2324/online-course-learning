<?php
include '../db.php';
include 'navbarmain.php';

// Fetch courses from the database
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Courses</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .custom-card:hover {
            transform: translateY(-5px);
        }

        .custom-card img {
            border-radius: 12px 12px 0 0;
        }
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
    <div class="container py-5">
        <h1 class="text-center mb-4">Our Courses</h1>
        <div class="row gy-4">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Display each course as a card
                    echo '
                    <div class="col-lg-3 col-md-6">
                        <div class="card custom-card">
                            <img src="' . htmlspecialchars($row['thumbnail']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">
                            <div class="card-body text-center">
                                <h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>
                                <p class="card-text">' . htmlspecialchars($row['description']) . '</p>
                                <p class="text-muted">Duration: ' . $row['duration'] . ' hours</p>
                                <a href="';
                                    // Determine the registration page based on course title or ID
                                    if ($row['title'] == 'python') {
                                        echo 'python.php';
                                    } elseif ($row['title'] == 'java') {
                                        echo 'java.php';
                                    } elseif ($row['title'] == 'C') {
                                        echo 'c.php';
                                    } elseif ($row['title'] == 'javascript') {
                                        echo 'Javascript.php';
                                    } elseif ($row['title'] == 'php') {
                                        echo 'php.php';
                                    } elseif ($row['title'] == 'AI') {
                                        echo 'ai.php';
                                    }

                                echo '" class="register-link mt-3">Register</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p class="text-center">No courses available at the moment.</p>';
            }
            ?>
        </div>
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
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>abcdr@gmail.com</p>
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

</body>
 <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</html>
