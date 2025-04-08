import { Ajax } from './ajax.js';

document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Clear previous error messages
    clearErrors();
    
    // Get form elements
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const terms = document.getElementById('terms').checked;
    
    // Validation flags
    let isValid = true;
    
    // Username validation
    if (username === '') {
        displayError('username', 'Username is required');
        isValid = false;
    } else if (username.length < 3 || username.length > 50) {
        displayError('username', 'Username must be between 3 and 50 characters');
        isValid = false;
    }
    
    // Email validation
    if (email === '') {
        displayError('email', 'Email is required');
        isValid = false;
    } else if (!validateEmail(email)) {
        displayError('email', 'Please enter a valid email address');
        isValid = false;
    }
    
    // Password validation
    if (password === '') {
        displayError('password', 'Password is required');
        isValid = false;
    } else if (password.length < 8) {
        displayError('password', 'Password must be at least 8 characters long');
        isValid = false;
    } else if (!validatePasswordStrength(password)) {
        displayError('password', 'Password must contain letters, numbers, and special characters');
        isValid = false;
    }
    
    // Confirm password
    if (password !== confirmPassword) {
        displayError('confirm_password', 'Passwords do not match');
        isValid = false;
    }
    
    // Terms validation
    if (!terms) {
        displayError('terms', 'You must agree to the terms');
        isValid = false;
    }
    
    // If valid, submit the form
    if (isValid) {
        const form = document.getElementById('registerForm');
        const formData = new FormData(form);
        
        // Update Ajax class to handle response
        Ajax.postMethod(formData, 'registerProcess.php', function(response) {
            try {
                const result = JSON.parse(response);
                if (result.success) {
                    showSuccessMessage(result.message);
                    form.reset(); // Clear form on success
                } else {
                    // Display server-side errors
                    result.errors.forEach(error => {
                        showErrorMessage(error);
                    });
                }
            } catch (e) {
                showErrorMessage("An unexpected error occurred");
            }
        });
    }
});

// Helper functions
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePasswordStrength(password) {
    // At least one letter, one number and one special character
    const re = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    return re.test(password);
}

function displayError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback d-block';
    errorDiv.textContent = message;
    
    field.classList.add('is-invalid');
    field.parentNode.appendChild(errorDiv);
}

function clearErrors() {
    // Remove all error messages
    document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
}

function showSuccessMessage(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success mt-3';
    alertDiv.textContent = message;
    
    const form = document.getElementById('registerForm');
    form.parentNode.insertBefore(alertDiv, form);
    
    // Auto-remove after 5 seconds
    setTimeout(() => alertDiv.remove(), 5000);
}

function showErrorMessage(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-danger mt-3';
    alertDiv.textContent = message;
    
    const form = document.getElementById('registerForm');
    form.parentNode.insertBefore(alertDiv, form);
    
    // Auto-remove after 5 seconds
    setTimeout(() => alertDiv.remove(), 5000);
}