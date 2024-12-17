<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'client') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client dashBoard</title>
    <link rel="stylesheet" href="../src/output.css">
</head>

<body>
    <div class="h-screen w-full flex overflow-hidden select-none">
        <nav class="w-24 flex flex-col items-center bg-black py-4">
            <!-- Left side NavBar -->

            <div>
                <!-- App Logo -->

                <svg class="h-8 w-8 fill-current text-blue-600 dark:text-blue-300" viewBox="0 0 24 24">
                    <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3m6.82
                    6L12 12.72 5.18 9 12 5.28 18.82 9M17 16l-5 2.72L7 16v-3.73L12
                    15l5-2.73V16z"></path>
                </svg>

            </div>

            <ul class="mt-2 text-gray-400 capitalize">
                <!-- Links -->

                <li class="mt-3 p-2 text-blue-600 dark:text-blue-300 rounded-lg">
                    <a href="#" class=" flex flex-col items-center">
                        <svg class="fill-current h-5 w-5" viewBox="0 0 24 24">
                            <path d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9
                            17v2H5v-2h4M21 3h-8v6h8V3M11 3H3v10h8V3m10
                            8h-8v10h8V11m-10 4H3v6h8v-6z"></path>
                        </svg>
                        <span class="text-xs mt-2">dashBoard</span>
                    </a>

                </li>

            </ul>

            <div class="mt-auto flex items-center p-2 text-blue-700 bg-purple-200
            dark:text-blue-500 rounded-full">
                <!-- important action -->

                <a href="./logout.php">
                    <svg width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                        class="icon">
                        <path
                            d="M868 732h-70.3c-4.8 0-9.3 2.1-12.3 5.8-7 8.5-14.5 16.7-22.4 24.5a353.84 353.84 0 0 1-112.7 75.9A352.8 352.8 0 0 1 512.4 866c-47.9 0-94.3-9.4-137.9-27.8a353.84 353.84 0 0 1-112.7-75.9 353.28 353.28 0 0 1-76-112.5C167.3 606.2 158 559.9 158 512s9.4-94.2 27.8-137.8c17.8-42.1 43.4-80 76-112.5s70.5-58.1 112.7-75.9c43.6-18.4 90-27.8 137.9-27.8 47.9 0 94.3 9.3 137.9 27.8 42.2 17.8 80.1 43.4 112.7 75.9 7.9 7.9 15.3 16.1 22.4 24.5 3 3.7 7.6 5.8 12.3 5.8H868c6.3 0 10.2-7 6.7-12.3C798 160.5 663.8 81.6 511.3 82 271.7 82.6 79.6 277.1 82 516.4 84.4 751.9 276.2 942 512.4 942c152.1 0 285.7-78.8 362.3-197.7 3.4-5.3-.4-12.3-6.7-12.3zm88.9-226.3L815 393.7c-5.3-4.2-13-.4-13 6.3v76H488c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h314v76c0 6.7 7.8 10.5 13 6.3l141.9-112a8 8 0 0 0 0-12.6z" />
                    </svg>
                </a>

            </div>

        </nav>

        <main
            class="my-4 pt-6 pb-6 px-10 flex-1 bg-gray-100 rounded-l-lg transition duration-500 ease-in-out overflow-y-auto">
            <h1 class="text-4xl font-bold mb-8 text-gray-800">Available Gigs</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                include '../src/database/db.php';

                $sql = "SELECT * FROM gigs";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $freelancer_id = $row['freelancer_id'];
                        $freelancer_sql = "SELECT username FROM users WHERE id = '$freelancer_id'";
                        $freelancer_result = mysqli_query($conn, $freelancer_sql);
                        $freelancer_row = mysqli_fetch_assoc($freelancer_result);
                        $freelancer_username = $freelancer_row['username'];
                        ?>
                        <div
                            class="bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105">
                            <!-- Card Header -->
                            <div class="bg-blue-600 text-white py-4 px-6">
                                <h3 class="text-lg font-semibold"><?php echo htmlspecialchars($row['title']); ?></h3>
                            </div>
                            <!-- Card Body -->
                            <div class="p-6">
                                <p class="text-gray-700 text-sm mb-2"><span class="font-semibold">Description:</span>
                                <?php echo htmlspecialchars($row['description']); ?></p>
                                <p class="text-gray-700 text-sm mb-2"><span class="font-semibold">Category:</span>
                                    <?php echo htmlspecialchars($row['category']); ?></p>
                                <p class="text-gray-700 text-sm mb-2"><span class="font-semibold">Subcategory:</span>
                                    <?php echo htmlspecialchars($row['subcategory']); ?></p>
                                <p class="text-gray-700 text-sm mb-2"><span class="font-semibold">Skills:</span>
                                    <?php echo htmlspecialchars($row['skills']); ?></p>
                                <p class="text-gray-700 text-sm mb-2"><span class="font-semibold">Experience:</span>
                                    <?php echo htmlspecialchars($row['experience']); ?></p>
                                <p class="text-gray-700 text-sm mb-2"><span class="font-semibold">Delivery Time:</span>
                                    <?php echo htmlspecialchars($row['delivery_time']); ?></p>
                                <p class="text-gray-700 text-sm mb-2"><span class="font-semibold">Gig Type:</span>
                                    <?php echo htmlspecialchars($row['gig_type']); ?></p>
                            </div>
                            <!-- Card Footer -->
                            <div class="px-6 py-4 bg-gray-50 text-right flex flex-row justify-between">
                                <p>$<?php echo number_format($row['price'], 2); ?></p>
                                <a href="#"
                                    class="text-blue-600 hover:underline font-semibold">@<?php echo htmlspecialchars($freelancer_username); ?></a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='col-span-3 text-center text-gray-600'>No gigs available</p>";
                }
                mysqli_close($conn);
                ?>
            </div>
        </main>

    </div>
</body>

</html>