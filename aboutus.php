<?php
session_start();

$dbhost = "localhost";
$dbname = "mindsupport";
$dbuser = "postgres";
$dbpass = "1234";

$conn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | MindSupport</title>
  <link rel="stylesheet" href="#">
  <link rel="icon" type="image/x-icon" href="logo.png">
  <script src="https://kit.fontawesome.com/a73247f0cf.js" crossorigin="anonymous"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      color: #333;
    }

    .navbar {
      background-color: #f8f9fa;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: fixed;
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 0;
      margin-bottom: 20px;
      z-index: 1000;
    }

    .logo {
      display: flex;
      align-items: center;
      margin-left: 20px;
      font-size: 1.5rem;
      line-height: 1.5;
      color: #6f42c1;
      font-weight:700;
    }

    .logo img {
      width: 60px;
      height: auto;
      margin-right: 10px;
    }

    .buttons {
      display: flex;
      align-items: center;
      margin-left: 20px;
    }

    .buttons a {
      text-decoration: none;
      color: #6f42c1;
      margin-right: 20px;
      padding: 8px 16px;
      border-radius: 18px;
      transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    .buttons a.register {
      color: #fff;
      background-color: #6f42c1;
    }

    .buttons a.login:hover {
      color: #895dccd1;
    }

    .buttons a.register:hover {
      background-color: #8a5dcc;
    }

    .hero {
      background-image: url(banner.png);
      background-size: cover;
      background-position: center;
      height: 700px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: #333;
    }

    .hero h1 {
      font-size: 3rem;
      margin-bottom: 20px;
    }

    .sub-text {
      color: #6f42c1;
      font-size: 2rem;
      margin: 10px;
    }

    .btn {
      background-color: #fff;
      color: #6f42c1;
      padding: 10px 20px;
      border: 1px solid #6f42c1;
      border-radius: 20px;
      text-decoration: none;
      transition: background-color 0.3s, color 0.3s, border-color 0.3s;
      position: relative;
      overflow: hidden;
    }

    .btn::after {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
    }

    .btn:hover {
      background-color: #f2f2f2;
      color: #8a5dcc;
      border-color: #8a5dcc;
      transform: scale(1.15);
      transition: 0.5s;
    }

    .secondary-nav {
      background-color: #333333d2;
      width: 90%;
      margin: 0 auto;
      border-radius: 30px;
      overflow: hidden;
      position: relative;
      top: -1.5rem;
      height: 45px;
      text-align: center;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .secondary-nav a {
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      display: inline-block;
    }

    .secondary-nav a:hover {
      background-color: #895dcc;
    }

    .container {
      width: 80%;
      margin: 0 auto;
      padding: 20px;
      background-color: #d1c4e9;
      border-radius: 16px;
    }

    .container-text {
      color: #6f42c1;
      font-size: 1.5rem;
      text-align: center;
      margin-bottom: 50px;
    }

    .footer {
      background-color: #6f42c1;
      color: #fff;
      padding: 20px;
      text-align: center;
      margin-top: 50px;
    }

    .footer p {
      margin-bottom: 10px;
    }

    .contact-with-us {
      font-size: 1.5rem;
      color: #fff;
      margin-bottom: 10px;
    }

    .social-icons {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .social-icon {
      color: #fff;
      margin: 0 10px;
      font-size: 1.5rem;
    }

    .social-icon:hover {
      color: #f2f2f2;
    }
  </style>
</head>

<body>
<nav class="navbar">
    <div class="logo">
      <span>MINDSUPPORT</span>
    </div>
    <div class="buttons">
    <?php if (!isset($_SESSION['username'])): ?>
            
      <a href="login.php" class="login" >Login</a>
      <a href="register.php" class="register">Register</a>
            
        <?php else: ?>
            <div class="login" style="margin-right: 15px; color: #895dcc; font-size: 20px"> Hi, <?= $_SESSION['username'] ?>!</div>
            <a href="logout.php" onclick="return confirm('Are you sure you want to log out?');" class="register">Logout</a>
        <?php endif; ?>
    </div>
  </nav>

  <div class="hero">
    <h1>Untangling Your Mind</h1>
    <p class="sub-text">Unlock the knots of confusion and chaos in your mind with MindSupport. Explore strategies and resources to unravel complexities and discover inner peace.</p>
  </div>

  <!-- Additional navigation bar -->
  <nav class="secondary-nav">
    <a href="index.php"> Home</a> |
    <a href="thereapists.php">Therapist Directory </a> |
    <a href="exercise.php">Self-Help Exercises </a> |
    <a href="blog.php">Blogs </a> |
    <a href="aboutus.php" style="background-color: #895dcc; color: white;">About Us </a> 
  </nav>

  <div class="container">
    <div class="container-text">
      <h2>About Us</h2>
      <p>MindSupport is committed to fostering mental health awareness and providing accessible resources for individuals seeking support. Our platform offers a wide range of services tailored to empower users on their mental health journey. From connecting with licensed therapists to accessing self-help exercises and reading insightful blogs, MindSupport aims to create a supportive community where everyone can prioritize their mental well-being.</p>
      <p>At MindSupport, we believe that mental health is a vital aspect of overall wellness, and everyone deserves access to resources and guidance when navigating challenges. Our dedicated team works tirelessly to ensure that our platform remains a safe, inclusive, and reliable space for individuals to seek assistance and find solace in knowing that they are not alone.</p>
      <p>Join us in our mission to break the stigma surrounding mental health and promote a culture of openness, support, and understanding. Together, let's prioritize mental health and create a world where everyone feels empowered to prioritize their well-being.</p>
    </div>
  </div>

  <div class="footer">
    <p>DISCLAIMER:</p>
    <p>MindSupport does not provide crisis support; when an individual is experiencing thoughts of self-harm or suicide, or is showing symptoms of severe mental health conditions. If you are in crisis or you think you may have an emergency, reach out to a suicide helpline in your country of residence: <a href="http://www.suicide.org/international-suicide-hotlines.html" style="color: #fff;">http://www.suicide.org/international-suicide-hotlines.html</a></p>
    <div class="contact-with-us" style="margin-top: 20px;">Contact With Us</div>
    <div class="social-icons">
      <a href="#"><i class="fab fa-instagram social-icon"></i></a>
      <a href="#"><i class="fab fa-facebook social-icon"></i></a>
      <a href="#"><i class="fab fa-twitter social-icon"></i></a>
      <a href="#"><i class="fas fa-envelope social-icon"></i></a>
    </div>
    <p>Address: 101-Boundary Road, Chembur West, Mumbai</p>
    <p>Contact Number: +91999XXXXX89</p>
    <br />
    <p> &copy; 2024 MindSupport. All rights reserved.</p>  
  </div>

</body>

</html>
