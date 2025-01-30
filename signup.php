<?php
session_start();
include 'config.php'; // تأكد من أنك تملك هذا الملف للاتصال بقاعدة البيانات
include 'includes/header.php';
// التحقق من تسجيل الحساب
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // التحقق من وجود البريد مسبقًا
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();
    
    if ($check_stmt->num_rows > 0) {
        $error = "Email is already registered!";
    } else {
        // إدراج المستخدم الجديد في قاعدة البيانات
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
        $stmt->bind_param("sss", $name, $email, $password);
        
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['user_name'] = $name;
            $_SESSION['role'] = 'user';
            header("Location: index.php"); // توجيه المستخدم بعد التسجيل
            exit();
        } else {
            $error = "Registration failed, please try again!";
        }
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

        .signup-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 400px;
            width:400px;
            flex-direction: column;
            gap: 35px;
            background: #e3e3e3;
            box-shadow: 16px 16px 32px #c8c8c8,
                  -16px -16px 32px #fefefe;
            border-radius: 8px;
            padding: 2rem;
        }

        h2 {
            color: #000;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: block;
            font-weight: bold;
            font-size: x-large;
            margin-bottom: 20px;
            text-align: center;
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
            .signup-container {
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
    <div class="signup-container">
        <h2>Sign Up</h2>
        <?php if (isset($error)) : ?>
            <p class="error-msg"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="signup.php" method="POST">
            <div class="inputBox">
                <input type="text" name="name" required="required">
                <span>Full Name</span>
            </div>
            <div class="inputBox">
                <input type="email" name="email" required="required">
                <span>Email</span>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <span>Password</span>
            </div>
            <div style="text-align: center;">
                <button class="enter" type="submit">Sign Up</button>
            </div>
        </form>
        <div class="auth-links">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</main>
<script src="script.js"></script>
</body>
</html>
    <?php include 'includes/footer.php'; ?>