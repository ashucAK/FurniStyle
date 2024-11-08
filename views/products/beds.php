<?php
include '../../includes/db_connection.php';

// Fetch all beds from the database
$sql = "SELECT * FROM products WHERE category_id = 4"; // category_id 4 is for beds
$result = mysqli_query($conn, $sql);

// Handle Add to Cart functionality via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax']) && $_POST['ajax'] === 'add_to_cart') {
    $product_id = $_POST['product_id'];
    $query = "SELECT * FROM products WHERE id = $product_id";
    $product_result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($product_result);

    $cart_item = [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'image_url' => $product['image_url'],
        'description' => $product['description'],
        'quantity' => 1
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $cart_item;
    }

    echo json_encode(['message' => 'Item added to cart!', 'toastType' => 'success']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beds - FurniStyle</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-50 font-poppins">

<!-- Go Back and Go to Cart Buttons -->
<div class="container mx-auto py-6 flex justify-between">
    <button onclick="history.back()" class="bg-green-700 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-800 transition duration-300">
        &larr; Go Back
    </button>
    <a href="../../cart.php" class="bg-green-700 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-800 transition duration-300">
        Go to Cart &rarr;
    </a>
</div>

<!-- Main Content -->
<div class="container mx-auto py-4">
    <section class="bg-white py-8 px-6 md:px-12 rounded-lg shadow-lg">
        <h2 class="text-4xl font-bold text-center mb-12">Beds</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="bg-gray-100 border border-gray-200 shadow-md rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="w-full h-56 overflow-hidden">
                        <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2"><?php echo $row['name']; ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo $row['description']; ?></p>
                        <p class="text-lg font-bold mb-4">₹<?php echo number_format($row['price'], 2); ?></p>
                        <div class="flex items-center">
                            <button class="bg-green-700 text-white px-4 py-2 rounded-full font-semibold hover:bg-green-800 transition duration-300 add-to-cart" data-id="<?php echo $row['id']; ?>">
                                Add to Cart
                            </button>
                            <a href="product_details.php?product_id=<?php echo $row['id']; ?>" class="ml-4 text-green-700 font-semibold hover:underline">
                                Show More
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('.add-to-cart').click(function() {
        var productId = $(this).data('id');
        $.ajax({
            url: 'beds.php',
            type: 'POST',
            data: {
                ajax: 'add_to_cart',
                product_id: productId
            },
            success: function(response) {
                var data = JSON.parse(response);
            }
        });
    });
});
</script>

<!-- Footer -->
<?php include("../../views/footer.html"); ?>

</body>
</html>