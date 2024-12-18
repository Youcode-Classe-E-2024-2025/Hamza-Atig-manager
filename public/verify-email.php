<?php
include '../src/database/db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['token'])) {
    $verification_token = $_GET['token'];

    try {
        // Check if the token exists in the database
        $stmt = $conn->prepare("SELECT id, status, verified FROM users WHERE verification_token = ?");
        $stmt->bind_param("s", $verification_token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Check if the user is already verified
            if ($user['status'] === 'active') {
                echo "<script>alert('Your email is already verified!'); window.location.href = 'login.php';</script>";
            } else {
                // Only increment the verified column
                $update_stmt = $conn->prepare("UPDATE users SET verified = verified + 1 WHERE id = ?");
                $update_stmt->bind_param("i", $user['id']);
                if ($update_stmt->execute()) {
                    echo "<script>alert('Email verified successfully! You can now log in.'); window.location.href = 'login.php';</script>";
                } else {
                    echo "<script>alert('Error: Could not verify your email. Please try again later.'); window.location.href = 'signup.php';</script>";
                }
                $update_stmt->close();
            }
        } else {
            // Invalid or expired token
            echo "<script>alert('Invalid or expired verification link. Please sign up again.'); window.location.href = 'signup.php';</script>";
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
} else {
    // No token provided
    echo "<script>alert('Invalid request.'); window.location.href = 'signup.php';</script>";
}

$conn->close();
?>
