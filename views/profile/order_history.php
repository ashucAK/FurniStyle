<?php

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<div class="container mx-auto py-16 text-center text-red-500">No user is logged in.</div>';
    exit();
}

$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
?>

<!-- order_history_section.php -->
<div id="orderHistoryContent" class="tab-content hidden">
    <div class="bg-white p-12 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h3 class="text-3xl font-semibold mb-6 text-green-700 text-center">Order History</h3>
        <?php
        $query = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at ASC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="overflow-x-auto">';
            echo '<table class="min-w-full bg-white">';
            echo '<thead>';
            echo '<tr>';
            echo '<th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 font-medium text-gray-700 uppercase tracking-wider">Order ID</th>';
            echo '<th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 font-medium text-gray-700 uppercase tracking-wider">Total (INR)</th>';
            echo '<th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 font-medium text-gray-700 uppercase tracking-wider">Status</th>';
            echo '<th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 font-medium text-gray-700 uppercase tracking-wider">Date</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td class="py-2 px-4 border-b border-gray-200">' . $row['id'] . '</td>';
                echo '<td class="py-2 px-4 border-b border-gray-200">' . number_format($row['total'], 2) . '</td>';
                echo '<td class="py-2 px-4 border-b border-gray-200">' . $row['status'] . '</td>';
                echo '<td class="py-2 px-4 border-b border-gray-200">' . $row['created_at'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<p class="text-gray-700 text-center">You have no orders.</p>';
        }
        ?>
    </div>
</div>