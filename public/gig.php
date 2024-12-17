<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role']!== 'freelancer') {
    header("Location: login.php");
    exit();
}

$gig_id = $_GET['gig_id'];

include '../src/database/db.php';

$sql = "SELECT * FROM gigs WHERE id = '$gig_id' AND freelancer_id = '".$_SESSION['user_id']."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gig Details</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>
    <div class="h-screen w-full flex overflow-hidden select-none overflow-y-auto">
        <div class="w-full flex flex-col items-center p-10 bg-white rounded-lg">
            <h2 class="text-3xl font-bold mb-4">Gig Details</h2>
            <div class="flex flex-col w-full mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <span id="title" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300"><?php echo $row['title'];?></span>
            </div>
            <div class="flex flex-col w-full mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <span id="description" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300"><?php echo $row['description'];?></span>
            </div>
            <div class="flex flex-col w-full mb-4">
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                <span id="price" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300">$<?php echo number_format($row['price'], 2);?></span>
            </div>
            <div class="flex flex-col w-full mb-4">
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                <span id="category" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300"><?php echo $row['category'];?></span>
            </div>
            <div class="flex flex-col w-full mb-4">
                <label for="subcategory" class="block text-gray-700 text-sm font-bold mb-2">Subcategory:</label>
                <span id="subcategory" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300"><?php echo $row['subcategory'];?></span>
            </div>
            <div class="flex flex-col w-full mb-4">
                <label for="skills" class="block text-gray-700 text-sm font-bold mb-2">Skills:</label>
                <span id="skills" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300"><?php echo $row['skills'];?></span>
            </div>
            <div class="flex flex-col w-full mb-4">
                <label for="experience" class="block text-gray-700 text-sm font-bold mb-2">Experience:</label>
                <span id="experience" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300"><?php echo $row['experience'];?></span>
            </div>
            <div class="flex flex-col w-full mb-4">
                <label for="delivery_time" class="block text-gray-700 text-sm font-bold mb-2">Delivery Time:</label>
                <span id="delivery_time" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300"><?php echo $row['delivery_time'];?></span>
            </div>
            <div class="flex flex-col w-full mb-4">
                <label for="gig_type" class="block text-gray-700 text-sm font-bold mb-2">Gig Type:</label>
                <span id="gig_type" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300"><?php echo $row['gig_type'];?></span>
            </div>
            <div class="flex flex-col w-full mb-4 gap-6">
                <button class="bg-green-400 hover:bg-green-500 rounded-lg py-2 px-4 text-white">
                    <a href="modify-gig.php?gig_id=<?php echo $gig_id;?>">Modify Gig</a>
                </button>
                <button class="bg-red-600 hover:bg-red-700 rounded-lg py-2 px-4 text-white">
                    <a href="delete-gig.php?gig_id=<?php echo $gig_id;?>">Delete Gig</a>
                </button>
            </div>
        </div>
    </div>
</body>
</html>
<?php
} else {
    header("Location: freelancer.php");
    exit();
}

mysqli_close($conn);
?>
