<?php
session_start();
$_SESSION["IsLogin"] = false;

require_once('login_controller.php');

// Kết nối CSDL
$uri = "mysql://avnadmin:AVNS_Vy2-xdlO7vl2LYLDERP@mysql-18948baf-doqt2003-b35c.l.aivencloud.com:13953/quanlysach?ssl-mode=REQUIRED";
$fields = parse_url($uri);
$conn = "mysql:";
$conn .= "host=" . $fields["host"];
$conn .= ";port=" . $fields["port"];
$conn .= ";dbname=" . ltrim($fields["path"], '/');
$conn .= ";sslmode=verify-ca;sslrootcert=ca.pem";

try {
    $db = new PDO($conn, $fields["user"], $fields["pass"]);

    // Xử lý đăng nhập khi nhận được dữ liệu từ form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['usernameForm'];
        $password = $_POST['passwordForm'];

        $controller = new Login_Controller($db);
        $controller->processLogin($username, $password);
    }

    // Hiển thị form đăng nhập
    include('login_view.php');
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
