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

    // Initialize Attempt_Number if not already set
    $current_player = $data['current_player'];
    $attempts_key = "Att_num_$current_player";
    
    if (!isset($_SESSION[$attempts_key])) {
        $_SESSION[$attempts_key] = 1;
    } else {
        $_SESSION[$attempts_key] += 1;
    }

} elseif ($_SERVER["REQUEST_METHOD"] === "GET"){
    echo json_encode($_SESSION);
} else {
    echo json_encode(["error" => "Life not set"]);
}
?>
