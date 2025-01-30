<?php
session_start();
include 'config.php'; // تأكد من أن لديك هذا الملف للاتصال بقاعدة البيانات
include 'includes/header.php'; 
// التحقق من تسجيل الدخول
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    $stmt = $conn->prepare("SELECT id, name, role, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // التحقق من كلمة المرور
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            
            // التوجيه بناءً على الدور
            if ($user['role'] === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Library</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login {
            color: #000;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: block;
            font-weight: bold;
            font-size: x-large;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 350px;
            width: 300px;
            flex-direction: column;
            gap: 35px;
            background: #e3e3e3;
            box-shadow: 16px 16px 32px #c8c8c8,
                  -16px -16px 32px #fefefe;
            border-radius: 8px;
            padding: 2rem;
        }

        .inputBox {
            position: relative;
            width: 250px;
        }

        .inputBox input {
            width: 100%;
            padding: 10px;
            outline: none;
            border: none;
            color: #000;
            font-size: 1em;
            background: transparent;
            border-left: 2px solid #000;
            border-bottom: 2px solid #000;
            transition: 0.1s;
            border-bottom-left-radius: 8px;
        }

        .inputBox span {
            margin-top: 5px;
            position: absolute;
            left: 0;
            transform: translateY(-4px);
            margin-left: 10px;
            padding: 10px;
            pointer-events: none;
            font-size: 12px;
            color: #000;
            text-transform: uppercase;
            transition: 0.5s;
            letter-spacing: 3px;
            border-radius: 8px;
        }

        .inputBox input:valid~span,
        .inputBox input:focus~span {
            transform: translateX(113px) translateY(-15px);
            font-size: 0.8em;
            padding: 5px 10px;
            background: #000;
            letter-spacing: 0.2em;
            color: #fff;
            border: 2px;
        }

        .inputBox input:valid,
        .inputBox input:focus {
            border: 2px solid #000;
            border-radius: 8px;
        }

        .enter {
            height: 45px;
            width: 100px;
            border-radius: 5px;
            border: 2px solid #000;
            cursor: pointer;
            background-color: transparent;
            transition: 0.5s;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 2px;
            margin-top: 15px;
        }

        .enter:hover {
            background-color: rgb(0, 0, 0);
            color: white;
        }

        .error-msg {
            background: #c8c8c8;
            color: rgb(0, 0, 0);
            padding: 0.8rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            border: 1px solid rgb(0, 0, 0);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
        }

        .auth-links {
            text-align: center;
            color: #666;
            margin-top: 15px;
            font-size: 0.9em;
        }

        .auth-links a {
            color: #000;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                width: 100%;
                margin: 1rem;
            }

            .inputBox {
                width: 100%;
            }
        }
    </style>
</head>
<body> 
<main>
    <div class="login-container">
        <h2 class="login">Login</h2>
        <?php if (isset($error)) : ?>
            <p class="error-msg"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="inputBox">
                <input type="email" name="email" required="required">
                <span>Email</span>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <span>Password</span>
            </div>
            <div style="text-align: center;">
                <button class="enter" type="submit">Enter</button>
            </div>
        </form>
        <div class="auth-links">
            <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
        </div>
    </div>
</main>
<script src="script.js"></script>
</body>
</html>
    <?php include 'includes/footer.php'; ?>