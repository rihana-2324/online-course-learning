
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'teacher', 'admin') NOT NULL

);
ALTER TABLE users ADD COLUMN phonenumber VARCHAR(10) ;
CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    duration INT NOT NULL,
    thumbnail VARCHAR(255),
    created_by INT,
    FOREIGN KEY (created_by) REFERENCES users(user_id)
);
ALTER TABLE courses ADD COLUMN price DECIMAL(10,2) NOT NULL DEFAULT 0.00;


CREATE TABLE enrollments (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrollment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
);
ALTER TABLE enrollments ADD COLUMN price DECIMAL(10,2) NOT NULL DEFAULT 0.00;
ALTER TABLE enrollments ADD COLUMN status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending';
ALTER TABLE enrollments 
ADD COLUMN payment_id VARCHAR(250), 
ADD COLUMN phonenumber VARCHAR(20);


CREATE TABLE feedback (
    feedback_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    feedback_text TEXT,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    FOREIGN KEY (student_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
);
ALTER TABLE feedback ADD COLUMN reply_text TEXT NULL;

CREATE TABLE admin_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES users(user_id)
);
/* Course Videos */
CREATE TABLE course_videos (
    video_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    video_url VARCHAR(255) NOT NULL,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE
);