<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "19960214At313!";
$dbname = "csi3140";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Fail to connect database". mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $nickname = $data['nickname'];

    $stmt = $conn->prepare("INSERT INTO User (nick_name) VALUES (?)");
    $stmt->bind_param("s", $nickname);

    $_SESSION['currentUser'] = $nickname;

    if ($stmt->execute()) {
        echo json_encode(["created" => true, 'currentUser' => $_SESSION['currentUser']]);
    } else {
        echo json_encode(["created" => false]);
    }

    $stmt->close();
}

$conn->close();
?>