<?php
session_start();
include '../src/database/db.php';

$gig_id = $_GET['id'];

$user_id = $_SESSION['user_id'];
$user_name_sql = "SELECT username FROM users WHERE id = '$user_id'";
$user_name_result = mysqli_query($conn, $user_name_sql);
if (mysqli_num_rows($user_name_result) > 0) {
    $user_name_row = mysqli_fetch_assoc($user_name_result);
    $user_name = $user_name_row['username']?? '';
} else {
    $user_name = '';
}

$gig_creator_sql = "SELECT freelancer_id FROM gigs WHERE id = '$gig_id'";
$gig_creator_result = mysqli_query($conn, $gig_creator_sql);
if (mysqli_num_rows($gig_creator_result) > 0) {
    $gig_creator_row = mysqli_fetch_assoc($gig_creator_result);
    if (isset($gig_creator_row['freelancer_id'])) {
        $gig_creator_id = $gig_creator_row['freelancer_id'];
        $gig_creator_name_sql = "SELECT username FROM users WHERE id = '$gig_creator_id'";
        $gig_creator_name_result = mysqli_query($conn, $gig_creator_name_sql);
        if (mysqli_num_rows($gig_creator_name_result) > 0) {
            $gig_creator_name_row = mysqli_fetch_assoc($gig_creator_name_result);
            $gig_creator_name = $gig_creator_name_row['username']?? '';
        } else {
            $gig_creator_name = '';
        }
    } else {
        $gig_creator_id = '';
        $gig_creator_name = '';
    }
} else {
    $gig_creator_id = '';
    $gig_creator_name = '';
}

$gig_title_sql = "SELECT title FROM gigs WHERE id = '$gig_id'";
$gig_title_result = mysqli_query($conn, $gig_title_sql);
$gig_title_row = mysqli_fetch_assoc($gig_title_result);
$gig_title = $gig_title_row['title'];

$sql = "INSERT INTO reports (report_sender_id, report_sender_name, gig_id, gig_title, gig_creator_id, gig_creator_name) VALUES ('$user_id', '$user_name', '$gig_id', '$gig_title', '$gig_creator_id', '$gig_creator_name')";
mysqli_query($conn, $sql);

header("Location: client.php");
exit();
?>
