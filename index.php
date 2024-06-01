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
  <title>MindSupport </title>
  <link rel="stylesheet" href="home.css">
  <link rel="icon" type="image/x-icon" href="logo.png">
  <script src="https://kit.fontawesome.com/a73247f0cf.js" crossorigin="anonymous"></script>
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
    <h1>Welcome to MindSupport</h1>
    <p class="sub-text">Your mental health matters!</p>
    <a href="login.php" class="btn">Get Started <i class="fa-solid fa-arrow-right"></i> </a>
  </div>

  <nav class="secondary-nav">
    <a href="thereapist.php">Therapist Directory </a> |
    <a href="exercise.php">Self-Help Exercises </a> |
    <a href="blog.php">Blogs </a> |
    <a href="#faqs">FAQs </a> |
    <a href="aboutus.php">About Us </a> 
  </nav>

  <div class="container">
    <img src="mhps.png" alt="Mental Health Platform Support" />
    <div class="container-text">
      <p>This platform offers basic psychological support to help you better cope with the psychosocial reactions you
        might experience while facing difficult circumstances.</p>
    </div>
  </div>

  
  <div class="features-container">
    <p class="features-heading" style="font-size: 20px; color: #6f42c1;">FEATURES</p>
    <h2 class="features-heading" style="font-size: 24px;">Empowering Features for Your Mental Well-being. Discover the tools and resources
      MindSupport offers to support your mental health journey.</h2>
    <div class="feature-boxes">
      <div class="feature-box">
        <h2>Therapist Directory</h2>
        <p>Easily find and connect with licensed therapists for support and guidance.</p>
      </div>
      <div class="feature-box">
        <h2>Self-Help Exercises</h2>
        <p>Access a variety of self-help exercises and tools to improve your mental well-being.</p>
      </div>
      <div class="feature-box">
        <h2>Informative Blogs</h2>
        <p>Read insightful blogs on mental health topics to gain knowledge and perspective.</p>
      </div>
      <div class="feature-box">
        <h2>Secure Login and Register</h2>
        <p>Create an account to access personalized features and track your mental health journey.</p>
      </div>
    </div>
  </div>
<div style="text-align: center;">
    <img src="positive_thinking.png" alt="Positive Thinking" style="width: 90%; height: auto; border: #333 solid 1px; border-radius: 30px; margin: 30px; margin-bottom: 5px;" />
    <div class="features-heading" style="margin-left:70px; margin-right: 70px; font-size: 20px;">
      <section id="faqs"> <p >While it may seem to some people that there is nothing they can do when they are in the middle of a difficult and stressful situation, there are steps you can take to relieve the pressure and help you feel better able to manage the stressful situation you might be in right now.</p>
        <p>Information is power. The more we know, the more we feel in control.</p> </section>
    </div>
   
  </div>
   
   <div class="faq-container">
    <div class="faq-left">
        <p class="common-questions-desc">FAQs</p>
      <h1 class="common-questions">Common Questions</h1>
      <p class="common-questions-desc">Here's the most common questions we get asked.</p>
    </div>
    <div class="faq-right">
      <h3 class="faq-question">1. How can I find a therapist on MindSupport?</h3>
      <p class="faq-answer">Easily navigate to the "Therapist Directory" section on the website, where you can search for licensed therapists based on your preferences and needs.</p>
      <h3 class="faq-question">2. Are the self-help exercises suitable for everyone?</h3>
      <p class="faq-answer">While our self-help exercises are designed to benefit a wide range of individuals, it's recommended to consult with a healthcare professional to determine what exercises are best suited for your specific needs.</p>
      <h3 class="faq-question">3. Can I contribute to the blogs section?</h3>
      <p class="faq-answer">Currently, only authorized contributors can publish blogs on MindSupport. However, we welcome suggestions and feedback from our users, which can help shape future blog topics.</p>
      <h3 class="faq-question">4. How secure is the login and registration process?</h3>
      <p class="faq-answer">At MindSupport, we prioritize the security and privacy of our users. Our login and registration processes are encrypted and adhere to industry standards to ensure your information remains safe and confidential.</p>
      <h3 class="faq-question">5. What should I do if I encounter technical issues?</h3>
      <p class="faq-answer">If you experience any technical difficulties while using MindSupport, please reach out to our customer support team. We're here to assist you and ensure you have a seamless experience on our platform.</p>
    </div>
  </div>

  <div class="footer">
    <p>DISCLAIMER:</p>
    <p>MindSupport does not provide crisis support; when an individual is experiencing thoughts of selfharm or suicide, or is showing symptoms of severe mental health conditions. If you are in crisis or you think you may have an emergency, reach out to a suicide helpline in your country of residence: <a href="http://www.suicide.org/international-suicide-hotlines.html" style="color: #fff;">http://www.suicide.org/international-suicide-hotlines.html</a></p>
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
