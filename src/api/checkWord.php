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

    if (isset($data['word']) && isset($data['answer']) && isset($data['currentRow']) && isset($data['currentCol'])) {
        $word = strtoupper($data['word']);
        $answer = strtoupper($data['answer']);
        $currentRow = $data['currentRow'];
        $currentCol = $data['currentCol'];
        $index = array_fill(0, 5, -1);
        
        for ($i = 0; $i < strlen($word); $i++) {
            if ($word[$i] === $answer[$i]) {
                $index[$i] = 1;
            } elseif (strpos($answer, $word[$i]) !== false) {
                $index[$i] = 0;
            }
        }

        if ($word === $answer) {
            echo json_encode(["result" => "win", "index" => $index]);
        } elseif ($data['currentRow'] >= 5) {
            echo json_encode(["result" => "lose", "index" => $index]);
        } else {
            echo json_encode(["result" => "continue", "index" => $index]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Missing required fields"]);
    }
}else {
    echo json_encode(["error" => "Life not set"]);
}
?>
