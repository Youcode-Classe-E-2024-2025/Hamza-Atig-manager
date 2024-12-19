<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $submittedKey = $_POST['securityKey'];
    $validKey = "4K2eJ#8dNBpL5aG9mF1";

    if ($submittedKey === $validKey) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid security key."]);
    }
    exit;
}
?>
