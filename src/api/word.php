<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

$words = [
  'apple', 'about', 'above', 'actor', 'acute', 'adopt', 'asain', 'aside', 'avoid', 'aware',
  'baker', 'bland', 'blunt', 'broad', 'brush', 'brief', 'bread', 'break', 'broke', 'below',
  'carry', 'catch', 'cause', 'cedar', 'chant', 'claim', 'class', 'climb', 'clear', 'cendy',
  'dance', 'dandy', 'death', 'debit', 'decoy', 'depth', 'delay', 'daddy', 'dirty', 'doubt',
  'eagle', 'early', 'earth', 'easel', 'eject', 'ethic', 'equal', 'event', 'every', 'exact',
  'fable', 'facet', 'faith', 'fancy', 'feast', 'floor', 'first', 'final', 'flame', 'floor'
];

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $random_word = $words[array_rand($words)];
    $_SESSION['answer'] = $random_word;
    echo json_encode(["answer" => $_SESSION['answer']]);
}
?>
