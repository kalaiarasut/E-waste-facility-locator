<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session to manage user login state
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Please log in first.");
    exit();
}

// Retrieve user's email from session
$user_email = $_SESSION['email']; // Store user's email from session

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['device'], $_POST['price'], $_POST['model'], $_POST['time'], $_POST['location'], $_POST['date'], $_POST['phone'], $_POST['facility'])) {
    $device = $_POST['device'];
    $price = $_POST['price'];
    $model = $_POST['model'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $phone = $_POST['phone'];
    $facility = $_POST['facility'];

    // Debug: Print submitted form data
    error_log(print_r($_POST, true), 3, "form_debug.log");

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'pickup');

    if ($conn->connect_error) {
        die("Database Connection Failed: " . $conn->connect_error);
    }

    // Prepare statement to insert data into the database
    $stmt = $conn->prepare("INSERT INTO pickupdetails (device, price, model, time, location, date, phone, facility, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters (added email parameter)
    $stmt->bind_param("sssssssss", $device, $price, $model, $time, $location, $date, $phone, $facility, $user_email);

    // Execute statement
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "Error: " . $stmt->error;
        error_log("SQL Error: " . $stmt->error, 3, "sql_error.log");
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Schedule E-Waste Pickup</title>
  <style>
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      background-color: #f1f8f4;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .navbar .logo {
      font-size: 1.5rem;
      color: #2e7d32;
      font-weight: bold;
    }

    .navbar .menu {
      display: flex;
      gap: 2rem;
    }

    .navbar .menu a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    .navbar .menu a:hover {
      color: #2e7d32;
    }

    .navbar .signup-btn {
      padding: 0.5rem 1.5rem;
      background-color: #2e7d32;
      color: #fff;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }

    .navbar .signup-btn:hover {
      background-color: #1b5e20;
    }
    body {
      font-family: Arial, sans-serif;
      background-color: #e8f5e9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    

    .pickup-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 128, 0, 0.2);
      max-width: 700px;
      width: 100%;
    }

    h1 {
      text-align: center;
      color: #007f4f;
      font-size: 2em;
      margin-bottom: 5px;
    }

    .subheading {
      text-align: center;
      color: #4caf50;
      font-size: 1.2em;
      margin-bottom: 20px;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
    }

    .form-section {
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: bold;
      color: #333;
      margin-bottom: 5px;
    }

    input, select {
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ddd;
      border-radius: 5px;
      transition: box-shadow 0.3s ease;
    }

    input:focus, select:focus {
      box-shadow: 0 0 8px rgba(0, 128, 0, 0.2);
      border-color: #4caf50;
    }

    .full-width {
      grid-column: span 2;
    }

    button {
      padding: 12px;
      font-size: 18px;
      background-color: #007f4f;
      color: #fff;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      transition: transform 0.3s, background-color 0.3s;
    }

    button:hover {
      background-color: #006f45;
      transform: scale(1.05);
    }

    @media (max-width: 600px) {
      .form-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
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
    <a href="login.php" class="signup-btn">Login</a>
  </nav> 
  <div class="pickup-container">
    <h1>Schedule Your E-Waste Pickup</h1>
    <p class="subheading">Book a pickup and recycle responsibly today.</p>

    <form class="form-grid" id="pickupForm" method="POST" action="">
      <div class="form-section">
        <label for="device">Device:</label>
        <input type="text" id="device" name="device" placeholder="Enter device name" required>
      </div>
      <div class="form-section">
        <label for="price">Recycle Item Price:</label>
        <input type="text" id="price" name="price" placeholder="Enter item price" required>
      </div>
      <div class="form-section">
        <label for="model">Device Company/Model:</label>
        <input type="text" id="model" name="model" placeholder="Enter model name" required>
      </div>
      <div class="form-section">
        <label for="time">Pickup Time:</label>
        <input type="time" id="time" name="time" required>
      </div>
      <div class="form-section">
        <label for="location">Location (District):</label>
        <select id="location" name="location" required>
          <option value="">Select District</option>
          <option value="chennai">Chennai</option>
          <option value="coimbatore">Coimbatore</option>
          <option value="madurai">Madurai</option>
          <option value="trichy">Trichy</option>
          <option value="salem">Salem</option>
          <option value="erode">Erode</option>
          <option value="kanchipuram">Kanchipuram</option>
          <option value="chengalpattu">Chengalpattu</option>
          <option value="tiruvallur">Tiruvallur</option>
          <option value="vellore">Vellore</option>
          <option value="namakkal">Namakkal</option>
        </select>
      </div>
      <div class="form-section">
        <label for="date">Pickup Date:</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="form-section">
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
      </div>
      <div class="form-section">
        <label for="facility">Select Facility:</label>
        <select id="facility" name="facility" required>
          <option value="">Select Facility</option>
        </select>
      </div>
      <div class="form-section full-width">
        <button type="submit" id="submitBtn">Schedule Pickup</button>
      </div>
    </form>
  </div>

  <script>
    const facilitiesByDistrict = {
      chennai: ["M/s A.K.Enterprises", "M/s Abishek Enterprises", "M/s AER Worldwide India Pvt Ltd", "M/s Arockia Enterprises", "M/s Ecosible Recyclers Pvt Ltd", "M/s Green E Waste Private Limited", "M/s INAA Enterprises", "M/s JADG India E-Waste Recyclers Pvt Ltd", "M/s K.P.P enterprises", "M/s MG Traders", "M/s R.M Computers", "M/s SKV E-Waste Recycling Pvt Ltd", "M/s S.P.P. Enterprises", "M/s Trishyraya Recycling Private Limited", "M/s Tritech Systems", "M/s Udhaya Traders"],
      coimbatore: ["M/s Green Era Recyclers", "M/s Green India Recyclers"],
      madurai: [],
      trichy: ["M/s Micro E–Waste Recyclers"],
      salem: ["M/s John Firm"],
      erode: ["M/s Tharani Electronics Waste"],
      kanchipuram: ["M/s Ascent Urban Recyclers Pvt Limited", "M/s Earth Sense Recycle Private Limited", "M/s Enviro Green E-waste Recycling Solutions", "M/s G S Enterprises", "M/s Southern Alloys"],
      chengalpattu: ["M/s Blooming Recyclers", "M/s Leela Traders"],
      tiruvallur: ["M/s Ponniamman Enterprises", "M/s Shri Raam Recycling", "M/s Virogreen India Pvt Ltd"],
      vellore: ["M/s Punithan Enterprises, Unit-II", "M/s RBIA Minerals and Metals Pvt Ltd", "M/s SEZ Recycling", "M/s World Scrap Recycling Solution"],
      namakkal: ["M/s Sai Sri Waste Management Pvt Ltd"]
    };

    const locationSelect = document.getElementById("location");
    const facilitySelect = document.getElementById("facility");

    locationSelect.addEventListener("change", function() {
      const district = locationSelect.value;
      facilitySelect.innerHTML = '<option value="">Select Facility</option>';

      if (district && facilitiesByDistrict[district]) {
        facilitiesByDistrict[district].forEach(facility => {
          const option = document.createElement("option");
          option.value = facility;
          option.textContent = facility;
          facilitySelect.appendChild(option);
        });
      }
    });

    document.getElementById("pickupForm").addEventListener("submit", function(event) {
      // Prevent form submission if any field is not filled
      const form = event.target;
      const allFieldsFilled = Array.from(form.querySelectorAll('input[required], select[required]')).every(field => field.value.trim() !== "");
      
      if (!allFieldsFilled) {
        event.preventDefault(); // Prevent form submission
        alert("Please fill in all required fields.");
      } else {
        alert("Thank you! Your pickup has been scheduled.");
      }
    });
  </script>
</body>
</html>