<?php
include '../includes/db_connection.php';

if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Invalid email format.';
        $_SESSION['toastType'] = 'error';
    } else {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['password'])) {
                    $_SESSION['message'] = 'Login successful! Welcome!';
                    $_SESSION['toastType'] = 'success';
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['address'] = $row['address'];
                    $_SESSION['user_id'] = $row['id'];
                    header('Location: ../index.php');
                    exit;
                } else {
                    $_SESSION['message'] = 'Incorrect password.';
                    $_SESSION['toastType'] = 'error';
                }
            } else {
                $_SESSION['message'] = 'No user found with that email.';
                $_SESSION['toastType'] = 'error';
            }
        } else {
            $_SESSION['message'] = 'Database query error.';
            $_SESSION['toastType'] = 'error';
        }
    }

    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-cover bg-center p-4" style="background-image: url('../assets/login_bg.jpg'); font-family: 'Poppins', sans-serif;">

    <div class="bg-gray-200 p-10 rounded-lg shadow-lg w-full max-w-md border border-gray-200">
        <h2 class="text-4xl font-semibold mb-6 text-center text-gray-700">Welcome Back</h2>

        <form method="POST" action="">
            <div class="mb-4">
                <label for="email" class="block text-gray-600 font-semibold mb-1">Email</label>
                <input type="email" name="email" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:scale-105 focus:shadow-lg transition transform ease-in-out duration-200" />
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-600 font-semibold mb-1">Password</label>
                <input type="password" name="password" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:scale-105 focus:shadow-lg transition transform ease-in-out duration-200" />
            </div>

            <button type="submit" 
                    class="w-full py-3 text-white text-lg font-semibold bg-gradient-to-r from-indigo-500 to-blue-500 rounded-md hover:scale-105 hover:shadow-lg transition transform ease-in-out duration-200">
                Login
            </button>
        </form>

        <p class="text-center text-gray-500 mt-4">
            Don't have an account? <a href="register.php" class="text-indigo-600 hover:underline font-semibold">Register</a>
        </p>
    </div>

    <script type="text/javascript">
        <?php if (isset($_SESSION['message']) && isset($_SESSION['toastType'])): ?>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
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
