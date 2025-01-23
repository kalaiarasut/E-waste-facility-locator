<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Please log in first.");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'pickup');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all pickup details along with images
$sql = "SELECT customer_id, email, device, model, location, date, images FROM pickupdetails";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Images</title>
</head>
<body>
    <h1>Uploaded Images</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Email</th>
                <th>Device</th>
                <th>Model</th>
                <th>Location</th>
                <th>Date</th>
                <th>Images</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['device']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['model']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                    echo "<td>";

                    // Display images
                    if (!empty($row['images'])) {
                        $imagePaths = explode(',', $row['images']);
                        foreach ($imagePaths as $image) {
                            $imagePath = 'uploads/' . htmlspecialchars($image);
                            echo "<img src='$imagePath' alt='Uploaded Image' style='width:100px; height:auto; margin:5px;'>";
                        }
                    } else {
                        echo "No images uploaded.";
                    }

                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No pickup requests found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
