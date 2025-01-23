<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo "Please log in to view your dashboard.";
    exit;
}

// Retrieve the logged-in user's email and company name from the session
$user_email = $_SESSION['email'];
$company_name = $_SESSION['company_name']; // Get the company name from the session

// Database connection
$conn = new mysqli('localhost', 'root', '', 'pickup');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bookings for the logged-in user, filtered by the company name
$stmt = $conn->prepare("SELECT * FROM pickupdetails WHERE email = ? AND facility = ?");
$stmt->bind_param("ss", $user_email, $company_name);
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
        padding: 8px 12px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .navbar .menu a:hover {
        color: #fff;
        background-color: #2e7d32;
    }

    /* Container for main content */
    .container {
        max-width: 1150px;
        margin: 10px auto 20px;  /* Reduced margin-top from 100px to 50px */
        padding: 10px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Main heading */
    h1 {
        text-align: center;
        color: #2e7d32;
        margin-bottom: 20px;
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

    .buttons {
        display: flex;
        gap: 10px;
    }

    .buttons form {
        display: inline;
    }

    .btn {
        padding: 5px 10px;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .accept {
        background-color: green;
    }

    .decline {
        background-color: red;
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
          <th>Price</th>
          <th>Pickup Date</th>
          <th>Pickup Time</th>
          <th>Phone No</th>
          <th>Photo</th>
          <th>Status</th>
          <th>Accept</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['customer_id']); ?></td>
            <td><?php echo htmlspecialchars($row['device']); ?></td>
            <td><?php echo htmlspecialchars($row['model']); ?></td>
            <td><?php echo htmlspecialchars($row['price']); ?></td>
            <td><?php echo htmlspecialchars($row['date']); ?></td>
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
              <?php if (strtolower($row['status']) === 'pending'): ?>
                <form method="POST" action="accept_booking.php">
                  <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" class="accept-button">Accept</button>
                </form>
              <?php else: ?>
                N/A
              <?php endif; ?>
            </td>
            <td>
              <div>
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
    <p>No bookings found for <?php echo htmlspecialchars($company_name); ?>.</p>
  <?php endif; ?>
</div>
</body>
</html>
