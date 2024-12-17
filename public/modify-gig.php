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
    <title>Modify Gig</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>
    <div class="h-screen w-full flex overflow-hidden select-none overflow-y-auto">
        <div class="w-full flex flex-col items-center p-10 bg-white rounded-lg">
            <h2 class="text-3xl font-bold mb-4">Modify Gig</h2>
            <form action="modify-gig-handler.php" method="post">
                <input type="hidden" name="gig_id" value="<?php echo $gig_id;?>">
                <div class="flex flex-col w-full mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo $row['title'];?>" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300">
                </div>
                <div class="flex flex-col w-full mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                    <textarea id="description" name="description" rows="5" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300"><?php echo $row['description'];?></textarea>
                </div>
                <div class="flex flex-col w-full mb-4">
                    <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                    <input type="number" step="0.01" id="price" name="price" value="<?php echo $row['price'];?>" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300">
                </div>
                <div class="flex flex-col w-full mb-4">
                    <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                    <input type="text" id="category" name="category" value="<?php echo $row['category'];?>" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300">
                </div>
                <div class="flex flex-col w-full mb-4">
                    <label for="subcategory" class="block text-gray-700 text-sm font-bold mb-2">Subcategory:</label>
                    <input type="text" id="subcategory" name="subcategory" value="<?php echo $row['subcategory'];?>" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300">
                </div>
                <div class="flex flex-col w-full mb-4">
                    <label for="skills" class="block text-gray-700 text-sm font-bold mb-2">Skills:</label>
                    <input type="text" id="skills" name="skills" value="<?php echo $row['skills'];?>" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300">
                </div>
                <div class="flex flex-col w-full mb-4">
                    <label for="experience" class="block text-gray-700 text-sm font-bold mb-2">Experience:</label>
                    <input type="text" id="experience" name="experience" value="<?php echo $row['experience'];?>" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300">
                </div>
                <div class="flex flex-col w-full mb-4">
                    <label for="delivery_time" class="block text-gray-700 text-sm font-bold mb-2">Delivery Time:</label>
                    <input type="text" id="delivery_time" name="delivery_time" value="<?php echo $row['delivery_time'];?>" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300">
                </div>
                <div class="flex flex-col w-full mb-4">
                    <label for="gig_type" class="block text-gray-700 text-sm font-bold mb-2">Gig Type:</label>
                    <input type="text" id="gig_type" name="gig_type" value="<?php echo $row['gig_type'];?>" class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300">
                </div>
                <div class="flex flex-col w-full mb-4">
                    <button type="submit" class="bg-green-400 hover:bg-green-500 rounded-lg py-2 px-4 text-white">Modify Gig</button>
                </div>
            </form>
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
