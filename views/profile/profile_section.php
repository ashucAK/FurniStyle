<!-- profile_section.php -->
<div id="profileContent" class="tab-content">
    <div class="bg-white p-12 rounded-lg shadow-lg max-w-4xl mx-auto">
        <!-- Profile Picture -->
        <div class="flex justify-center mb-8">
            <div class="w-48 h-48">
                <img src="/assets/profile_img.jpg" alt="Profile Picture" class="w-full h-full rounded-full object-cover shadow-md">
            </div>
        </div>
        <!-- Profile Details -->
        <div class="mb-8">
            <h3 class="text-3xl font-semibold mb-6 text-green-700 text-center">Profile Information</h3>
            <div class="flex flex-col md:flex-row items-center justify-between mb-4">
                <p class="text-lg font-medium text-gray-700 md:w-1/3 text-left">Email</p>
                <p class="text-xl md:w-2/3 text-left"><?php echo $_SESSION['email']; ?></p>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-between mb-4">
                <p class="text-lg font-medium text-gray-700 md:w-1/3 text-left">Username</p>
                <p class="text-xl md:w-2/3 text-left"><?php echo $_SESSION['name']; ?></p>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-between mb-4">
                <p class="text-lg font-medium text-gray-700 md:w-1/3 text-left">Address</p>
                <p class="text-xl md:w-2/3 text-left"><?php echo $_SESSION['address']; ?></p>
            </div>
        </div>
    </div>
</div>