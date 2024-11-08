<!-- update_profile_section.php -->
<div id="updateProfileContent" class="tab-content hidden">
    <div class="bg-white p-12 rounded-lg shadow-lg max-w-4xl mx-auto">
        <div class="text-center">
            <h3 class="text-2xl font-semibold mb-6 text-green-700">Update Information</h3>
            <form action="profile.php" method="POST" class="space-y-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <label for="name" class="block text-lg font-medium text-gray-700 md:w-1/3">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" class="mt-2 md:mt-0 p-3 border border-gray-300 rounded-lg w-full md:w-2/3 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
                </div>
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <label for="email" class="block text-lg font-medium text-gray-700 md:w-1/3">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" class="mt-2 md:mt-0 p-3 border border-gray-300 rounded-lg w-full md:w-2/3 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
                </div>
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <label for="address" class="block text-lg font-medium text-gray-700 md:w-1/3">Address</label>
                    <input type="text" id="address" name="address" value="<?php echo $_SESSION['address']; ?>" class="mt-2 md:mt-0 p-3 border border-gray-300 rounded-lg w-full md:w-2/3 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
                </div>
                <div>
                    <button type="submit" name="update_profile" class="bg-green-700 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-800 transform hover:scale-105 transition duration-300">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>