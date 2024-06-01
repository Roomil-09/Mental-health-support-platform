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

// Fetch blogs from the database
$query = "SELECT title, author, content, posted_on FROM blogs";
$result = pg_query($conn, $query);

// Check if query executed successfully
if (!$result) {
  die("Error fetching blogs: " . pg_last_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blogs | MindSupport</title>
  <link rel="stylesheet" href="blog.css">
  <link rel="icon" type="image/x-icon" href="logo.png">
  <script src="https://kit.fontawesome.com/a73247f0cf.js" crossorigin="anonymous"></script>
</head>

<body>
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
    <h1>Unlocking Perspectives: Insights & Reflections</h1>
    <p class="sub-text">Discover a World of Knowledge, Inspiration, and Reflections in Every Read</p>
  </div>

  <nav class="secondary-nav">
    <a href="index.php"> Home</a> |
    <a href="therapist.php">Therapist Directory</a> |
    <a href="exercise.php">Self-Help Exercises </a> |
    <a href="blog.php" style="background-color: #895dcc; color: white;">Blogs </a> |
    <a href="aboutus.php">About Us </a>
  </nav>

  <button id="back-to-top-btn" title="Back to Top">&uarr;</button>

  <div class="container">
    <?php
    // Loop through each row of the result set
    while ($row = pg_fetch_assoc($result)) {
      // Extract data from the current row
      $title = $row['title'];
      $author = $row['author'];
      $content = $row['content'];
      $posted_on = $row['posted_on'];
    ?>
      <!-- Blog card -->
      <div class="blog-card">
        <h2><?php echo $title; ?></h2>
        <h3>Author: <?php echo $author; ?></h3>
        <div class="blog-body">
          <p><?php echo $content; ?></p>
          <p>Posted on: <?php echo $posted_on; ?></p>
        </div>
        <button class="expand-collapse">Expand</button>
      </div>
    <?php
    }
    // Free result set
    pg_free_result($result);
    ?>
  </div>
  <div class="footer">
    <p>DISCLAIMER:</p>
    <p>MindSupport does not provide crisis support; when an individual is experiencing thoughts of self-harm or
      suicide, or is showing symptoms of severe mental health conditions. If you are in crisis or you think you
      may
      have an emergency, reach out to a suicide helpline in your country of residence: <a href="http://www.suicide.org/international-suicide-hotlines.html" style="color: #fff;">http://www.suicide.org/international-suicide-hotlines.html</a>
    </p>
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
  // Get all "Expand/Collapse" buttons
  var expandCollapseButtons = document.querySelectorAll('.expand-collapse');

  // Add click event listener to each button
  expandCollapseButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      // Check if the user is logged in
      if (!loggedIn()) {
        alert('You need to login first.');
        return;
      }

      // Get the blog body associated with this button
      var blogBody = this.parentElement.querySelector('.blog-body');

      // Toggle visibility of blog body
      blogBody.style.display = (blogBody.style.display === 'none' || blogBody.style.display === '') ? 'block' : 'none';

      // Change button text based on visibility
      this.textContent = (blogBody.style.display === 'none' || blogBody.style.display === '') ? 'Expand' : 'Collapse';
    });
  });
});

function loggedIn() {
  // Check if the user is logged in based on session
  <?php if (isset($_SESSION['username'])) : ?>
    return true;
  <?php else : ?>
    return false;
  <?php endif; ?>
}


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