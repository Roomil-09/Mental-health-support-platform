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

// Fetch exercises from the database
$query = "SELECT title, description FROM exercises";
$result = pg_query($conn, $query);

// Check if query was successful
if (!$result) {
  die("Error fetching exercises: " . pg_last_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Self-Help Exercises | MindSupport</title>
  <link rel="stylesheet" href="exercise.css">
  <link rel="icon" type="image/x-icon" href="logo.png">
  <script src="https://kit.fontawesome.com/a73247f0cf.js" crossorigin="anonymous"></script>
</head>

<body>
  <!-- Your HTML content here -->
  <nav class="navbar">
    <div class="logo">
      <span>MINDSUPPORT</span>
    </div>
    <div class="buttons">
      <?php if (!isset($_SESSION['username'])) : ?>
        <a href="login.php" class="login">Login</a>
        <a href="register.php" class="register">Register</a>
      <?php else : ?>
        <div class="login" style="margin-right: 15px; color: #895dcc; font-size: 20px"> Hi, <?= $_SESSION['username'] ?>!</div>
        <a href="logout.php" onclick="return confirm('Are you sure you want to log out?');" class="register">Logout</a>
      <?php endif; ?>
    </div>
  </nav>

  <div class="hero">
    <h1>Self-Help Exercises</h1>
    <p class="sub-text">Explore our self-help exercises to enhance your mental well-being</p>
  </div>

  <nav class="secondary-nav">
    <a href="index.php"> Home</a> |
    <a href="thereapist.php">Therapist Directory</a> |
    <a href="exercise.php" style="background-color: #895dcc; color: white;">Self-Help Exercises </a> |
    <a href="blog.php">Blogs </a> |
    <a href="aboutus.php">About Us </a>
  </nav>

  <button id="back-to-top-btn" title="Back to Top">&uarr;</button>

  <div class="container">
    <?php
    // Loop through fetched exercises and display them
    while ($row = pg_fetch_assoc($result)) {
      echo '<div class="self-help-exercise">';
      echo '<h2>' . $row['title'] . '</h2>';
      echo '<div class="exercise-details">';
      echo '<p>' . $row['description'] . '</p>';
      echo '</div>';
      echo '<button class="read-more">Read More</button>';
      echo '</div>';
    }
    ?>
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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Get all "Read More" buttons
      var readMoreButtons = document.querySelectorAll('.read-more');

      // Add click event listener to each button
      readMoreButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          // Get the exercise details associated with this button
          var exerciseDetails = this.parentElement.querySelector('.exercise-details');

          // Check if user is logged in
          <?php if (!isset($_SESSION['username'])) : ?>
            // If not logged in, show alert
            alert('You have to log in first.');
          <?php else : ?>
            // If logged in, toggle visibility of exercise details
            exerciseDetails.style.display = (exerciseDetails.style.display === 'none' || exerciseDetails.style.display === '') ? 'block' : 'none';
          <?php endif; ?>
        });
      });
    });


    window.addEventListener('scroll', function() {
      var scrollPosition = window.pageYOffset;

      // Show back to top button when user scrolls down
      if (scrollPosition > 300) {
        document.getElementById('back-to-top-btn').style.display = 'block';
      } else {
        document.getElementById('back-to-top-btn').style.display = 'none';
      }
    });

    // Scroll to top when button is clicked
    document.getElementById('back-to-top-btn').addEventListener('click', function() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  </script>

</body>

</html>