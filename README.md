# PHP Advanced Registration System

## Project Overview
This project demonstrates a modern, secure user registration system built with PHP, JavaScript, and MySQL. It features client-side and server-side validation, AJAX form submission, and follows contemporary best practices for web development and security.

## Features
- **Dual-layer Validation:** Both client-side and server-side validation for security and user experience
- **AJAX Form Submission:** Asynchronous form processing without page refresh
- **Responsive Design:** Works on mobile, tablet, and desktop screens
- **Modern UI:** Bootstrap 5.3 styling with clean, intuitive interface
- **Interactive Feedback:** Real-time error messages and success notifications
- **Secure Password Handling:** Password strength requirements and bcrypt hashing
- **Database Protection:** PDO with prepared statements to prevent SQL injection
- **ES6 Module Pattern:** Modern JavaScript architecture with import/export

## Tech Stack
- **Frontend:** HTML5, CSS3, JavaScript (ES6+)
- **CSS Framework:** Bootstrap 5.3
- **Backend:** PHP 7.4+
- **Database:** MySQL
- **Icons:** Font Awesome 6
- **AJAX:** XMLHttpRequest API

## Project Structure
```
php_advanced_test/
├── index.php            # Registration form page
├── script.js            # Client-side validation and form submission
├── ajax.js              # AJAX utility class
├── registerProcess.php  # Server-side validation and database operations
└── README.md            # Project documentation
```

## Installation
1. Clone this repository to your XAMPP htdocs folder:
    ```
    git clone https://github.com/yourusername/php_advanced_registration.git
    ```

2. Create a MySQL database named `php_advanced_registration`:
    ```sql
    CREATE DATABASE php_advanced_registration;
    ```

3. Create the users table:
    ```sql
    USE php_advanced_registration;

    CREATE TABLE users (
         id INT AUTO_INCREMENT PRIMARY KEY,
         username VARCHAR(50) NOT NULL UNIQUE,
         email VARCHAR(100) NOT NULL UNIQUE,
         password VARCHAR(255) NOT NULL,
         terms_accepted BOOLEAN NOT NULL DEFAULT FALSE,
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
         updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    ```

4. Update database credentials in `registerProcess.php` if necessary

5. Access the application at http://localhost/php_advanced_registration/

## Key Implementation Details

### Client-side Validation
- Form validation before submission
- Password strength checking with regex
- Field-specific error messages
- Real-time feedback to users

### Server-side Validation
- Complete re-validation of all inputs
- Email format verification
- Username uniqueness checking
- Password complexity requirements
- Database-level constraints

### Security Features
- Password hashing with bcrypt
- SQL injection protection via prepared statements
- XSS prevention with input sanitization
- Validation against empty or malformed inputs

## Future Plans

### User Authentication
- Login system with session management
- Remember me functionality
- Secure password reset flow

### Profile Management
- User profile page
- Email verification
- Profile photo upload

### Enhanced Security
- CSRF protection
- Rate limiting for registration/login attempts
- Two-factor authentication

### UI Improvements
- Custom form animations
- Enhanced validation feedback
- Progress indicators

### Code Structure
- Move to MVC pattern
- Implement autoloading
- Unit testing

## License
This project is open-source and available under the MIT License.
