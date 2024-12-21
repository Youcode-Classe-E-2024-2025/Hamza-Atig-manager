<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role']!== 'freelancer') {
    header("Location: login.php");
    exit();
}

$gig_id = $_GET['gig_id'];

include '../src/database/db.php';

$sql = "SELECT title, freelancer_id FROM gigs WHERE id = '$gig_id' AND freelancer_id = '".$_SESSION['user_id']."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $gig_title = $row['title'];
    $freelancer_id = $row['freelancer_id'];

    $sql_freelancer = "SELECT username FROM users WHERE id = '$freelancer_id'";
    $result_freelancer = mysqli_query($conn, $sql_freelancer);
    $row_freelancer = mysqli_fetch_assoc($result_freelancer);
    $freelancer_name = $row_freelancer['username'];

    $sql_delete = "DELETE FROM gigs WHERE id = '$gig_id' AND freelancer_id = '".$_SESSION['user_id']."'";
    mysqli_query($conn, $sql_delete);

    $sql_insert = "INSERT INTO deleted_gigs (gig_title, freelancer_id, freelancer_name) VALUES ('$gig_title', '$freelancer_id', '$freelancer_name')";
    mysqli_query($conn, $sql_insert);

    header("Location: freelancer.php");
    exit();
} else {
    header("Location: freelancer.php");
    exit();
}
?>
