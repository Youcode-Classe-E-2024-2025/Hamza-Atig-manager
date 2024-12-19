<?php
session_start();

include '../src/database/db.php';

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for user with the given email
    $stmt = $conn->prepare("SELECT id, username, password, role, status FROM users WHERE email =?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, check status
            if ($user['status'] === 'pending') {
                $error = "Your account is pending approval.";
            } elseif ($user['status'] === 'refused') {
                $error = "Your account has been refused.";
            } elseif ($user['status'] === 'banned') {
                $error = "Your account has been banned.";
            } else {
                // Status is active, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'client') {
                    header("Location: client.php");
                    exit();
                } else {
                    header("Location: freelancer.php");
                    exit();
                }
            }
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
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
    <title>Login Page</title>
    <link rel="stylesheet" href="../src/output.css">
</head>

<body>
    <div class="font-[sans-serif]">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <div
                class="grid md:grid-cols-2 items-center gap-4 max-md:gap-8 max-w-6xl max-md:max-w-lg w-full p-4 m-4 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md">
                <div class="md:max-w-md w-full px-4 py-4">
                    <form method="POST" action="login.php">
                        <div class="mb-12">
                            <h3 class="text-gray-800 text-3xl font-extrabold">Login</h3>
                            <p class="text-sm mt-4 text-gray-800">Don't have an account? <a href="signup.php"
                                    class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Register
                                    here</a></p>
                        </div>

                        <?php if (!empty($error)):?>
                            <div class="text-red-600 text-sm mb-4">
                                <?php echo $error;?>
                            </div>
                        <?php endif;?>

                        <div>
                            <label class="text-gray-800 text-xs block mb-2">Email</label>
                            <input name="email" type="email" required
                                class="w-full text-gray-800 text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none"
                                placeholder="Enter email" />
                        </div>

                        <div class="mt-8">
                            <label class="text-gray-800 text-xs block mb-2">Password</label>
                            <input name="password" type="password" required
                                class="w-full text-gray-800 text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none"
                                placeholder="Enter password" />
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-4 mt-6">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox"
                                    class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                                <label for="remember-me" class="ml-3 block text-sm text-gray-800">
                                    Remember me
                                </label>
                            </div>
                            <div>
                                <a href="./recoverpassword.php"
                                    class="text-blue-600 font-semibold text-sm hover:underline">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>

                        <div class="mt-12">
                            <button type="submit"
                                class="w-full shadow-xl py-2.5 px-4 text-sm tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                                Sign in
                            </button>
                        </div>
                        <a href="./admin.php" class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap" >admin?</a>
                    </form>
                </div>

                <div class="md:h-full bg-[#000842] rounded-xl lg:p-12 p-8">
                    <img src="https://readymadeui.com/signin-image.webp" class="w-full h-full object-contain"
                        alt="login-image" />
                </div>
            </div>
        </div>
    </div>
</body>

</html>
