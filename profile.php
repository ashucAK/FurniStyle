<?php
include("views/header.php");
include("includes/db_connection.php");

if (!isset($_SESSION['email']) || !isset($_SESSION['name'])) {
    echo '<div class="container mx-auto py-16 text-center text-red-500">No user is logged in.</div>';
    include("views/footer.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Invalid email format.';
        $_SESSION['toastType'] = 'error';
    } else {
        $query = "UPDATE users SET name = '$name', email = '$email', address = '$address' WHERE email = '{$_SESSION['email']}'";
        if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = 'Profile updated successfully!';
            $_SESSION['toastType'] = 'success';
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['address'] = $address;
        } else {
            $_SESSION['message'] = 'Failed to update profile.';
            $_SESSION['toastType'] = 'error';
        }
    }
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mx-auto py-24 h-screen font-poppins">
    <h2 class="text-4xl font-bold text-center mb-8">My Account</h2>
    <!-- Tab Buttons -->
    <div class="flex justify-center mb-8">
        <button id="profileTab" class="tab-button active mr-4">
            Profile
        </button>
        <button id="orderHistoryTab" class="tab-button mr-4">
            Order History
        </button>
        <button id="updateProfileTab" class="tab-button mr-4">
            Update Profile
        </button>
        <form action="/auth/logout.php" method="POST">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-full font-semibold transition duration-300 hover:bg-red-700 transform hover:scale-105 active:bg-red-700">
                Logout
            </button>
        </form>
    </div>
    <!-- Tab Contents -->
    <?php include("views/profile/profile_section.php"); ?>
    <?php include("views/profile/order_history.php"); ?>
    <?php include("views/profile/update_section.php"); ?>
</div>

<?php include("views/footer.html"); ?>

<style>
    .tab-button {
        background-color: #4CAF90;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 9999px;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .tab-button:hover {
        background-color: #388F6C;
        transform: scale(1.05);
    }
    .tab-button.active {
        background-color: #388F6C;
    }
    .tab-content {
        transition: opacity 0.5s ease;
    }
    .tab-content.hidden {
        opacity: 0;
        display: none;
    }
</style>

<script>
    const profileTab = document.getElementById('profileTab');
    const orderHistoryTab = document.getElementById('orderHistoryTab');
    const updateProfileTab = document.getElementById('updateProfileTab');
    const profileContent = document.getElementById('profileContent');
    const orderHistoryContent = document.getElementById('orderHistoryContent');
    const updateProfileContent = document.getElementById('updateProfileContent');

    profileTab.addEventListener('click', () => {
        profileTab.classList.add('active');
        orderHistoryTab.classList.remove('active');
        updateProfileTab.classList.remove('active');
        profileContent.classList.remove('hidden');
        orderHistoryContent.classList.add('hidden');
        updateProfileContent.classList.add('hidden');
    });

    orderHistoryTab.addEventListener('click', () => {
        orderHistoryTab.classList.add('active');
        profileTab.classList.remove('active');
        updateProfileTab.classList.remove('active');
        orderHistoryContent.classList.remove('hidden');
        profileContent.classList.add('hidden');
        updateProfileContent.classList.add('hidden');
    });

    updateProfileTab.addEventListener('click', () => {
        updateProfileTab.classList.add('active');
        profileTab.classList.remove('active');
        orderHistoryTab.classList.remove('active');
        updateProfileContent.classList.remove('hidden');
        profileContent.classList.add('hidden');
        orderHistoryContent.classList.add('hidden');
    });
</script>