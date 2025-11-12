<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #DCE1E7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
        }
        
       
        .row.g-0 {
            display: flex;
            flex-wrap: wrap;
        }
        
        .login-form-section {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 520px;
        }
        
        .brand-section {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 520px;
            height: 100%; 
        }
        
        .brand-logo {
            margin-bottom: 20px;
        }
             .logo-container {
    padding: 15px 20px; 
    text-align: center;
  
    flex-shrink: 0;
}
        .logo-img {
            width: 200px;
            height: auto;
           
        }
        
        .brand-name {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.3;
        }
        
        .brand-tagline {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 20px;
        }
        
        .brand-quote {
            font-style: italic;
            opacity: 0.9;
            font-size: 14px;
        }
        
        .form-control {
            border-radius: 6px;
            padding: 12px 15px;
            border: 1px solid #e3e6f0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .input-group-text {
            background-color: #f8f9fc;
            border: 1px solid #e3e6f0;
        }
        
        .btn-login {
            background-color: #4e73df;
            border: none;
            border-radius: 6px;
            padding: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-login:hover {
            background-color: #2e59d9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .login-title {
            font-weight: 700;
            color: #4e73df;
            margin-bottom: 30px;
        }
        
        .password-toggle {
            cursor: pointer;
            background-color: #f8f9fc;
            border: 1px solid #e3e6f0;
            border-left: none;
        }
        
        @media (max-width: 768px) {
            .brand-section {
                padding: 30px 20px;
                min-height: 300px;
            }
            
            .brand-name {
                font-size: 20px; 
            }
            
            .login-form-section {
                padding: 30px 20px;
                min-height: auto;
            }
            
            .logo-img {
                width: 160px;
            }
           
            .row.g-0 {
                flex-direction: column;
            }
        }

        @media (max-width: 576px) {
            .brand-name {
                font-size: 18px; 
            }
            
            .logo-img {
                width: 140px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="login-container">
                    <div class="row g-0">
                        
                        <div class="col-md-7">
                            <div class="login-form-section">
                                <h2 class="login-title text-center">Welcome!</h2>
                                
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    
                                   
                                    <div class="mb-4">
                                        <label for="email" class="form-label fw-semibold">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email">
                                        </div>
                                        <div class="text-danger mt-1 small">
                                           
                                        </div>
                                    </div>
                                    
                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label for="password" class="form-label fw-semibold">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Enter your password">
                                            <span class="input-group-text password-toggle" id="togglePassword">
                                                <i class="fas fa-eye" id="toggleIcon"></i>
                                            </span>
                                        </div>
                                        <div class="text-danger mt-1 small">
                                            
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-login">
                                            <i class="fas fa-sign-in-alt me-2"></i>Log In
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-5">
                            <div class="brand-section">
                                             <div class="logo-container">
    <div class="logo">
        <img src="{{ asset('images/davao.png') }}" alt="Davao Modern Glass and Aluminum Supply Corp" class="logo-img">
    
    </div>

                                <div class="mt-4">
                                    <p class="brand-quote"><i class="fas fa-quote-left me-2"></i>Great products are built by passionate teams</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>