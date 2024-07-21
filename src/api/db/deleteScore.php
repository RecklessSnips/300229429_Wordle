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

    if(isset($data["current_player"])){

        $nick_name = $data["current_player"];

        $sql = "SELECT * FROM ScoreBoard WHERE user_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nick_name);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $sql_1 = "DELETE FROM ScoreBoard WHERE user_name = ?";
            $stmt_1 = $conn->prepare($sql_1);
            $stmt_1->bind_param("s", $nick_name);

            if ($stmt_1->execute()) {
                echo json_encode(["exists" => true]);
            } else {
                echo json_encode(["error" => "Failed to delete user"]);
            }
            $stmt_1->close();
        } else {
            echo json_encode(["notExist" => true]);
        }
    }else {
        echo json_encode(["error" => "Invalid input"]);
    }
}

$conn->close();
?>