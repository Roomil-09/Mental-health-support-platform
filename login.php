<?php
    session_start(); 

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $authenticated = false;
    if(isset($_POST['verify']) && $_POST['verify'] == 'Verify'){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $conn = pg_connect("host=localhost port=5432 dbname=mindsupport user=postgres password=1234");

        if(!$conn){
            die("Connection failed: " . pg_last_error());
        }

        $query = "SELECT verify($1,$2)";
        $res = pg_query_params($conn,$query,array($username,$password));

        if(!$res){
            die("Query failed: " . pg_last_error());
        }

        $result= pg_fetch_result($res, 0, 0);

        if($result === FALSE){
            die("Fetching result failed");
        }

        $authenticated = $result == 1;

        if(!$authenticated){
            echo "You are not authenticated!";
        }else{
            $_SESSION['username'] = $username;
            header('location:home.php');
            exit(); // Ensure the script stops here
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - MindSupport</title>
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

    .login-box {
      width: 70%;
      display: flex;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      justify-content: center;
      align-items: center;
    }

    .login-banner {
      width: 40%;
    }

    .login-form {
      width: 50%;
      padding: 20px;
    }

    .login-form h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .login-form form {
      display: flex;
      flex-direction: column;
    }

    .login-form input {
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .login-form button {
      padding: 10px;
      background-color: #6f42c1;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .login-form button:hover {
      background-color: #895dcc;
    }

    .login-form p {
      margin-top: 20px;
      text-align: center;
    }

    .login-form a {
      color: #6f42c1;
      text-decoration: none;
    }

    /* Style for error messages */
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
    <div class="login-box">
      <img src="loginbanner.jpg" alt="Login Banner" class="login-banner">
      <div class="login-form">
        <h2>Login to Your Account</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <input type="text" name="username" placeholder="Username" autocomplete="username" required>
          <span id="username-error" class="error-message"></span> <!-- Error message for username -->
          <input type="password" name="password" placeholder="Password" required>
          <span id="password-error" class="error-message"></span> <!-- Error message for password -->
          <button type="submit"  name="verify" value="Verify">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
      </div>
    </div>
  </div>

  <script>
    function validateForm() {
      var username = document.getElementById('username').value;
      var password = document.getElementById('password').value;
      var usernameError = document.getElementById('username-error');
      var passwordError = document.getElementById('password-error');
      var isValid = true;

      // Validate username (not empty)
      if (username.trim() === "") {
        usernameError.textContent = "Username is required";
        isValid = false;
      } else {
        usernameError.textContent = "";
      }

      // Validate password (not empty)
      if (password.trim() === "") {
        passwordError.textContent = "Password is required";
        isValid = false;
      } else {
        passwordError.textContent = "";
      }

      return isValid;
    }
  </script>
</body>
</html>
