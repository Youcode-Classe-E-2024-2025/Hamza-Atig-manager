<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role']!== 'freelancer') {
    header("Location: login.php");
    exit();
}

$gig_id = $_GET['gig_id'];

include '../src/database/db.php';

$sql = "DELETE FROM gigs WHERE id = '$gig_id' AND freelancer_id = '".$_SESSION['user_id']."'";
mysqli_query($conn, $sql);

header("Location: freelancer.php");
exit();

?>
