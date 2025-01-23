<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Please log in first.");
    exit();
}

// Get the customer_id from the URL
if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
} else {
    // Redirect if no customer_id is provided
    header("Location: dashboard.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'pickup');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the images for the specific customer_id
$sql = "SELECT images FROM pickupdetails WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $customer_id);
$stmt->execute();
$stmt->store_result();

// Check if images exist for the given customer_id
if ($stmt->num_rows > 0) {
    $stmt->bind_result($images);
    $stmt->fetch();
    $imagePaths = explode(',', $images);
} else {
    $imagePaths = [];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Images</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2e7d32;
        }

        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .image-gallery img {
            max-width: 300px;
            max-height: 300px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .image-gallery img:hover {
            transform: scale(1.1);
        }

        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #2e7d32;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Uploaded Images</h1>

    <?php if (!empty($imagePaths)): ?>
        <div class="image-gallery">
            <?php foreach ($imagePaths as $image): ?>
                <img src="uploads/<?php echo htmlspecialchars($image); ?>" alt="Uploaded Image">
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No images found for this booking.</p>
    <?php endif; ?>

    <a href="dashboard.php" class="back-button">Back to Dashboard</a>
</div>

</body>
</html>
