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

// Handle deletion if requested
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
  $delete_id = intval($_POST['delete_id']); // Get the ID of the booking to delete

  // Prepare the SQL statement to delete the booking
  $stmt = $conn->prepare("DELETE FROM pickupdetails WHERE id = ? AND email = ?");
  $stmt->bind_param("is", $delete_id, $user_email); // Use the ID and user's email for extra security

  if ($stmt->execute()) {
      echo "<script>alert('Booking deleted successfully.'); window.location.href='dashboard.php';</script>";
  } else {
      echo "<script>alert('Error deleting booking. Please try again later.');</script>";
  }

  $stmt->close();
}
// Fetch bookings for the logged-in user
$stmt = $conn->prepare("SELECT * FROM pickupdetails WHERE email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

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
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f7fa;
      padding-top: 80px;
    }
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      background-color: #f1f8f4;
      padding: 1rem 2rem;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }
    .navbar .logo {
      font-size: 1.5rem;
      color: #2e7d32;
      font-weight: bold;
      margin-right: 30px;
    }
    .navbar .menu {
      display: flex;
      gap: 2rem;
    }
    .navbar .menu a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
      padding: 8px 12px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    .navbar .menu a:hover {
      color: #fff;
      background-color: #2e7d32;
    }

    /* Container Styling */
    .container {
      max-width: 1300px;
      margin: 5px auto 20px;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
      color: #2e7d32;
      margin-bottom: 20px;
    }

    /* Table Styling */
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

    /* Buttons Styling */
    .delete-button, .payment-button {
      background-color: #d9534f;
      color: white;
      padding: 5px 5px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }
    .payment-button {
      background-color: #28a745;
    }
    .delete-button:hover {
      background-color: #c9302c;
    }
    .payment-button:hover {
      background-color: #218838;
    }

    /* Flexbox for Buttons */
    td div {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    /* Status Column Styling */
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

    /* Responsive Design */
    @media (max-width: 768px) {
      .navbar {
        padding: 1rem;
      }
      .navbar .menu {
        flex-direction: column;
        gap: 1rem;
        align-items: center;
      }
      .container {
        margin: 80px auto 20px;
        padding: 15px;
      }
      table, th, td {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
<div class="container">
  <h1>Your Booking History</h1>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>Customer ID</th>
          <th>Device</th>
          <th>Model</th>
          <th>Facility</th>
          <th>Price</th>
          <th>Pickup Date</th>
          <th>Location</th>
          <th>Pickup Time</th>
          <th>Phone No</th>
          <th>Photo</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['customer_id']); ?></td>
            <td><?php echo htmlspecialchars($row['device']); ?></td>
            <td><?php echo htmlspecialchars($row['model']); ?></td>
            <td><?php echo htmlspecialchars($row['facility']); ?></td>
            <td><?php echo htmlspecialchars($row['price']); ?></td>
            <td><?php echo htmlspecialchars($row['date']); ?></td>
            <td><?php echo htmlspecialchars($row['location']); ?></td>
            <td><?php echo htmlspecialchars($row['time']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td>
              <?php if (!empty($row['images'])): ?>
                <form action="View.php" method="GET">
                  <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($row['customer_id']); ?>">
                  <button type="submit">View</button>
                </form>
              <?php else: ?>
                NULL
              <?php endif; ?>
            </td>
            <td class="status <?php echo strtolower(str_replace(' ', '-', $row['status'])); ?>">
    <?php echo ucfirst($row['status']); ?>
</td>
<td>
    <div>
        <?php if (strtolower($row['status']) === 'accepted'): ?>
            <form action="payment.php" method="GET">
                <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($row['customer_id']); ?>">
                <input type="hidden" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>">
                <button type="submit" class="payment-button">Proceed to Payment</button>
            </form>
        <?php elseif (strtolower($row['status']) === 'payment completed'): ?>
            <button class="payment-button" disabled>Payment Completed</button>
        <?php endif; ?>

        <?php if (strtolower($row['status']) === 'pending'): ?>
            <form method="POST" action="" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                <button type="submit" class="delete-button">Delete</button>
            </form>
                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No bookings found.</p>
  <?php endif; ?>
</div>
</body>
</html>