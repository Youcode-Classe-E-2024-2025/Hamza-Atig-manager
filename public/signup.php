<?php
include '../src/database/db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password
    $role = $_POST['role'];

    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users (email, username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $username, $password, $role);

    if ($stmt->execute()) {
        echo "<script>alert('Sign up successful!'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Error: Could not sign up. Please try again.');</script>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../src/output.css">
</head>

<body>
    <div class="font-[sans-serif]">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <div
                class="grid md:grid-cols-2 items-center gap-4 max-md:gap-8 max-w-6xl max-md:max-w-lg w-full p-4 m-4 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md">
                <div class="md:max-w-md w-full px-4 py-4">
                    <form method="POST" action="signup.php">
                        <div class="mb-12">
                            <h3 class="text-gray-800 text-3xl font-extrabold">Sign Up</h3>
                            <p class="text-sm mt-4 text-gray-800">If you have an account <a href="login.php"
                                    class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Login
                                    here</a></p>
                        </div>

                        <div>
                            <label class="text-gray-800 text-xs block mb-2">Email</label>
                            <input name="email" type="email" required
                                class="w-full text-gray-800 text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none"
                                placeholder="Enter email" />
                        </div>

                        <div class="mt-8">
                            <label class="text-gray-800 text-xs block mb-2">Username</label>
                            <input name="username" type="text" required
                                class="w-full text-gray-800 text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none"
                                placeholder="Enter username" />
                        </div>

                        <div class="mt-8">
                            <label class="text-gray-800 text-xs block mb-2">Password</label>
                            <input name="password" type="password" required
                                class="w-full text-gray-800 text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none"
                                placeholder="Enter password" />
                        </div>

                        <div class="mt-8">
                            <label class="text-gray-800 text-xs block mb-2">Role</label>
                            <select name="role" required
                                class="w-full text-gray-800 text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none">
                                <option value="" disabled selected>Select your role</option>
                                <option value="freelancer">Freelancer</option>
                                <option value="client">Client</option>
                            </select>
                        </div>

                        <div class="mt-12">
                            <button type="submit"
                                class="w-full shadow-xl py-2.5 px-4 text-sm tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                                Sign Up
                            </button>
                        </div>
                    </form>
                </div>

                <div class="md:h-full bg-[#000842] rounded-xl lg:p-12 p-8">
                    <img src="https://readymadeui.com/signin-image.webp" class="w-full h-full object-contain"
                        alt="signup-image" />
                </div>
            </div>
        </div>
    </div>
</body>

</html>
