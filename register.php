<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            echo "Received username: " . $username . "<br>";
            echo "Received email: " . $email . "<br>";
            echo "Received password: " . $password . "<br>";

            $conn = pg_connect("host=localhost port=5432 dbname=mindsupport user=postgres password=1234");

            if(!$conn){
                die("Connection failed: " . pg_last_error());
            }

            $query = "INSERT INTO users (u_name, u_email, u_password) VALUES ($1, $2, $3)";
            $res = pg_query_params($conn, $query, array($username, $email, $password));

            if(!$res){
                die("Query failed: "  . pg_last_error());
            }

            header('location:login.php');
            exit(); // Ensure the script stops here
        } else {
            echo "Form data not received";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - MindSupport</title>
  <link rel="icon" type="image/x-icon" href="logo.png">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .register-box {
      width: 70%;
      display: flex;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .login-banner {
      width: 40%;
    }

    .register-form {
      width: 50%;
      padding: 20px;
    }

    .register-form h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .register-form form {
      display: flex;
      flex-direction: column;
    }

    .register-form input {
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .register-form button {
      padding: 10px;
      background-color: #6f42c1;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .register-form button:hover {
      background-color: #895dcc;
    }

    .register-form p {
      margin-top: 20px;
      text-align: center;
    }

    .register-form a {
      color: #6f42c1;
      text-decoration: none;
    }

    .error-message {
      font-size: 12px; 
      margin-bottom: 5px;
      margin-top: 2px; 
      margin-left: 2px;
      color: red;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="register-box">
      <img src="loginbanner.jpg" alt="Login Banner" class="login-banner">
      <div class="register-form">
        <h2>Create an Account</h2>
        <!-- Form submits data to register.php -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
          <input type="text" id="username" name="username" placeholder="Username" required>
          <span id="username-error" class="error-message"></span> <!-- Error message for username -->
          <input type="email" id="email" name="email" placeholder="Email" required>
          <span id="email-error" class="error-message"></span> <!-- Error message for email -->
          <input type="password" id="password" name="password" placeholder="Password" required>
          <span id="password-error" class="error-message"></span> <!-- Error message for password -->
          <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
          <span id="confirm-password-error" class="error-message"></span> <!-- Error message for confirm password -->
          <button type="submit">Register</button>
        </form>
        <p>Already registered? <a href="login.php">Login</a></p>
      </div>
    </div>
  </div>
  <script>
    function validateForm() {
      var username = document.getElementById('username').value;
      var email = document.getElementById('email').value;
      var password = document.getElementById('password').value;
      var confirm_password = document.getElementById('confirm_password').value;

      // Validate username (not empty)
      if (username.trim() === "") {
        document.getElementById('username-error').innerHTML = "Username is required";
        return false;
      } else {
        document.getElementById('username-error').innerHTML = "";
      }

      // Validate email format
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        document.getElementById('email-error').innerHTML = "Invalid email format";
        return false;
      } else {
        document.getElementById('email-error').innerHTML = "";
      }

      // Validate password length
      if (password.length < 8) {
        document.getElementById('password-error').innerHTML = "Password must be at least 8 characters";
        return false;
      } else {
        document.getElementById('password-error').innerHTML = "";
      }

      // Validate confirm password
      if (password !== confirm_password) {
        document.getElementById('confirm-password-error').innerHTML = "Passwords do not match";
        return false;
      } else {
        document.getElementById('confirm-password-error').innerHTML = "";
      }

      return true; // Submit the form if all validations pass
    }
  </script>
</body>
</html>
