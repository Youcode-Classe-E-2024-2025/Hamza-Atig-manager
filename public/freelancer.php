<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'freelancer') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer dashBoard</title>
    <link rel="stylesheet" href="../src/output.css">
</head>

<body>
    <div class="h-screen w-full flex overflow-hidden select-none">
        <nav class="w-24 flex flex-col items-center bg-white py-4">
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
            class="my-1 pt-2 pb-2 px-10 flex-1 bg-gray-200 rounded-l-lg transition duration-500 ease-in-out overflow-y-auto">
            <?php
            include '../src/database/db.php';
            $user_id = $_SESSION['user_id'] ?? null;

            if ($user_id) {
                $stmt = $conn->prepare("SELECT verified FROM users WHERE id = ?");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                $stmt->close();

                if ($user && $user['verified'] == 0) {
                    ?>
                    <div class="bg-red-500 text-white p-4 rounded-lg">
                        <p class="font-semibold">Verify your account before 24 hours or you will get a ban!</p>
                        <p>Check your email for a verification link.</p>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-red-500'>User not logged in or session expired.</p>";
            }
            $conn->close();
            ?>

            <div class="flex flex-col capitalize text-3xl">
                <span class="font-semibold">hello,</span>
                <span>tempest!</span>
            </div>
            <div class="flex">
                <div class="mr-6 w-1/2 mt-8 py-2 flex-shrink-0 flex flex-col bg-white rounded-lg">
                    <!-- Card list container -->
                    <h3 class="flex items-center pt-1 pb-1 px-8 text-lg font-semibold capitalize dark:text-gray-300">
                        <!-- Header -->
                        <span class="text-gray-900">Your Gigs</span>
                        <button class="ml-2">
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 256 512">
                                <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9
                                        0l-22.6-22.6c-9.4-9.4-9.4-24.6
                                        0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6
                                        0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136
                                        136c9.5 9.4 9.5 24.6.1 34z">
                                </path>
                            </svg>
                        </button>
                    </h3>
                    <div>
                        <!-- List -->
                        <ul class="pt-1 pb-2 px-3 overflow-y-auto">
                            <?php
                            include '../src/database/db.php';

                            $user_id = $_SESSION['user_id'];
                            $sql = "SELECT * FROM gigs WHERE freelancer_id = '$user_id'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <li class="mt-2">
                                        <a class="p-5 flex flex-col justify-between bg-white rounded-lg shadow hover:shadow-lg transition duration-500 ease-in-out"
                                            href="gig.php?gig_id=<?php echo $row['id']; ?>">
                                            <div
                                                class="flex items-center justify-between font-semibold capitalize text-gray-800">
                                                <span><?php echo $row['title']; ?></span>
                                                <span class="text-sm">
                                                    <?php echo number_format($row['price'], 2); ?>
                                                </span>
                                            </div>
                                            <p class="text-sm font-medium leading-snug text-gray-600 my-3">
                                                <?php echo substr($row['description'], 0, 200) . '...'; ?>
                                            </p>
                                        </a>
                                    </li>
                                    <?php
                                }
                            } else {
                                ?>
                                <li class="mt-2">
                                    <p class="text-sm font-medium leading-snug text-gray-600 my-3">
                                        You haven't created any gigs yet.
                                    </p>
                                </li>
                                <?php
                            }

                            mysqli_close($conn);
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="mr-6 w-1/2 mt-8 py-2 flex-shrink-0 flex flex-col
        bg-purple-300 rounded-lg text-white">
                    <h3 class="flex items-center pt-1 pb-1 px-8 text-lg font-bold
            capitalize">
                        <span>scheduled lessons</span>
                        <button class="ml-2">
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 256 512">
                                <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9
                        0l-22.6-22.6c-9.4-9.4-9.4-24.6
                        0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6
                        0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136
                        136c9.5 9.4 9.5 24.6.1 34z"></path>
                            </svg>
                        </button>
                    </h3>
                    <div class="flex flex-col items-center mt-12">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-state-2130362-1800926.png"
                            alt=" empty schedule" />
                        <span class="font-bold mt-8">You have no gigs yet</span>
                        <span class="text-purple-500">
                            Create your first gig
                        </span>
                        <button id="openAgigs" class="mt-8 bg-purple-800 rounded-lg py-2 px-4">
                            Create a Gig
                        </button>
                    </div>
                </div>
            </div>
        </main>


        <aside class="w-1/4 my-1 mr-1 px-6 py-4 flex flex-col bg-white
        dark:text-gray-400 rounded-r-lg overflow-y-auto">

            <span class="mt-4 text-gray-600">Monthly earnings</span>
            <span class="mt-1 text-3xl font-semibold text-gray-800">$ 40</span>

            <button class="mt-8 flex items-center py-4 px-3 text-white rounded-lg
            bg-green-400 shadow focus:outline-none">
                <!-- Action -->

                <svg class="h-5 w-5 fill-current mr-2 ml-3" viewBox="0 0 24 24">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                </svg>

                <span>withdraw</span>

            </button>

            <div class="mt-12 flex items-center">
                <!-- Payments -->
                <span>Payments</span>
                <button class="ml-2 focus:outline-none">
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 256 512">
                        <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9
                        0l-22.6-22.6c-9.4-9.4-9.4-24.6
                        0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3
                        103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1
                        34z"></path>
                    </svg>
                </button>
            </div>

            <a href="#" class="mt-2 p-4 flex justify-between bg-gray-300 rounded-lg
            font-semibold capitalize">
                <!-- link -->

                <div class="flex">
                    <div class="flex flex-col ml-4">

                        <span class="text-gray-800">Hassan</span>
                        <span class="text-sm text-gray-600">Your Client</span>

                    </div>

                </div>

                <span>$ 25</span>

            </a>

            <a href="#" class="mt-2 p-4 flex justify-between bg-gray-300 rounded-lg
            font-semibold capitalize">
                <!-- link -->

                <div class="flex">
                    <div class="flex flex-col ml-4">

                        <span class="text-gray-800">ALI155</span>
                        <span class="text-sm text-gray-600">Your Client</span>

                    </div>

                </div>

                <span>$ 15</span>

            </a>

        </aside>

    </div>

    <!-- Add this form to the div where you want to display the "Create a Gig" form -->
    <div id="agigs"
        class="hidden absolute left-[30%] bg-white p-7 rounded-xl broder border-rose-600 top-0 flex flex-col items-center mt-12 h-[600px] w-[500px] overflow-y-auto">
        <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-state-2130362-1800926.png"
            alt=" empty schedule" />

        <span class="font-bold mt-8">Create your first gig</span>

        <form action="gig-create.php" method="post" class="w-full mt-8 flex flex-col items-center">
            <!-- Gig Title -->
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2 w-full">Gig Title:</label>
            <input type="text" id="title" name="title" required
                class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300 mb-4">

            <!-- Gig Description -->
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2 w-full">Gig Description:</label>
            <textarea id="description" name="description" required rows="5"
                class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300 mb-4"></textarea>

            <!-- Gig Price -->
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2 w-full">Gig Price:</label>
            <input type="number" step="0.01" id="price" name="price" required
                class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300 mb-4">

            <!-- Gig Category -->
            <label for="category" class="block text-gray-700 text-sm font-bold mb-2 w-full">Gig Category:</label>
            <select id="category" name="category" required
                class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300 mb-4">
                <option value="">Select a category</option>
                <option value="web-development">Web Development</option>
                <option value="graphic-design">Graphic Design</option>
                <!-- Add more options here -->
            </select>

            <!-- Gig Subcategory -->
            <label for="subcategory" class="block text-gray-700 text-sm font-bold mb-2 w-full">Gig Subcategory:</label>
            <input type="text" id="subcategory" name="subcategory"
                class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300 mb-4">

            <!-- Gig Skills -->
            <label for="skills" class="block text-gray-700 text-sm font-bold mb-2 w-full">Gig Skills:</label>
            <input type="text" id="skills" name="skills"
                class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300 mb-4">

            <!-- Gig Experience -->
            <label for="experience" class="block text-gray-700 text-sm font-bold mb-2 w-full">Gig Experience:</label>
            <input type="text" id="experience" name="experience"
                class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300 mb-4">

            <!-- Gig Delivery Time -->
            <label for="delivery_time" class="block text-gray-700 text-sm font-bold mb-2 w-full">Gig Delivery
                Time:</label>
            <input type="text" id="delivery_time" name="delivery_time"
                class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300 mb-4">

            <!-- Gig Type -->
            <label for="gig_type" class="block text-gray-700 text-sm font-bold mb-2 w-full">Gig Type:</label>
            <select id="gig_type" name="gig_type" required
                class="block w-full appearance-none rounded-md py-2 pl-10 text-sm text-gray-700 border border-gray-300 mb-4">
                <option value="">Select a type</option>
                <option value="digital">Digital</option>
                <option value="physical">Physical</option>
                <!-- Add more options here -->
            </select>

            <div class="flex flex-row gap-4 mt-8">
                <button type="submit" class="bg-purple-800 rounded-lg py-2 px-4 text-white">Create Gig</button>
                <button id="closeAgigs" class="bg-red-600 rounded-lg py-2 px-4 text-white">Close</button>
            </div>
        </form>
    </div>
    <script>
        const openAgigs = document.getElementById('openAgigs');
        const closeAgigs = document.getElementById('closeAgigs');

        openAgigs.addEventListener('click', () => {
            const agigs = document.getElementById('agigs');
            agigs.classList.remove('hidden');
        });
        closeAgigs.addEventListener('click', () => {
            const agigs = document.getElementById('agigs');
            agigs.classList.add('hidden');
        });
    </script>


</body>

</html>