<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .card-header {
            background-color: #0d6efd;
            border-bottom: none;
            padding: 1.5rem;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .auth-image {
            background-image: url('https://images.unsplash.com/photo-1497215842964-222b430dc094');
            background-size: cover;
            background-position: center;
            min-height: 100%;
            border-radius: 0 0.375rem 0.375rem 0;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-header">
                                <h3 class="mb-0 text-white fw-bold">User Registration</h3>
                                <p class="text-white-50 mb-0">Create your account to get started</p>
                            </div>
                            <div class="card-body p-4">
                                <form id="registerForm" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="username" class="form-label fw-semibold">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-semibold">Email address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-semibold">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label fw-semibold">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="terms" name="terms">
                                            <label class="form-check-label" for="terms">
                                                I agree to the <a href="#" class="text-decoration-none">Terms and Conditions</a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Register Account</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-white text-center p-3">
                                <p class="mb-0">Already have an account? <a href="login.php" class="text-decoration-none fw-semibold">Sign In</a></p>
                            </div>
                        </div>
                        <div class="col-md-6 d-none d-md-block">
                            <div class="auth-image"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js" type="module"></script>
</body>

</html>