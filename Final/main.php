<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Menu with Hero Section</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body style */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        /* Fixed menu bar styling */
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

        /* Logo styling */
        .navbar .logo {
            font-size: 1.5rem;
            color: #2e7d32;
            font-weight: bold;
        }

        /* Menu links styling */
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

        /* Signup button styling */
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

        /* Hero section styling */
        .hero-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 4rem 5%;
            margin-top: 80px; 
            background-color: #e0e7f1;
            min-height: 80vh;
        }

        .hero-text {
            max-width: 50%;
        }

        .hero-text h1 {
            font-size: 3.5rem;
            color: #2e7d32;
            margin-bottom: 1rem;
        }

        .hero-text p {
            font-size: 1.5rem;
            color: #555;
            margin: 1.5rem 0;
        }

        .hero-text .cta-btn {
            padding: 1rem 2.5rem;
            font-size: 1.2rem;
            background-color: #2e7d32;
            color: #fff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .hero-text .cta-btn:hover {
            background-color: #1b5e20;
        }

        .hero-image {
            max-width: 50%;
        }

        .hero-image img {
            width: 100%;
            border-radius: 10px;
            max-height: 400px;
            object-fit: cover;
        }

        .content {
            padding: 2rem 5%;
            text-align: center;
        }

        /* FAQ section styling */
        .faq-section {
    background-color: #E0E7F1;
    padding: 30px;
    border-radius: 8px;
}


        .faq-section h2 {
            color: black;
            margin-bottom: 20px;
        }

        .btn-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            text-align: left;
            color: #4169E1;
            font-weight: bold;
        }

        .btn-link:hover {
            text-decoration: none;
            color: #1e8a30;
        }

        .btn-link i {
            font-size: 1.2rem;
            transition: transform 0.3s;
        }

        .btn-link.collapsed i {
            transform: rotate(0deg);
        }

        .btn-link i {
            transform: rotate(180deg);
        }

        .collapse.show {
            background-color: #f2e6f7;
            border-radius: 5px;
        }
        .footer {
    background-color: #24262b;
    padding: 70px 0;
    color: #ffffff;
}
.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.footer-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.footer-col {
    flex: 1;
    min-width: 200px;
    padding: 0 15px;
    margin-bottom: 30px;
}

.footer-col ul {
    padding: 0;
    list-style: none;
}

.footer-col h4 {
    color: #ffffff;
    margin-bottom: 20px;
}

.footer-col ul li {
    margin-bottom: 10px;
}

.footer-col ul li a {
    color: #bbbbbb;
    text-decoration: none;
}

.footer-col ul li a:hover {
    color: #ffffff;
    padding-left: 10px;
}

.social-links a {
    display: inline-block;
    margin-right: 10px;
    color: #ffffff;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
}

.social-links a:hover {
    background: #ffffff;
    color: #24262b;
}

.footer-col {
    width: 25%;
    padding: 0 15px;
}

.footer-col h4 {
    font-size: 18px;
    text-transform: capitalize;
    margin-bottom: 35px;
    font-weight: 500;
    position: relative;
}

.footer-col h4::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: -10px;
    height: 2px;
    width: 50px;
    background-color: #e91e63;
}

.footer-col ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.footer-col ul li:not(:last-child) {
    margin-bottom: 10px;
}

.footer-col ul li a {
    font-size: 16px;
    color: #bbbbbb;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-col ul li a:hover {
    color: #ffffff;
    padding-left: 8px;
}

.social-links a {
    display: inline-block;
    height: 40px;
    width: 40px;
    background-color: rgba(255, 255, 255, 0.2);
    margin: 0 10px 10px 0;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    color: #ffffff;
    transition: all 0.5s ease;
}

.social-links a:hover {
    color: #24262b;
    background-color: #ffffff;
}

@media (max-width: 767px) {
    .footer-col {
        width: 50%;
        margin-bottom: 30px;
    }
}

@media (max-width: 574px) {
    .footer-col {
        width: 100%;
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
            <a href="about.php">About</a>
            <a href="facility.php">E-Facilities</a>
            <a href="pickup.php">Recycle</a>
            <a href="timeline.php">Guidelines</a>
            <a href="contactus.php">Contact Us</a>
        </div>
        <a href="login.php" class="signup-btn">Login</a>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-text">
            <h1>Let Your Old Device Help The <span style="text-decoration: underline; color: #1b5e20;">Environment</span></h1>
            <p>Dispose of your e-waste responsibly and find the nearest recycling facility. Together, we can make a difference!</p>
            <a href="facility.php" class="cta-btn">Locate Your Nearest Facility</a>
        </div>
        <div class="hero-image">
            <img src="sample.png" alt="E-waste recycling illustration">
        </div>
    </section>

    <!-- Page Content -->
    <div class="content">
        <h1>Welcome to ELocate</h1>
        <p>Your technology partner for innovative and impactful E-Waste Facility Locator...</p>
    </div>

    <!-- FAQ Section -->
    <div class="container mt-5">
    <div class="faq-section">
        <center><h2>Frequently Asked Questions (FAQ):</h2></center>
        <div class="accordion" id="faqAccordion">
            <!-- FAQs with icons -->
            <div class="card">
                <div class="card-header" id="faq1">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                            What is an e-waste facility locator? <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapse1" class="collapse" aria-labelledby="faq1" data-parent="#faqAccordion">
                    <div class="card-body">
                        An e-waste facility locator is a tool that helps users find nearby facilities where they can safely recycle or dispose of electronic waste.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="faq2">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                            How can I find the nearest e-waste recycling facility? <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapse2" class="collapse" aria-labelledby="faq2" data-parent="#faqAccordion">
                    <div class="card-body">
                        You can use the e-waste facility locator by entering your location or ZIP code to find the closest recycling centers.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="faq3">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            What items can I recycle at e-waste facilities? <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapse3" class="collapse" aria-labelledby="faq3" data-parent="#faqAccordion">
                    <div class="card-body">
                        Most e-waste facilities accept items like batteries, computers, mobile phones, televisions, printers, small kitchen appliances, and cables.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="faq4">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                            Are there any costs associated with e-waste recycling? <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapse4" class="collapse" aria-labelledby="faq4" data-parent="#faqAccordion">
                    <div class="card-body">
                        Costs may vary depending on the facility and the type of item being recycled. Some facilities offer free recycling, while others may charge a fee for specific items.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="faq5">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                            How does recycling e-waste help the environment? <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapse5" class="collapse" aria-labelledby="faq5" data-parent="#faqAccordion">
                    <div class="card-body">
                        Recycling e-waste helps prevent harmful chemicals from entering the environment and allows valuable materials to be reclaimed and reused, conserving natural resources.
                    </div>
                </div>
            </div>

            <!-- Additional FAQs with icons -->
            <div class="card">
                <div class="card-header" id="faq6">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                            What should I do to prepare my e-waste for recycling? <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapse6" class="collapse" aria-labelledby="faq6" data-parent="#faqAccordion">
                    <div class="card-body">
                        Ensure that any personal data is erased from devices before recycling, remove any accessories that are not recyclable, and sort items as required by the facility.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="faq7">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                            Can I recycle broken or non-functional electronics? <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapse7" class="collapse" aria-labelledby="faq7" data-parent="#faqAccordion">
                    <div class="card-body">
                        Yes, most e-waste facilities accept broken or non-functional electronics for recycling. These items are dismantled, and usable components are salvaged.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="faq8">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                            Is it safe to dispose of batteries at e-waste facilities? <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapse8" class="collapse" aria-labelledby="faq8" data-parent="#faqAccordion">
                    <div class="card-body">
                        Yes, e-waste facilities have specialized processes to safely handle and recycle batteries, preventing potential chemical leaks and environmental damage.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="faq9">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                            What happens to e-waste after it is recycled? <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapse9" class="collapse" aria-labelledby="faq9" data-parent="#faqAccordion">
                    <div class="card-body">
                        E-waste is broken down, and valuable materials are extracted and reused to manufacture new products. Hazardous components are safely disposed of to prevent pollution.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="faq10">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                            Do all e-waste facilities accept the same types of items? <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapse10" class="collapse" aria-labelledby="faq10" data-parent="#faqAccordion">
                    <div class="card-body">
                        No, each e-waste facility may have different policies regarding which items they accept. It’s best to check with the specific facility to know what they recycle.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <footer class="footer">
    <div class="footer-container">
        <div class="footer-row">
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="About us1.php">About Us</a></li>
                    <li><a href="terms.php">Terms and Conditions</a></li>
                    <li><a href="privacy.php">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Get Help</h4>
                <ul>
                    <li><a href="faq.php">FAQ</a></li>
                    <li><a href="try.php">Our Team</a></li>
                    <li><a href="donate.php">Donate</a></li>
                    <li><a href="#">Order Status</a></li>
                    <li><a href="#">Payment Options</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Online Shop</h4>
                <ul>
                    <li><a href="#">Watch</a></li>
                    <li><a href="#">Bag</a></li>
                    <li><a href="#">Shoes</a></li>
                    <li><a href="#">Dress</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Follow Us</h4>
                <div class="social-links">
                    <a href="http://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
                    <a href="http://www.youtube.com"><i class="fab fa-youtube"></i></a>
                    <a href="http://www.instagram.com"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
