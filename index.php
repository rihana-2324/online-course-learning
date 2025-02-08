<?php
include'navbarmain.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Learning Platform</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- WOW.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
        <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Owl Carousel CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
 <style>
         
        .carousel-inner img {
            height: 500px;
            object-fit: cover;

        }
        .card {
            margin: 20px 0;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }
        .footer a {
            text-decoration: none;
            color: #000;
        }
       
        .custom-card img {
            object-fit: cover;
            height: 200px;
        }

        .custom-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .custom-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .category h6.section-title {
    font-size: 18px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    display: inline-block;
    margin-bottom: 10px;
}

.category h1 {
    font-size: 36px;
    font-weight: 700;
}

.category .position-relative img {
    transition: transform 0.3s ease-in-out;
}

.category .position-relative:hover img {
    transform: scale(1.1);
}

.category .bg-white {
    border-radius: 5px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}
/* Custom Styling for the Team Section */
.team-item {
    border: 1px solid #ddd;
    border-radius: 8px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.team-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.team-item img {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.team-item .btn {
    border-radius: 50%;
    width: 30px;
    height: 30px;
    font-size: 14px;
}

.team-item .text-center {
    background-color: #fff;
}

.team-item h5 {
    font-size: 18px;
    color: #333;
    margin-bottom: 5px;
}

.team-item small {
    color: #777;
    font-size: 14px;
}
/* General styles for buttons */
.btn-link {
    color:rgb(255, 255, 255);
    text-decoration: none;
}

.btn-link:hover {
    text-decoration: underline;
    color: #17a2b8; /* Bootstrap primary color */
}

/* Footer styles */
.footer {
    background-color: #1e1e1e;
    color: #ffffff;
    font-size: 14px;
}

/* Back-to-top button */
.back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    display: none;
}

/* Testimonial carousel images */
.testimonial-item img {
    border-color: #17a2b8; /* Match the primary color */
}

/* Newsletter input box */
.newsletter input[type="text"] {
    border: none;
    border-radius: 0;
}

/* Footer links */
.footer-menu a {
    color: #ffffff;
    margin: 0 10px;
    text-decoration: none;
}

.footer-menu a:hover {
    color: #17a2b8;
    text-decoration: underline;
}
#ql a{
    color: #17a2b8;
}
#ql a:hover{
    color:rgb(71, 136, 223);
}
#cr a{
    color: #17a2b8;
}
#cr a:hover{
    color:rgb(71, 136, 223);
}
    </style>
</head>
<body>
    <!-- Navbar Start -->

    <!-- Image Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/carousel-1.jpg" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block">
                    <h4>Welcome to LearnOnline</h4>
                    <p>Your journey to knowledge starts here.</p>
                    <a href="#courses" class="btn btn-primary">Get Started</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/carousel-2.jpg" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <h4>Explore Our Courses</h4>
                    <p>Learn more courses with us.</p>
                    <a href="allcourses.php" class="btn btn-secondary">Browse Courses</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    <!-- Categories Section Start -->
<div class="container-xxl py-5 category" id="courses">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Categories</h6>
            <h1 class="mb-5">Courses Categories</h1>
        </div>
        <div class="row g-3">
            <div class="col-lg-7 col-md-6">
                <div class="row g-3">
                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden" href="allcourses.php">
                            <img class="img-fluid" src="img/cat-1.jpg" alt="Web Design">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3 shadow-sm" style="margin: 1px;">
                                <h5 class="m-0">web Developement</h5>
                                <small class="text-primary">49 Courses</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                        <a class="position-relative d-block overflow-hidden" href="allcourses.php">
                            <img class="img-fluid" src="img/cat-2.jpg" alt="Graphic Design">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3 shadow-sm" style="margin: 1px;">
                                <h5 class="m-0">App Developement</h5>
                                <small class="text-primary">49 Courses</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                        <a class="position-relative d-block overflow-hidden" href="allcourses.php">
                            <img class="img-fluid" src="img/cat-3.jpg" alt="Video Editing">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3 shadow-sm" style="margin: 1px;">
                                <h5 class="m-0">Program Learning</h5>
                                <small class="text-primary">49 Courses</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                <a class="position-relative d-block h-100 overflow-hidden" href="allcourses.php">
                    <img class="img-fluid position-absolute w-100 h-100" src="img/cat-4.jpg" alt="Online Marketing" style="object-fit: cover;">
                    <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3 shadow-sm" style="margin: 1px;">
                        <h5 class="m-0">AI & ML</h5>
                        <small class="text-primary">49 Courses</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Categories Section End -->

     <!-- Why Choose Us Section -->
     <div class="container-xxl py-5" id="about">
        <div class="container">
            <h6 class="section-title text-center text-primary mb-3">Why Choose Us</h6>
            <h1 class="text-center mb-5">Benefits of eLearning</h1>
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card custom-card">
                        <img src="img/team-3.jpg" class="card-img-top" alt="Expert Instructors">
                        <div class="card-body text-center">
                            <h5 class="card-title">Skilled Instructors</h5>
                            <p class="card-text">Our expert instructors ensure the best learning experience.</p>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card custom-card">
                        <img src="img/course-1.jpg" class="card-img-top" alt="Flexible Classes">
                        <div class="card-body text-center">
                            <h5 class="card-title">Flexible Classes</h5>
                            <p class="card-text">Attend classes from anywhere with a flexible schedule.</p>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card custom-card">
                        <img src="img/course-2.jpg" class="card-img-top" alt="Practical Projects">
                        <div class="card-body text-center">
                            <h5 class="card-title">Practical Projects</h5>
                            <p class="card-text">Hands-on projects to build real-world skills.</p>
                        </div>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card custom-card">
                        <img src="img/course-3.jpg" class="card-img-top" alt="Certified Courses">
                        <div class="card-body text-center">
                            <h5 class="card-title">Certified Courses</h5>
                            <p class="card-text">Get internationally recognized certificates.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <!-- Team Section Start -->
 <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
            <h1 class="mb-5">Expert Instructors</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item bg-light">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="img/team-1.jpg" alt="">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                        <div class="bg-light d-flex justify-content-center pt-2 px-1">
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Instructor Name</h5>
                        <small>Designation</small>
                    </div>
                </div>
            </div>
            <!-- Repeat for other instructors -->
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item bg-light">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="img/team-2.jpg" alt="">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                        <div class="bg-light d-flex justify-content-center pt-2 px-1">
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Instructor Name</h5>
                        <small>Designation</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item bg-light">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="img/team-3.jpg" alt="">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                        <div class="bg-light d-flex justify-content-center pt-2 px-1">
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Instructor Name</h5>
                        <small>Designation</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="team-item bg-light">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="img/team-4.jpg" alt="">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                        <div class="bg-light d-flex justify-content-center pt-2 px-1">
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Instructor Name</h5>
                        <small>Designation</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team Section End -->

       <!-- Testimonial Start -->
       <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s" id="testimonial">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Students Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-1.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">"The course material is great, but I feel some of the sessions could be more engaging. Adding more real-life examples and hands-on projects would make the learning process more practical and enjoyable."</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-2.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">"The teachers are incredibly knowledgeable and supportive. They take the time to address every student’s doubts and explain concepts clearly. I feel much more confident in my studies thanks to their guidance."</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-3.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">"The course material is great, but I feel some of the sessions could be more engaging. Adding more real-life examples and hands-on projects would make the learning process more practical and enjoyable."</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-4.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">"I love how the program balances theory and practical applications. The assignments and projects really helped me understand the concepts better. It’s a great investment in my education!"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6"id="ql">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="#about">About Us</a>
                    <a class="btn btn-link" href="#contact">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="#testimonal">FAQs & Help</a>
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
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0" id="cr">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="www.harxatech.com">Rihan Banu</a><br><br>
                        Distributed By <a class="border-bottom" href="www.harxatech.com">HarxaTech</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="index.php">Home</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       
   
  new WOW().init();
    
    // Smooth scrolling for "Back to Top" button
document.addEventListener("DOMContentLoaded", function () {
    const backToTop = document.querySelector(".back-to-top");

    // Show the button after scrolling down 200px
    window.addEventListener("scroll", function () {
        if (window.scrollY > 200) {
            backToTop.style.display = "block";
        } else {
            backToTop.style.display = "none";
        }
    });

    // Scroll to top functionality
    backToTop.addEventListener("click", function (e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
});

// Initialize Owl Carousel for Testimonial Slider
$(document).ready(function () {
    $(".testimonial-carousel").owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: { items: 1 },
            576: { items: 1 },
            768: { items: 2 },
            992: { items: 3 }
        }
    });
});
</script>
</body>
</html>

