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

    if(isset($data["player"]) && isset($data["attempt_number"]) && isset($data["attempts"])){
        $nick_name = $data["player"];
        $attempt_number = $data["attempt_number"];
        $attempts = $data['attempts'];

        $sql = "INSERT INTO User (nick_name, attempt_number, attempts)
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE attempt_number = VALUES(attempt_number), attempts = VALUES(attempts)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $nick_name, $attempt_number, $attempts);

        if ($stmt->execute()) {
            $stmt->close();

            // Add to the scoreboard automatically
            $sql_1 = "INSERT INTO ScoreBoard (user_name) VALUES (?) ON DUPLICATE KEY UPDATE user_name = VALUES(user_name)";
            $stmt_1 = $conn->prepare($sql_1);
            $stmt_1->bind_param("s", $nick_name);

            if ($stmt_1->execute()) {
                echo json_encode(["score stored" => true]);
            } else {
                echo json_encode(["score fail to store" => false, "error" => $stmt_1->error]);
            }
            $stmt_1->close();
        } else {
            echo json_encode(["score fail to store" => false, "error" => $stmt->error]);
        }
    }else {
        echo json_encode(["error" => "Invalid input"]);
    }
}

$conn->close();
?>