<?php
include '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Invalid email format.';
        $_SESSION['toastType'] = 'error';
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = 'Email already registered.';
            $_SESSION['toastType'] = 'error';
        } else {
            // Insert the new user into the database
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['message'] = 'Registration successful! Please log in.';
                $_SESSION['toastType'] = 'success';
                header('Location: login.php');
                exit();
            } else {
                $_SESSION['message'] = 'Registration failed. Please try again.';
                $_SESSION['toastType'] = 'error';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-cover bg-center p-4" style="background-image: url('../assets/login_bg.jpg'); font-family: 'Poppins', sans-serif;">

    <div class="bg-gray-200 p-10 rounded-lg shadow-lg w-full max-w-md border border-gray-200">
        <h2 class="text-4xl font-semibold mb-6 text-center text-gray-700">Create Your Account</h2>

        <form action="register.php" method="POST">
            <div class="mb-4">
                <label for="name" class="block text-gray-600 font-semibold mb-1">Name</label>
                <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:scale-105 focus:shadow-lg transition transform ease-in-out duration-200" />
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-600 font-semibold mb-1">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:scale-105 focus:shadow-lg transition transform ease-in-out duration-200" />
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-600 font-semibold mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:scale-105 focus:shadow-lg transition transform ease-in-out duration-200" />
            </div>

            <button type="submit" class="w-full py-3 text-white text-lg font-semibold bg-gradient-to-r from-indigo-500 to-blue-500 rounded-md hover:scale-105 hover:shadow-lg transition transform ease-in-out duration-200">Register</button>
        </form>

        <p class="text-center text-gray-500 mt-4">
            Already a member? <a href="login.php" class="text-indigo-600 hover:underline font-semibold">Login</a>
        </p>
    </div>

    <script type="text/javascript">
        <?php if (isset($_SESSION['message']) && isset($_SESSION['toastType'])): ?>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.<?php echo $_SESSION['toastType']; ?>("<?php echo $_SESSION['message']; ?>");
            <?php 
                unset($_SESSION['message']);
                unset($_SESSION['toastType']);
            ?>
        <?php endif; ?>
    </script>

</body>
</html>