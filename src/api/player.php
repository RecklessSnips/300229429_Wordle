<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        die(json_encode(["error" => "Invalid JSON: " . json_last_error_msg()]));
    }

    if (isset($data['a_number']) && isset($data['a_attempts'])) {
        $player = isset($data['current_player']) && !empty($data['current_player']) ? $data['current_player'] : 'Anonymous';
        $attempt_number = $data['a_number'];
        $attempts = $data['a_attempts'];
        $_SESSION["Player_$player: $attempt_number"] = "$attempt_number $attempts";
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo json_encode($_SESSION);
} else {
    echo json_encode(["error" => "Life not set"]);
}
?>