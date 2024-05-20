بناء علي الكود التالي
<?php
// معلومات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";

try {
    // إنشاء الاتصال
    $conn = new PDO("mysql:host=$servername;", $username, $password);

    // تعيين خيارات الاتصال
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // إنشاء قاعدة البيانات إذا لم تكن موجودة بالفعل
    $sql = "CREATE DATABASE IF NOT EXISTS username";
    $conn->exec($sql);

    echo "تم إنشاء قاعدة البيانات بنجاح<br>";

    // استخدام قاعدة البيانات الجديدة
    $conn->exec("USE username");

    // إنشاء جدول الطلاب
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user VARCHAR(100),
        pas VARCHAR(100)
    )";
    $conn->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS comment (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user TEXT,
        comment TEXT
    )";
    $conn->exec($sql);

    echo "تم إنشاء الجدول 'comment' بنجاح<br>";
} catch (PDOException $e) {
    echo "فشل في الاتصال: " . $e->getMessage();
}

$conn = null; // إغلاق الاتصال

?>