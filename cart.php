<?php
include("views/header.php");

// Handle Remove from Cart functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
            break;
        }
    }
}

// Calculate the total bill
$total = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>

<div class="min-h-screen flex flex-col font-poppins">
    <div class="container mx-auto py-24 flex-grow"> <!-- Increased top padding to py-24 -->
        <h2 class="text-4xl font-bold text-center mb-8">Your Cart</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="md:col-span-2 max-h-96 overflow-y-auto">
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <div class="flex items-center mb-6">
                                <div class="w-24 h-24 mr-4">
                                    <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>" class="w-full h-full rounded-lg object-cover shadow-md">
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold mb-2"><?php echo $item['name']; ?></h3>
                                    <p class="text-gray-600 mb-2"><?php echo $item['description']; ?></p>
                                    <p class="text-lg font-bold mb-2">₹<?php echo number_format($item['price'], 2); ?></p>
                                    <p class="text-lg font-bold">Quantity: <?php echo $item['quantity']; ?></p>
                                </div>
                                <form action="cart.php" method="POST" class="ml-4">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" name="remove_from_cart" class="bg-red-600 text-white px-4 py-2 rounded-full font-semibold hover:bg-red-700 transition duration-300">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                        <p class="text-gray-700">Your cart is empty.</p>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Cart Total -->
            <div>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold mb-4">Cart Total</h3>
                    <p class="text-lg font-bold mb-4">Total: ₹<?php echo number_format($total, 2); ?></p>
                    <form action="order_placed.php" method="POST">
                        <button type="submit" class="bg-green-700 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-800 transition duration-300">Order now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include("views/footer.html"); ?>
</div>