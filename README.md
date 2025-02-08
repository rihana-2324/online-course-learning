# Online Course Learning Platform

## 📌 Project Overview
This is a full-stack Online Course Learning Platform that allows users to browse, enroll, and complete courses. The platform includes user authentication, course management, payment integration, and a responsive UI for a seamless learning experience.

## 🚀 Features
- User Registration & Login (Student & Instructor roles)
- Course Creation, Editing, and Deletion (Instructor)
- Course Enrollment & Progress Tracking
- Payment Integration for Course Purchase
- Secure Authentication & Authorization
- Mobile Responsive Design
- Admin Panel for Managing Users & Courses
- Database-Driven Content Management

## 🛠️ Technologies Used
- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP, MySQL
- **Database:** MySQL
- **Payment Integration:** PayPal/Stripe API
- **Authentication:** PHP Sessions & MySQL

## 📂 Project Structure
```
/online-course-platform
│── /assets        # Images, CSS, JS files
│── /database      # SQL database scripts
│── /includes      # Common PHP files (header, footer, database connection)
│── /admin        # Admin panel files
│── /courses      # Course-related files
│── index.php     # Homepage
│── login.php     # User login
│── register.php  # User registration
│── dashboard.php # User dashboard
│── payment.php   # Payment processing
│── db.php    # Database configuration
```

## 📥 Installation & Setup
1. Clone this repository:
   ```sh
   git clone https://github.com/yourusername/online-course-platform.git
   ```
2. Navigate to the project folder:
   ```sh
   cd online-course-platform
   ```
3. Import the database:
   - Open **phpMyAdmin**
   - Create a database (e.g., `online_courses`)
   - Import `database/online_courses.sql`
4. Configure database connection:
   - Open `config.php`
   - Update the database credentials:
     ```php
     define('DB_SERVER', 'localhost');
     define('DB_USERNAME', 'root');
     define('DB_PASSWORD', '');
     define('DB_NAME', 'online_courses');
     ```
5. Start a local development server:
   ```sh
   php -S localhost:8000
   ```
6. Open your browser and visit:
   ```
   http://localhost:8000/
   ```

## 💳 Payment Integration
- Update the `payment.php` file with your PayPal or Stripe API keys.
- Follow the payment gateway's documentation for integration.

## 🔒 Security Measures
- Passwords are hashed using `password_hash()`.
- Prepared Statements to prevent SQL Injection.
- Form validation to prevent XSS and CSRF attacks.

## 📜 License
This project is open-source under the MIT License.

## 🤝 Contribution
Feel free to contribute! Fork this repo, make improvements, and create a pull request.

## 📧 Contact
For any issues or suggestions, contact me at rihanabanuengineer@gmail.com or visit my GitHub profile [@rihana-2324](https://github.com/rihana-2324).

