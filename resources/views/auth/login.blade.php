<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redeemer's University - Complaint Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Import the global CSS styles */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        /* CSS Reset */
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

        :root {
          /* Color Variables */
          --primary-color: #1e3a8a;
          --primary-light: #6c6aed;
          --primary-dark: #2a2899;
          --secondary-color: #ff9800;
          --secondary-light: #ffb74d;
          --secondary-dark: #f57c00;
          --danger-color: #f44336;
          --success-color: #4caf50;
          --warning-color: #ff9800;
          --info-color: #2196f3;
          --dark-color: #333;
          --grey-color: #757575;
          --light-grey: #e0e0e0;
          --very-light-grey: #f5f5f5;
          --white-color: #fff;

          /* Font Variables */
          --body-font: 'Poppins', sans-serif;

          /* Spacing Variables */
          --spacing-xs: 0.25rem;
          --spacing-sm: 0.5rem;
          --spacing-md: 1rem;
          --spacing-lg: 1.5rem;
          --spacing-xl: 2rem;

          /* Border Radius */
          --border-radius-sm: 4px;
          --border-radius-md: 8px;
          --border-radius-lg: 12px;

          /* Shadow */
          --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
          --shadow-md: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
          --shadow-lg: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        }

        /* Global Styles */
        body {
          font-family: var(--body-font);
          font-size: 16px;
          line-height: 1.5;
          color: var(--dark-color);
          background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
          min-height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
        }

        /* Auth Container */
        .auth-container {
          background-color: var(--white-color);
          border-radius: var(--border-radius-lg);
          box-shadow: var(--shadow-lg);
          overflow: hidden;
          width: 100%;
          max-width: 900px;
          margin: var(--spacing-lg);
          display: flex;
          min-height: 600px;
        }

        /* Left Panel - University Info */
        .auth-info {
          background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
          color: var(--white-color);
          padding: var(--spacing-xl);
          flex: 1;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          text-align: center;
          position: relative;
          overflow: hidden;
        }

        .auth-info::before {
          content: '';
          position: absolute;
          top: -50%;
          left: -50%;
          width: 200%;
          height: 200%;
          background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="90" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="60" r="1" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
          animation: float 20s linear infinite;
          pointer-events: none;
        }

        @keyframes float {
          0% { transform: translateY(0px); }
          100% { transform: translateY(-100px); }
        }

        .university-logo {
          width: 80px;
          height: 80px;
          background-color: var(--white-color);
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          margin-bottom: var(--spacing-lg);
          box-shadow: var(--shadow-md);
          position: relative;
          z-index: 1;
        }

        .university-logo i {
          font-size: 2rem;
          color: var(--primary-color);
        }

        .university-info h1 {
          font-size: 1.8rem;
          font-weight: 700;
          margin-bottom: var(--spacing-sm);
          position: relative;
          z-index: 1;
        }

        .university-info p {
          font-size: 1rem;
          opacity: 0.9;
          line-height: 1.6;
          position: relative;
          z-index: 1;
        }

        /* Right Panel - Auth Forms */
        .auth-forms {
          flex: 1;
          padding: var(--spacing-xl);
          display: flex;
          flex-direction: column;
          justify-content: center;
        }

        .form-container {
          position: relative;
          overflow: hidden;
        }

        .auth-form {
          display: none;
          animation: slideIn 0.5s ease-out;
        }

        .auth-form.active {
          display: block;
        }

        @keyframes slideIn {
          from {
            opacity: 0;
            transform: translateX(30px);
          }
          to {
            opacity: 1;
            transform: translateX(0);
          }
        }

        .form-header {
          text-align: center;
          margin-bottom: var(--spacing-xl);
        }

        .form-header h2 {
          font-size: 1.8rem;
          font-weight: 600;
          color: var(--primary-color);
          margin-bottom: var(--spacing-sm);
        }

        .form-header p {
          color: var(--grey-color);
          font-size: 0.9rem;
        }

        /* Form Styles */
        .form-group {
          margin-bottom: var(--spacing-lg);
          position: relative;
        }

        .form-label {
          display: block;
          margin-bottom: var(--spacing-sm);
          font-weight: 500;
          color: var(--dark-color);
        }

        .form-control {
          width: 100%;
          padding: var(--spacing-md);
          border-radius: var(--border-radius-md);
          border: 2px solid var(--light-grey);
          font-family: var(--body-font);
          font-size: 1rem;
          transition: all 0.3s ease;
          background-color: var(--white-color);
        }

        .form-control:focus {
          outline: none;
          border-color: var(--primary-color);
          box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .form-control.error {
          border-color: var(--danger-color);
          box-shadow: 0 0 0 3px rgba(244, 67, 54, 0.1);
        }

        .error-message {
          color: var(--danger-color);
          font-size: 0.8rem;
          margin-top: var(--spacing-xs);
          display: none;
        }

        .error-message.show {
          display: block;
        }

        /* Button Styles */
        .btn {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          gap: var(--spacing-sm);
          padding: var(--spacing-md) var(--spacing-lg);
          border-radius: var(--border-radius-md);
          text-decoration: none;
          font-weight: 500;
          font-size: 1rem;
          cursor: pointer;
          transition: all 0.3s ease;
          border: none;
          width: 100%;
        }

        .btn-primary {
          background-color: var(--primary-color);
          color: var(--white-color);
        }

        .btn-primary:hover {
          background-color: var(--primary-dark);
          transform: translateY(-2px);
          box-shadow: var(--shadow-md);
        }

        .btn-primary:disabled {
          background-color: var(--grey-color);
          cursor: not-allowed;
          transform: none;
        }

        /* Toggle Links */
        .form-toggle {
          text-align: center;
          margin-top: var(--spacing-lg);
        }

        .form-toggle p {
          color: var(--grey-color);
          margin-bottom: var(--spacing-sm);
        }

        .toggle-link {
          color: var(--primary-color);
          text-decoration: none;
          font-weight: 500;
          transition: all 0.3s ease;
        }

        .toggle-link:hover {
          color: var(--primary-dark);
          text-decoration: underline;
        }

        /* Alert Styles */
        .alert {
          padding: var(--spacing-md);
          border-radius: var(--border-radius-md);
          margin-bottom: var(--spacing-lg);
          display: none;
        }

        .alert.show {
          display: block;
          animation: fadeIn 0.3s ease-out;
        }

        .alert-success {
          background-color: #e8f5e9;
          color: var(--success-color);
          border-left: 4px solid var(--success-color);
        }

        .alert-danger {
          background-color: #ffebee;
          color: var(--danger-color);
          border-left: 4px solid var(--danger-color);
        }

        @keyframes fadeIn {
          from { opacity: 0; transform: translateY(-10px); }
          to { opacity: 1; transform: translateY(0); }
        }

        /* Loading Spinner */
        .loading-spinner {
          display: none;
          width: 20px;
          height: 20px;
          border: 2px solid transparent;
          border-top: 2px solid var(--white-color);
          border-radius: 50%;
          animation: spin 1s linear infinite;
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
          .auth-container {
            flex-direction: column;
            margin: var(--spacing-md);
            max-width: 500px;
          }

          .auth-info {
            padding: var(--spacing-lg);
            min-height: 200px;
          }

          .university-info h1 {
            font-size: 1.5rem;
          }

          .auth-forms {
            padding: var(--spacing-lg);
          }

          .form-header h2 {
            font-size: 1.5rem;
          }
        }

        /* Utility Classes */
        .d-flex { display: flex; }
        .align-center { align-items: center; }
        .justify-center { justify-content: center; }
        .text-center { text-align: center; }
        .mb-1 { margin-bottom: var(--spacing-sm); }
        .mb-2 { margin-bottom: var(--spacing-md); }
        .mb-3 { margin-bottom: var(--spacing-lg); }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Left Panel - University Information -->
        <div class="auth-info">
            <div class="university-logo">
                <i class="fas fa-university"></i>
            </div>
            <div class="university-info">
                <h1>Redeemer's University</h1>
                <p>Complaint Management System - Your voice matters. Submit, track, and resolve complaints efficiently with our integrated feedback and review mechanism.</p>
            </div>
        </div>

        <!-- Right Panel - Authentication Forms -->
        <div class="auth-forms">
            <div class="form-container">
                <!-- Alert Messages -->
                <div id="alertMessage" class="alert">
                    <span id="alertText"></span>
                </div>

                {{-- Show login errors --}}
                @if (session('logout_success'))
                    <div class="alert alert-success" id="logoutSuccessAlert" style="display:block; text-align:center;">
                        {{ session('logout_success') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            var alert = document.getElementById('logoutSuccessAlert');
                            if (alert) alert.style.display = 'none';
                        }, 3000);
                    </script>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" id="loginErrorAlert" style="display:block;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login')}}" id="loginForm" class="auth-form active">
                    @csrf
                    <div class="form-header">
                      <h2>Welcome Back</h2>
                      <p>Sign in to access your complaint dashboard</p>
                    </div>

                    <div class="form-group">
                      <label for="loginMatricNo" class="form-label">Matric No</label>
                      <input type="text" name="matric_no" id="loginMatricNo" class="form-control" placeholder="Enter your Matric Number" required>
                      <div class="error-message" id="loginMatricNoError">Please enter a valid matric number</div>
                    </div>

                    <div class="form-group">
                      <label for="loginPassword" class="form-label">Password</label>
                      <input type="password" name="password" id="loginPassword" class="form-control" placeholder="Enter your password" required>
                      <div class="error-message" id="loginPasswordError">Password must be at least 6 characters</div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" id="loginBtn">
                        <span class="btn-text">Sign In</span>
                        <div class="loading-spinner" id="loginSpinner"></div>
                      </button>
                    </div>

                    <div class="form-toggle d-flex justify-center" style="gap: 4rem;">
                      <a href="#" class="toggle-link" id="showRegister">Create Account</a>
                      <a href="#" class="toggle-link" id="showRegisterAdmin">Login as Admin</a>

                      {{-- {{-- Link to toggle anonymous responses button --}}
                      {{-- <a href="{{ route('public.responses') }}" class="toggle-link">Anonymous Responses</a> --}}
                    </div>
                  </form>



                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}" id="registerForm" class="auth-form">
                  @csrf
                    <div class="form-header">
                        <h2>Create Account</h2>
                        <p>Join RUN complaint management system</p>
                    </div>

                    <div class="form-group">
                        <label for="registerName" class="form-label">Full Name</label>
                        <input type="text" name="name" id="registerName" class="form-control" placeholder="Enter your full name" required>
                        <div class="error-message" id="registerNameError">Name must be at least 2 characters</div>
                    </div>

                    <div class="form-group">
                        <label for="registerMatricNo" class="form-label">Matric Number</label>
                        <input type="text" name="matric_no" id="registerMatricNo" class="form-control" placeholder="Enter your Matric Number" required>
                        <div class="error-message" id="registerMatricNoError">Please enter a valid matric Number</div>
                    </div>

                    <div class="form-group">
                        <label for="registerEmail" class="form-label">Email</label>
                        <input type="email" name="email" id="registerEmail" class="form-control" placeholder="Enter your Email" required>
                        <div class="error-message" id="registerEmailError">Please enter a valid Email address</div>
                    </div>

                    <div class="form-group">
                        <label for="registerPhone" class="form-label">Phone Number</label>
                        <input type="tel" name="phone" id="registerPhone" class="form-control" placeholder="Enter your phone number" required>
                        <div class="error-message" id="registerPhoneError">Please enter a valid phone number</div>
                    </div>

                    <div class="form-group">
                        <label for="registerDepartment" class="form-label">Department</label>
                        <select name="department" id="registerDepartment" class="form-control" required>
                            <option value="">Select your department</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Engineering">Engineering</option>
                            <option value="Business Administration">Business Administration</option>
                            <option value="Mass Communication">Mass Communication</option>
                            <option value="Law">Law</option>
                            <option value="Medicine">Medicine</option>
                            <option value="Education">Education</option>
                            <option value="Arts">Arts</option>
                            <option value="Sciences">Sciences</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="error-message" id="registerDepartmentError">Please select your department</div>
                    </div>

                    <div class="form-group">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password" name="password" id="registerPassword" class="form-control" placeholder="Create a password" required>
                        <div class="error-message" id="registerPasswordError">Password must be at least 6 characters</div>
                    </div>

                    <div class="form-group">
                        <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="registerConfirmPassword" class="form-control" placeholder="Confirm your password" required>
                        <div class="error-message" id="registerConfirmPasswordError">Passwords do not match</div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="registerBtn">
                            <span class="btn-text">Create Account</span>
                            <div class="loading-spinner" id="registerSpinner"></div>
                        </button>
                    </div>

                    <div class="form-toggle">
                        <p>Already have an account?</p>
                        <a href="#" class="toggle-link" id="showLoginFromRegister">Sign In</a>
                    </div>
                </form>

                <!-- Admin Login Form -->
                <form method="POST" action="{{ route('admin.login.submit') }}" id="adminLoginForm" class="auth-form">
                    @csrf
                    <div class="form-header">
                        <h2>Admin Login</h2>
                        <p>Sign in as an administrator</p>
                    </div>

                    <div class="form-group">
                        <label for="adminId" class="form-label">Admin ID</label>
                        <input type="text" name="admin_id" id="adminId" class="form-control" placeholder="Enter your Admin ID" required>
                        <div class="error-message" id="adminIdError">Please enter a valid Admin ID</div>
                    </div>

                    <div class="form-group">
                        <label for="adminPassword" class="form-label">Password</label>
                        <input type="password" name="password" id="adminPassword" class="form-control" placeholder="Enter your password" required>
                        <div class="error-message" id="adminPasswordError">Password must be at least 6 characters</div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="adminLoginBtn">
                            <span class="btn-text">Sign In</span>
                            <div class="loading-spinner" id="adminLoginSpinner"></div>
                        </button>
                    </div>

                    <div class="form-toggle d-flex justify-center" style="gap: 4rem;">
                        <a href="#" class="toggle-link" id="showLoginFromAdmin">User Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Hide login error alert after 3 seconds
    const loginErrorAlert = document.getElementById('loginErrorAlert');
    if (loginErrorAlert) {
        setTimeout(function() {
            loginErrorAlert.style.display = 'none';
        }, 3000);
    }
    const showRegister = document.getElementById('showRegister');
    const showLoginFromRegister = document.getElementById('showLoginFromRegister');
    const showLoginFromAdmin = document.getElementById('showLoginFromAdmin');
    const showRegisterAdmin = document.getElementById('showRegisterAdmin');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const adminLoginForm = document.getElementById('adminLoginForm');

    if (showRegister) {
        showRegister.addEventListener('click', function (e) {
            e.preventDefault();
            loginForm.classList.remove('active');
            adminLoginForm.classList.remove('active');
            registerForm.classList.add('active');
        });
    }

    if (showLoginFromRegister) {
        showLoginFromRegister.addEventListener('click', function (e) {
            e.preventDefault();
            registerForm.classList.remove('active');
            adminLoginForm.classList.remove('active');
            loginForm.classList.add('active');
        });
    }

    if (showLoginFromAdmin) {
        showLoginFromAdmin.addEventListener('click', function (e) {
            e.preventDefault();
            registerForm.classList.remove('active');
            adminLoginForm.classList.remove('active');
            loginForm.classList.add('active');
        });
    }

    if (showRegisterAdmin) {
        showRegisterAdmin.addEventListener('click', function (e) {
            e.preventDefault();
            loginForm.classList.remove('active');
            registerForm.classList.remove('active');
            adminLoginForm.classList.add('active');
        });
    }
});
</script>
</body>
</html>
