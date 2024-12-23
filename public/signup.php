<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Include Composer's autoloader
include '../src/database/db.php';

function send_verification_email(string $email, string $verification_token): void
{
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration for Hotmail
        $mail->isSMTP();
        $mail->Host = 'smtp.mailersend.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'MS_EnSWH4@trial-z86org80y3k4ew13.mlsender.net';
        $mail->Password = 'X5faGtEMzAVjuK7O';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email details
        $mail->setFrom('MS_EnSWH4@trial-z86org80y3k4ew13.mlsender.net', 'WorkFlow');
        $mail->addAddress($email);

        // Email subject & body
        $verification_link = "http://localhost:8000/public/verify-email.php?token=$verification_token";
        $mail->isHTML(true);
        $mail->Subject = 'Please Verify Your Email';
        $mail->Body = "
    <html>
        <head>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #f7f7f7;
                    margin: 0;
                    padding: 0;
                }
                .email-container {
                    width: 100%;
                    max-width: 650px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #333333;
                    font-size: 28px;
                    text-align: center;
                    margin-bottom: 20px;
                    font-weight: bold;
                }
                p {
                    font-size: 16px;
                    color: #555555;
                    text-align: center;
                    line-height: 1.6;
                    margin: 15px 0;
                }
                .btn {
                    display: inline-block;
                    background-color: #4CAF50;
                    color: #ffffff;
                    padding: 12px 25px;
                    font-size: 16px;
                    font-weight: bold;
                    text-decoration: none;
                    border-radius: 5px;
                    text-align: center;
                    margin-top: 20px;
                    transition: background-color 0.3s ease;
                }
                .btn:hover {
                    background-color: #45a049;
                }
                .email-header {
                    text-align: center;
                    margin-bottom: 30px;
                }
                .email-header img {
                    max-width: 200px;
                }
                .footer {
                    font-size: 12px;
                    color: #888888;
                    text-align: center;
                    margin-top: 30px;
                }
                .footer a {
                    color: #4CAF50;
                    text-decoration: none;
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-header'>
                    <img src='https://cdn.prod.website-files.com/66391f096f4e5570969addbf/6682c1d898874f4bedf5fa1f_Freelancer-start-1024x512.png' alt='Workflow Logo'>
                </div>
                <h2>Welcome to Workflow - Email Verification</h2>
                <p>Thank you for joining Workflow! We're excited to have you on board. To get started and unlock all the features of our platform, please verify your email address by clicking the link below:</p>
                <a href='$verification_link' class='btn'>Verify Your Email</a>
                <p>If you did not sign up for Workflow, please ignore this email. You will not be charged.</p>
                <div class='footer'>
                    <p>Need help? Visit our <a href='https://yourwebsite.com/support'>Support Center</a>.</p>
                    <p>&copy; " . date('Y') . " Workflow. All rights reserved.</p>
                </div>
            </div>
        </body>
    </html>
";


        $mail->SMTPDebug = 2;

        $mail->send();
        echo "<script>alert('Verification email sent. Please check your inbox.');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Email could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    // Check if the email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Error: This email is already registered.'); window.location.href = 'signup.php';</script>";
    } else {
        $verification_token = bin2hex(random_bytes(16));

        $stmt = $conn->prepare("INSERT INTO users (email, username, password, role, verification_token, status) VALUES (?,?,?,?,?, 'pending')");
        $stmt->bind_param("sssss", $email, $username, $password, $role, $verification_token);

        if ($stmt->execute()) {
            send_verification_email($email, $verification_token);
            echo "<script>alert('Sign up successful! Please verify your email to activate your account.'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Error: Could not sign up. Please try again.');</script>";
        }
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