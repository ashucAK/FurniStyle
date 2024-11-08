<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
    <style>
        /* Custom background and header styling */
        .header-bg {
            background-color: #4CAF90; /* Fresh, vibrant green */
        }
        /* Custom font styling */
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">

    <header class="header-bg p-6 shadow-lg rounded-b-lg fixed top-0 w-full z-50 transition duration-300 ease-in-out hover:shadow-2xl">
        <div class="container mx-auto flex justify-between items-center relative">
            <!-- Logo Section with hover effect -->
            <div class="mr-4">
                <h1 class="text-white text-4xl font-bold tracking-widest transform hover:scale-110 transition duration-300 ease-in-out cursor-pointer">
                    FurniStyle
                </h1>
            </div>

            <!-- Navigation Links and Hamburger Icon -->
            <nav class="flex items-center md:hidden">
                <!-- Hamburger Icon with hover effect -->
                <div class="flex items-center cursor-pointer" id="hamburger-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white hover:text-green-200 transition duration-300 ease-in-out" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </div>

                <!-- Mobile Navigation Links (hidden by default) -->
                <div class="hidden flex-col items-center space-y-2 absolute top-16 right-0 bg-white py-4 w-40 rounded-lg shadow-lg" id="mobile-nav">
                    <a href="index.php" class="block text-center text-black font-semibold hover:text-green-500 rounded-full py-2 px-4 transition duration-300 ease-in-out">
                        Home
                    </a>
                    <a href="products.php" class="block text-center text-black font-semibold hover:text-green-500 rounded-full py-2 px-4 transition duration-300 ease-in-out">
                        Products
                    </a>
                    <a href="cart.php" class="block text-center text-black font-semibold hover:text-green-500 rounded-full py-2 px-4 transition duration-300 ease-in-out">
                        Cart
                    </a>
                    <?php if (isset($_SESSION['email']) && isset($_SESSION['name'])): ?>
                        <a href="profile.php" class="block text-center text-black font-semibold hover:text-green-500 rounded-full py-2 px-4 transition duration-300 ease-in-out">
                            Profile
                        </a>
                    <?php else: ?>
                        <a href="../auth/login.php" class="block text-center text-black font-semibold hover:text-blue-300 rounded-full py-2 px-4 transition duration-300 ease-in-out">
                            Login
                        </a>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex space-x-8">
                <ul class="flex space-x-8">
                    <li>
                        <a href="index.php" class="text-white font-semibold text-xl rounded-full py-2 px-4 transition duration-300 ease-in-out transform hover:scale-110 hover:bg-green-600">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="products.php" class="text-white font-semibold text-xl hover:bg-green-700 hover:text-white rounded-full py-2 px-4 transition duration-300 ease-in-out transform hover:scale-110">
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="cart.php" class="text-white font-semibold text-xl hover:bg-green-700 hover:text-white rounded-full py-2 px-4 transition duration-300 ease-in-out transform hover:scale-110">
                            Cart
                        </a>
                    </li>
                    <?php if (isset($_SESSION['email']) && isset($_SESSION['name'])): ?>
                        <li>
                            <a href="profile.php" class="text-white font-semibold text-xl hover:bg-green-700 hover:text-white rounded-full py-2 px-4 transition duration-300 ease-in-out transform hover:scale-110">
                                Profile
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="../auth/login.php" class="text-white font-semibold text-xl hover:bg-blue-500 hover:text-white rounded-full py-2 px-4 transition duration-300 ease-in-out transform hover:scale-110">
                                Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Display toastr notifications if session message is set -->
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
                // Clear the session message after displaying it once
                unset($_SESSION['message']);
                unset($_SESSION['toastType']);
            ?>
        <?php endif; ?>
    </script>

    <script>
        // JavaScript to toggle mobile navigation visibility
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const mobileNav = document.getElementById('mobile-nav');

        hamburgerIcon.addEventListener('click', () => {
            // Toggle 'hidden' class to show/hide the mobile navigation
            mobileNav.classList.toggle('hidden');
        });
    </script>

</body>
</html>
