<?php
// استقبال البيانات من النموذج
$username = $_POST['user'];
$comment = $_POST['comment'];

// التحقق من وجود قيم غير فارغة
if (!empty($username) && !empty($comment)) {
    // معلومات الاتصال بقاعدة البيانات
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "username";

    try {
        // إنشاء الاتصال
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);

        // تعيين خيارات الاتصال
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // إدراج التعليق في قاعدة البيانات
        $sql = "INSERT INTO comment (user, comment) VALUES (:username, :comment)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();

        echo "تم إرسال التعليق بنجاح";
        echo "<script>window.location.href = './showComannt.php';</script>";
    } catch (PDOException $e) {
        echo "خطأ في إرسال التعليق: " . $e->getMessage();
        echo "خطأ في إرسال التعليق: " . $e->getMessage();
    }

    // إغلاق الاتصال
    $conn = null;
} else {
    echo "يرجى تعبئة جميع الحقول";
}
