<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role']!== 'freelancer') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $subcategory = $_POST["subcategory"];
    $skills = $_POST["skills"];
    $experience = $_POST["experience"];
    $delivery_time = $_POST["delivery_time"];
    $gig_type = $_POST["gig_type"];

    $conn = mysqli_connect("your_host", "your_username", "your_password", "your_database");

    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }

    $sql = "INSERT INTO gigs (title, description, price, category, subcategory, skills, experience, delivery_time, gig_type, freelancer_id)
            VALUES ('$title', '$description', '$price', '$category', '$subcategory', '$skills', '$experience', '$delivery_time', '$gig_type', '".$_SESSION['user_id']."')";

    if (mysqli_query($conn, $sql)) {
        echo "Gig created successfully!";
    } else {
        echo "Error: ". $sql. "<br>". mysqli_error($conn);
    }

    mysqli_close($conn);
}

header("Location: freelancer.php");
exit();
?>
