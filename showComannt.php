<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة التعليقات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        form {
            width: 60%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }

        input[type="text"],
        input[type="submit"] {
            padding: 10px;
            width: 100%;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #commentsSection {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <h1>صفحة التعليقات</h1>
    <form id="commentForm" action="submit_comment.php" method="POST">
        <label for="username">الاسم:</label><br>
        <input type="text" id="user" name="user"> <br><br>
        <label for="comment">التعليق:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
        <br><br>
        <input type="submit" value="إرسال التعليق">
    </form>

    <div id="commentsSection">
        <?php
        // اتصال بقاعدة البيانات
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "username";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // التحقق من الاتصال
        if ($conn->connect_error) {
            die("فشل الاتصال: " . $conn->connect_error);
        }

        // استعلام SQL لاسترداد التعليقات
        $sql = "SELECT user, comment FROM comment";
        $result = $conn->query($sql);

        // عرض التعليقات كتعليقات HTML داخل div
        if ($result->num_rows > 0) {
            echo '<div id="commentsSection">';
            echo '<h2>التعليقات:</h2>';
            echo '<ul>';
            while ($row = $result->fetch_assoc()) {
                echo '<li><strong>' . $row["user"] . ':</strong> ' . $row["comment"] . '</li>';
            }
            echo '</ul>';
            echo '</div>';
        } else {
            echo "لا توجد تعليقات حتى الآن.";
        }

        // إغلاق الاتصال
        $conn->close();
        ?>

    </div>

</body>

</html>