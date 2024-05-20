<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
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

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: #999;
        }

        input[type="text"]::-webkit-input-placeholder,
        input[type="password"]::-webkit-input-placeholder {
            color: #999;
        }

        input[type="text"]::-moz-placeholder,
        input[type="password"]::-moz-placeholder {
            color: #999;
        }

        input[type="text"]:-ms-input-placeholder,
        input[type="password"]:-ms-input-placeholder {
            color: #999;
        }
    </style>
</head>

<body>
    <h2>Register</h2>
    <form id="registerForm" action="" method="post">
        <input type="text" id="username" name="username" placeholder="Username" required><br><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // معلومات الاتصال بقاعدة البيانات
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "username"; // اسم قاعدة البيانات

        try {
            // إنشاء الاتصال بقاعدة البيانات
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            
            // تعيين خيارات الاتصال
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // استخراج البيانات من النموذج
            $username = $_POST['username'];
            $password = $_POST['password'];

            // تحضير الاستعلام لإدخال البيانات إلى جدول المستخدمين
            $stmt = $conn->prepare("INSERT INTO users (user, pas) VALUES (:user, :password)");
            $stmt->bindParam(':user', $username);
            $stmt->bindParam(':password', $password);

            // تنفيذ الاستعلام
            $stmt->execute();

            echo "تم تسجيل الحساب بنجاح!";
        } catch(PDOException $e) {
            echo "فشل في الاتصال: " . $e->getMessage();
        }

        $conn = null; // إغلاق الاتصال
    }
    ?>
</body>

</html>