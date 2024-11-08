<?php
include 'includes/db_connection.php';
include("views/header.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php
// Fetch all categories from the database
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
?>

<!-- Main Content -->
<div class="container mx-auto py-16">
    <h2 class="text-4xl font-bold text-center mb-12">Our Categories</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="bg-gray-100 shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <div class="w-full h-64 overflow-hidden">
                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" class="w-full h-full object-contain">
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-semibold mb-4"><?php echo $row['name']; ?></h3>
                    <p class="text-gray-600 mb-6"><?php echo $row['description']; ?></p>
                    <a href="views/products/<?php echo strtolower($row['name']); ?>.php" class="bg-green-700 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-800 transition duration-300">
                        View <?php echo $row['name']; ?>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include("views/footer.html"); ?>