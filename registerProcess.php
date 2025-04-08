<?php
// Set proper content type for JSON response
header('Content-Type: application/json');

// Initialize response array
$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input sanitization
    $username = htmlspecialchars(trim($_POST['username'] ?? ''), ENT_QUOTES, 'UTF-8');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $terms = isset($_POST['terms']);

    // Server-side validation
    $isValid = true;

    // Username validation
    if (empty($username)) {
        $response['errors'][] = "Username is required";
        $isValid = false;
    } elseif (strlen($username) < 3 || strlen($username) > 50) {
        $response['errors'][] = "Username must be between 3 and 50 characters";
        $isValid = false;
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $response['errors'][] = "Username can only contain letters, numbers, and underscores";
        $isValid = false;
    }

    // Email validation
    if (empty($email)) {
        $response['errors'][] = "Email is required";
        $isValid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['errors'][] = "Valid email is required";
        $isValid = false;
    }

    // Password validation
    if (empty($password)) {
        $response['errors'][] = "Password is required";
        $isValid = false;
    } elseif (strlen($password) < 8) {
        $response['errors'][] = "Password must be at least 8 characters long";
        $isValid = false;
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $password)) {
        $response['errors'][] = "Password must contain letters, numbers, and special characters";
        $isValid = false;
    }

    // Password confirmation
    if ($password !== $confirmPassword) {
        $response['errors'][] = "Passwords do not match";
        $isValid = false;
    }

    // Terms validation
    if (!$terms) {
        $response['errors'][] = "You must agree to the terms";
        $isValid = false;
    }

    // If all validations pass, proceed with database operations
    if ($isValid) {
        try {
            // Database connection
            $db = new PDO('mysql:host=localhost;dbname=php_advanced_test', 'root', 'PasinduDev678');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if username already exists
            $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetchColumn() > 0) {
                $response['errors'][] = "This username is already taken";
                echo json_encode($response);
                exit;
            }

            // Check if email already exists
            $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetchColumn() > 0) {
                $response['errors'][] = "This email is already registered";
                echo json_encode($response);
                exit;
            }

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user into database
            $stmt = $db->prepare("INSERT INTO users (username, email, password, terms_accepted) VALUES (?, ?, ?, ?)");
            $success = $stmt->execute([$username, $email, $hashedPassword, $terms ? 1 : 0]);

            if ($success) {
                $response['success'] = true;
                $response['message'] = "Registration successful! You can now log in.";
            } else {
                $response['errors'][] = "Failed to create account. Please try again.";
            }
        } catch (PDOException $e) {
            $response['errors'][] = "Database error: " . $e->getMessage();
        }
    }
}

// Return JSON response
echo json_encode($response);