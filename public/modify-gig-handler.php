<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role']!== 'freelancer') {
    header("Location: login.php");
    exit();
}

$gig_id = $_POST['gig_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];
$subcategory = $_POST['subcategory'];
$skills = $_POST['skills'];
$experience = $_POST['experience'];
$delivery_time = $_POST['delivery_time'];
$gig_type = $_POST['gig_type'];

include '../src/database/db.php';

$sql = "UPDATE gigs SET title = '$title', description = '$description', price = '$price', category = '$category', subcategory = '$subcategory', skills = '$skills', experience = '$experience', delivery_time = '$delivery_time', gig_type = '$gig_type' WHERE id = '$gig_id' AND freelancer_id = '".$_SESSION['user_id']."'";
mysqli_query($conn, $sql);

header("Location: gig.php?gig_id=$gig_id");
exit();

mysqli_close($conn);
?>
