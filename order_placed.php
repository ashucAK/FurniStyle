<?php
include("includes/db_connection.php");

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$total = 0;
$status = 'pending';
$created_at = date('Y-m-d H:i:s');

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $query = "INSERT INTO orders (user_id, total, status, created_at) VALUES ('$user_id', '$total', '$status', '$created_at')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = 'Order placed successfully!';
        $_SESSION['toastType'] = 'success';
        unset($_SESSION['cart']); // Clear the cart after placing the order
    } else {
        $_SESSION['message'] = 'Failed to place order. Please try again.';
        $_SESSION['toastType'] = 'error';
    }
} else {
    $_SESSION['message'] = 'Your cart is empty.';
    $_SESSION['toastType'] = 'error';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-cover bg-center p-4" style="background-image: url('../assets/login_bg.jpg'); font-family: 'Poppins', sans-serif;">

    <div class="bg-gray-200 p-10 rounded-lg shadow-lg w-full max-w-md border border-gray-200 text-center">
        <h2 class="text-4xl font-semibold mb-6 text-gray-700">Order Placed</h2>
        <p class="text-lg text-gray-600 mb-4">Thank you for your order!</p>
        <a href="index.php" class="bg-green-700 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-800 transition duration-300">Continue Shopping</a>
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