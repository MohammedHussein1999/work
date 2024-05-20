<?php include './create.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2>Login</h2>
    <form id="loginForm" action="" method="post">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <?php
    // معلومات الاتصال بقاعدة البيانات
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "username"; // اسم قاعدة البيانات

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            // إنشاء الاتصال بقاعدة البيانات
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // تعيين خيارات الاتصال
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // استخراج البيانات من النموذج
            $username = $_POST['username'];
            $password = $_POST['password'];

            // تحضير الاستعلام للتحقق من وجود اسم المستخدم وكلمة المرور
            $stmt = $conn->prepare("SELECT * FROM users WHERE user = :user AND pas = :password");
            $stmt->bindParam(':user', $username);
            $stmt->bindParam(':password', $password);

            // تنفيذ الاستعلام
            $stmt->execute();

            // جلب النتائج
            $result = $stmt->fetch();

            if ($result) {
                // تم العثور على اسم المستخدم وكلمة المرور
                echo "تم تسجيل الدخول بنجاح!";
                echo "<script>window.location.href = 'homepage.html';</script>";
                exit;
            } else {
                // لم يتم العثور على اسم المستخدم وكلمة المرور
                echo "<div class='error-message'>اسم المستخدم أو كلمة المرور غير صحيحة.</div>";
            }
        } catch (PDOException $e) {
            echo "فشل في الاتصال: " . $e->getMessage();
        }


        $conn = null; // إغلاق الاتصال
    }
    ?>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</body>

</html>