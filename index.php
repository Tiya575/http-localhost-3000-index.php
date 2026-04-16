<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Auth</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 40px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 380px; text-align: center; color: white;
            transition: transform 0.5s ease-in-out;
        }
        h2 { margin-bottom: 20px; font-weight: 300; letter-spacing: 2px; }
        .input-box { width: 100%; margin-bottom: 20px; position: relative; }
        input {
            width: 100%; padding: 12px 15px; background: rgba(255,255,255,0.1);
            border: none; outline: none; border-radius: 30px; color: white;
            border: 1px solid rgba(255,255,255,0.3); transition: 0.3s;
        }
        input:focus { background: rgba(255,255,255,0.2); border-color: #fff; }
        button {
            width: 100%; padding: 12px; border-radius: 30px; border: none;
            background: #fff; color: #2575fc; font-weight: bold; cursor: pointer;
            transition: 0.3s; transform: scale(1);
        }
        button:hover { transform: scale(1.05); box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
        .toggle-link { margin-top: 15px; font-size: 0.9rem; cursor: pointer; opacity: 0.8; }
        .toggle-link:hover { opacity: 1; text-decoration: underline; }
        
        /* Animations */
        .hidden { display: none; }
        .fade-in { animation: fadeIn 0.5s forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

<div class="container fade-in" id="auth-box">
    <!-- Login Form -->
    <div id="login-form">
        <h2>LOGIN</h2>
        <form action="auth_handler.php?action=login" method="POST">
            <div class="input-box"><input type="text" name="username" placeholder="Username" required></div>
            <div class="input-box"><input type="password" name="password" placeholder="Password" required></div>
            <button type="submit">Sign In</button>
        </form>
        <p class="toggle-link" onclick="toggleForm()">Don't have an account? Register</p>
    </div>

    <!-- Register Form -->
    <div id="register-form" class="hidden">
        <h2>REGISTER</h2>
        <form action="auth_handler.php?action=register" method="POST">
            <div class="input-box"><input type="text" name="username" placeholder="Choose Username" required></div>
            <div class="input-box"><input type="password" name="password" placeholder="Create Password" required></div>
            <button type="submit" style="background: #2575fc; color: #fff; border: 1px solid #fff;">Create Account</button>
        </form>
        <p class="toggle-link" onclick="toggleForm()">Already have an account? Login</p>
    </div>
</div>

<script>
    function toggleForm() {
        const login = document.getElementById('login-form');
        const register = document.getElementById('register-form');
        login.classList.toggle('hidden');
        register.classList.toggle('hidden');
        document.getElementById('auth-box').classList.add('fade-in');
    }
</script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modern Auth System</title>
    <style>
        :root { --primary: #6c5ce7; --bg: #0f0c29; }
        body { 
            background: linear-gradient(to right, #24243e, #302b63, #0f0c29);
            height: 100vh; display: flex; align-items: center; justify-content: center;
            font-family: 'Poppins', sans-serif; color: white;
        }
        /* Glassmorphism Card */
        .auth-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px; border-radius: 20px; width: 350px;
            box-shadow: 0 25px 45px rgba(0,0,0,0.2);
        }
        input {
            width: 100%; padding: 12px; margin-top: 15px; border-radius: 8px;
            border: none; background: rgba(255,255,255,0.1); color: white; outline: none;
        }
        /* UNIQUE FEATURE: Password Strength Bar */
        .strength-meter {
            height: 4px; width: 0%; background: #ff4757;
            margin-top: 5px; transition: 0.3s; border-radius: 2px;
        }
        button {
            width: 100%; padding: 12px; margin-top: 20px; border-radius: 8px;
            border: none; background: var(--primary); color: white; cursor: pointer;
            font-weight: bold; transition: 0.3s;
        }
        button:hover { opacity: 0.8; transform: translateY(-2px); }
        .toggle-btn { font-size: 0.8rem; margin-top: 15px; cursor: pointer; opacity: 0.7; }
        .hidden { display: none; }
    </style>
</head>
<body>

<div class="auth-card">
    <div id="form-container">
        <h2 id="form-title">Login</h2>
        <form action="process.php" method="POST">
            <input type="hidden" name="action" id="form-action" value="login">
            <input type="text" name="username" placeholder="Username" required>
            
            <div style="position:relative;">
                <input type="password" name="password" id="pw" placeholder="Password" required>
                <!-- UNIQUE FEATURE: Toggle visibility -->
                <span onclick="toggleView()" style="position:absolute; right:10px; top:25px; cursor:pointer; font-size:12px;">👁️</span>
            </div>
            
            <div id="meter-container" class="hidden">
                <div class="strength-meter" id="meter"></div>
            </div>

            <button type="submit" id="submit-btn">Sign In</button>
        </form>
        <p class="toggle-btn" onclick="switchForm()">New here? Create an account</p>
    </div>
</div>

<script>
    function switchForm() {
        const title = document.getElementById('form-title');
        const action = document.getElementById('form-action');
        const btn = document.getElementById('submit-btn');
        const meter = document.getElementById('meter-container');
        
        if(action.value === 'login') {
            title.innerText = 'Sign Up';
            action.value = 'signup';
            btn.innerText = 'Register';
            meter.classList.remove('hidden');
        } else {
            title.innerText = 'Login';
            action.value = 'login';
            btn.innerText = 'Sign In';
            meter.classList.add('hidden');
        }
    }

    // Logic for Password Strength Meter
    document.getElementById('pw').addEventListener('input', function(e) {
        const val = e.target.value;
        const meter = document.getElementById('meter');
        let strength = val.length * 10;
        if(strength > 100) strength = 100;
        meter.style.width = strength + '%';
        meter.style.background = strength < 50 ? '#ff4757' : (strength < 80 ? '#ffa502' : '#2ed573');
    });

    function toggleView() {
        const pw = document.getElementById('pw');
        pw.type = pw.type === 'password' ? 'text' : 'password';
    }
</script>
</body>
</html>

