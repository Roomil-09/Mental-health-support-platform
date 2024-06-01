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

// Fetch therapist details from the database
$query = "SELECT * FROM therapists";
$result = pg_query($conn, $query);

// Check if query was successful
if (!$result) {
  die("Error fetching data: " . pg_last_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Therapists | MindSupport </title>
  <link rel="stylesheet" href="therapist.css">
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
    <h1>Find Your Therapist</h1>
    <p class="sub-text">Browse through our directory of licensed therapists</p>
  </div>

  <nav class="secondary-nav">
    <a href="index.php"> Home</a> |
    <a href="therapist.php" style="background-color: #895dcc; color: white;">Therapist Directory </a> |
    <a href="exercise.php">Self-Help Exercises </a> |
    <a href="blog.php">Blogs </a> |
    <a href="aboutus.php">About Us </a>
  </nav>

  <button id="back-to-top-btn" title="Back to Top">&uarr;</button>

  <!-- Filter therapists container -->
  <div class="filter-therapists">
    <input type="text" placeholder="Search therapists...">
    <i class="fas fa-filter filter-icon" onclick="toggleFilterBox()"></i>
  </div>

  <!-- Filter box -->
  <div class="filter-box" id="filterBox">
    <div class="filter-title">Filter Options:</div>
    <div class="filter-option">
      <label for="specialization">Specialization:</label>
      <select id="specialization">
        <!-- Add options for specialization here -->
      </select>
    </div>
    <div class="filter-option">
      <label for="gender">Gender:</label>
      <select id="gender">
        <option value="" selected>Any</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>
    <div class="filter-option">
      <label for="location">Location:</label>
      <input type="text" id="location">
    </div>
    <div class="filter-option">
      <label for="experience">Experience:</label>
      <input type="text" id="experience">
    </div>
    <button class="filter-button" onclick="applyFilters()">Apply Filters</button>
  </div>

  <div class="container">
    <?php
    // Loop through each row in the result set
    while ($row = pg_fetch_assoc($result)) {
      echo "<div class='therapist-card'>";
      // Assuming you have a field 'image_path' in your therapists table
      echo "<img src='" . $row['image_path'] . "' alt='" . $row['name'] . "'>";
      echo "<p><strong>" . $row['name'] . "</strong></p>";
      echo "<p>Experience: " . $row['experience'] . " years</p>";
      echo "<p>Location: " . $row['location'] . "</p>";
      echo "<p>Specialization: " . $row['specialization'] . "</p>";
      echo "<p class='details hidden'>Bio: " . $row['bio'] . "</p>";
      echo "<p class='details hidden'>Address: " . $row['address'] . "</p>";
      echo "<p class='details hidden'>Contact: <a href='tel:" . $row['phone_number'] . "'>" . $row['phone_number'] . "</a></p>";
      echo "<button class='show-details' onclick='showDetails(this)'>Show Details</button>";
      echo "<button class='show-less hidden' onclick='hideDetails(this)'>Show Less</button>";
      echo "</div>";
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
    function showDetails(button) {
      if (loggedIn()) {
        var details = button.parentNode.querySelectorAll('.details');
        details.forEach(function(detail) {
          detail.classList.remove('hidden');
        });
        button.classList.add('hidden');
        button.parentNode.querySelector('.show-less').classList.remove('hidden');
      } else {
        alert('You need to login first.');
      }
    }

    function hideDetails(button) {
      var details = button.parentNode.querySelectorAll('.details');
      details.forEach(function(detail) {
        detail.classList.add('hidden');
      });
      button.classList.add('hidden');
      button.parentNode.querySelector('.show-details').classList.remove('hidden');
    }


    function toggleFilterBox() {
      var filterBox = document.getElementById("filterBox");
      if (filterBox.style.display === "none" || filterBox.style.display === "") {
        filterBox.style.display = "block";
      } else {
        filterBox.style.display = "none";
      }
    }

    function applyFilters() {
      // Implement filter functionality here
    }

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
