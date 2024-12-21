<?php
include '../src/database/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $submittedKey = $_POST['securityKey'];

    // Query the database to retrieve the security key
    $query = "SELECT security_key FROM security_keys WHERE id = 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $validKey = $row['security_key'];

        if ($submittedKey === $validKey) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid security key."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Security key not found in database."]);
    }

    $conn->close();
    exit;
}
?>
