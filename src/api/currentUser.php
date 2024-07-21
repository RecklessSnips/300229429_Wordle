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

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    $_SESSION['currentUser'] = $data['current_player'];
}

if ($_SERVER["REQUEST_METHOD"] === "GET"){
    if(isset($_SESSION['currentUser'])){
        echo json_encode($_SESSION['currentUser']);
    }else{
        echo json_encode("");
    }
}


?>
