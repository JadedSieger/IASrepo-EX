<?php
require '../tools/db.php';

header('Content-Type: application/json');

// --- Manual .env loader ---
function loadEnv($filePath) {
    if (!file_exists($filePath)) return;
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (strpos($line, '#') === 0) continue; 
        if (strpos($line, '=') === false) continue; 
        [$name, $value] = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

loadEnv(__DIR__ . '/../private/.env');

$hfToken = $_ENV['HF_API_TOKEN'] ?? '';
$model   = $_ENV['HF_MODEL'] ?? '';

$input = json_decode(file_get_contents("php://input"), true);
$title = trim($input['title'] ?? '');
$message = trim($input['message'] ?? '');
$user_id = $_SESSION["user_id"] ?? null;

if (!$title || !$message) {
    echo json_encode(["response" => "All fields are required."]);
    exit;
}

// --- Save to database ---
$success = "";
$error = "";

$conn = getDBConnection();
$stmt = $conn->prepare("INSERT INTO submissions (user_id, title, message) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $title, $message);
if ($stmt->execute()) {
    $success = "Submission saved!";
} else {
    $error = "Something went wrong while saving.";
}
$stmt->close();
$conn->close();

// --- Call Hugging Face API ---
$data = ["inputs" => "Persona: Mei, very understanding and therapeutic.\nUser: $message\nMei:"];
$ch = curl_init("https://api-inference.huggingface.co/models/$model");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $hfToken",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);

$apiResult = curl_exec($ch);
$curlErr = curl_error($ch);
curl_close($ch);

if ($curlErr) {
    $aiResponse = "AI_ERROR: API request failed ({$curlErr})";
} else {
    $decoded = json_decode($apiResult, true);
    $aiResponse = $decoded[0]['generated_text'] ?? "Sorry, something went wrong.";
}

echo json_encode([
    "response" => $aiResponse,
    "success" => $success,
    "error" => $error
]);
