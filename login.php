<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPro - Connexion</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
        }

        .auth-banner {
            background: linear-gradient(180deg, #4f46e5 0%, #3730a3 100%);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .auth-banner h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .auth-banner p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .auth-banner .icon {
            font-size: 5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .auth-form-container {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid #e5e7eb;
        }

        .auth-tab {
            padding: 1rem 2rem;
            background: none;
            border: none;
            font-size: 1.1rem;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .auth-tab.active {
            color: #4f46e5;
        }

        .auth-tab.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #4f46e5;
        }

        .auth-tab:hover {
            color: #4f46e5;
        }

        .auth-form {
            display: none;
        }

        .auth-form.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-title {
            font-size: 1.8rem;
            color: #1f2937;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.9rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-group label {
            font-size: 0.9rem;
            color: #6b7280;
            cursor: pointer;
        }

        .btn-auth {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
        }

        .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }

        .forgot-password a {
            color: #4f46e5;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #e5e7eb;
        }

        .divider span {
            padding: 0 1rem;
            color: #6b7280;
            font-size: 0.9rem;
        }

        .social-login {
            display: flex;
            gap: 1rem;
        }

        .btn-social {
            flex: 1;
            padding: 0.8rem;
            border: 2px solid #e5e7eb;
            background: white;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .btn-social:hover {
            border-color: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .auth-container {
                grid-template-columns: 1fr;
            }

            .auth-banner {
                padding: 2rem;
                min-height: 200px;
            }

            .auth-banner h1 {
                font-size: 2rem;
            }

            .auth-banner .icon {
                font-size: 3rem;
                margin-bottom: 1rem;
            }

            .auth-form-container {
                padding: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .auth-tabs {
                justify-content: center;
            }

            .auth-tab {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-banner">
            <div class="icon">🏋️</div>
            <h1>GymPro</h1>
            <p>Gérez votre salle de sport efficacement avec notre plateforme complète</p>
        </div>

        <div class="auth-form-container">
            <div class="auth-tabs">
                <button class="auth-tab active" onclick="switchTab('login')">Connexion</button>
                <button class="auth-tab" onclick="switchTab('signup')">Inscription</button>
            </div>

            <!-- Login Form -->
            <form class="auth-form active" id="login-form" action="formhandling.php" method="post">
                <h2 class="form-title">Bienvenue</h2>
                
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" name="email" class="form-control" placeholder="exemple@email.com" required>
                </div>

                <div class="form-group">
                    <label for="login-password">Mot de passe</label>
                    <input type="password" id="login-password" name="login-pass" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Se souvenir de moi</label>
                </div>

                <button type="submit" class="btn-auth" name="login">Se connecter</button>

            </form>

            <!-- Signup Form -->
            <form class="auth-form" id="signup-form" action="formhandling.php" method="post">
                <h2 class="form-title">Créer un compte</h2>
                
                <div class="form-row" method = "post">
                    <div class="form-group">
                        <label for="signup-firstname">Prénom</label>
                        <input type="text" id="signup-firstname" name="fname" class="form-control" placeholder="Jean" required>
                    </div>
                    <div class="form-group">
                        <label for="signup-lastname">Nom</label>
                        <input type="text" id="signup-lastname" name="lname" class="form-control" placeholder="Dupont" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="signup-email">Email</label>
                    <input type="email" id="signup-email" class="form-control" name="emailSignup" placeholder="exemple@email.com" required>
                </div>

                <div class="form-group">
                    <label for="signup-password">Mot de passe</label>
                    <input type="password" id="signup-password" name="signup_pass" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label for="signup-confirm-password">Confirmer le mot de passe</label>
                    <input type="password" id="signup-confirm-password" name="conf_signup_pass" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" name="signup" class="btn-auth">S'inscrire</button>

                
            </form>
        </div>
    </div>

    <script>
        // Switch between login and signup tabs
        function switchTab(tab) {
            const tabs = document.querySelectorAll('.auth-tab');
            const forms = document.querySelectorAll('.auth-form');

            tabs.forEach(t => t.classList.remove('active'));
            forms.forEach(f => f.classList.remove('active'));

            if (tab === 'login') {
                tabs[0].classList.add('active');
                document.getElementById('login-form').classList.add('active');
            } else {
                tabs[1].classList.add('active');
                document.getElementById('signup-form').classList.add('active');
            }
        }

        // Handle login form submission
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;

            // Add your login logic here
            console.log('Login:', { email, password });
            
            // Simulate successful login
            alert('Connexion réussie!');
            
            // Redirect to main application (change the path as needed)
            window.location.href = '../index.php';
        });

        // Handle signup form submission
        document.getElementById('signup-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const firstname = document.getElementById('signup-firstname').value;
            const lastname = document.getElementById('signup-lastname').value;
            const email = document.getElementById('signup-email').value;
            const password = document.getElementById('signup-password').value;
            const confirmPassword = document.getElementById('signup-confirm-password').value;

            // Validate passwords match
            if (password !== confirmPassword) {
                alert('Les mots de passe ne correspondent pas!');
                return;
            }

            // Add your signup logic here
            console.log('Signup:', { firstname, lastname, email, password });
            
            // Simulate successful signup
            alert('Inscription réussie! Vous pouvez maintenant vous connecter.');
            
            // Switch to login tab
            <?php
            header("Location : index.php")
            ?>
        });
    </script>
</body>
</html>