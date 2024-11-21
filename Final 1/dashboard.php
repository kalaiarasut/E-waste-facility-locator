<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo "Please log in to view your dashboard.";
    exit;
}

// Retrieve the logged-in user's email from the session
$user_email = $_SESSION['email'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'pickup');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the query to fetch bookings for the logged-in user
$stmt = $conn->prepare("SELECT * FROM pickupdetails WHERE email = ?");
$stmt->bind_param("s", $user_email); // 's' is the type specifier for a string

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there are any bookings
if ($result->num_rows > 0) {
    echo "<h1>Your Bookings</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Device</th><th>Price</th><th>Model</th><th>Time</th><th>Location</th><th>Date</th><th>Phone</th><th>Facility</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['device'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['model'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "<td>" . $row['location'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['facility'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No bookings found.";
}

// Close the connection
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Dashboard</title>
  <style>
  /* Body styling */
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fa;
    padding-top: 80px; /* To account for fixed navbar */
  }

  /* Navbar styling */
  .navbar {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: #f1f8f4;
    padding: 1rem 2rem;
    display: flex;
    justify-content: center; /* Center the content */
    align-items: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }

  .navbar .logo {
    font-size: 1.5rem;
    color: #2e7d32;
    font-weight: bold;
    margin-right: 30px; /* Space between logo and menu */
  }

  /* Menu links */
  .navbar .menu {
    display: flex;
    gap: 2rem;
  }

  .navbar .menu a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    padding: 8px 12px; /* Added some padding for better spacing */
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }

  .navbar .menu a:hover {
    color: #fff;
    background-color: #2e7d32; /* Highlight on hover */
  }

  /* Container for main content */
  .container {
    max-width: 900px;
    margin: 100px auto 20px; /* Centered and space from top */
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  /* Main heading */
  h1 {
    text-align: center;
    color: #2e7d32;
    margin-bottom: 20px; /* Added spacing below the heading */
  }

  /* Table styling */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  table, th, td {
    border: 1px solid #ddd;
  }

  th, td {
    padding: 12px;
    text-align: left;
    font-size: 16px;
  }

  th {
    background-color: #2e7d32;
    color: white;
  }

  td {
    background-color: #f9f9f9;
  }

  /* Status column styling */
  .status {
    font-weight: bold;
  }

  .pending {
    color: orange;
  }

  .completed {
    color: green;
  }

  .cancelled {
    color: red;
  }

  /* Responsive design for smaller screens */
  @media (max-width: 768px) {
    .navbar {
      padding: 1rem; /* Adjust navbar padding for smaller screens */
    }

    .navbar .menu {
      flex-direction: column; /* Stack menu items vertically */
      gap: 1rem;
      align-items: center;
    }

    .container {
      margin: 80px auto 20px; /* Adjust container margin for mobile screens */
      padding: 15px;
    }

    table, th, td {
      font-size: 14px; /* Adjust table font size for mobile */
    }
  }
</style>

</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="logo">ELocate</div>
    <div class="menu">
      <a href="main.php">Home</a>
      <a href="about us.php">About</a>
      <a href="facility.php">E-Facilities</a>
      <a href="pickup.php">Recycle</a>
      <a href="timeline.php">Guidelines</a>
      <a href="contactus.php">Contact Us</a>
    </div>
</nav>

<!-- Dashboard Content -->
<div class="container">
    <h1>Your Booking History</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Device</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Pickup Date</th>
                    <th>Location</th>
                    <th>Pickup Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['device']); ?></td>
                        <td><?php echo htmlspecialchars($row['model']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['time']); ?></td>
                        <td class="status <?php echo strtolower($row['status']); ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No past bookings found. Please schedule a pickup!</p>
    <?php endif; ?>
</div>

</body>
</html>
