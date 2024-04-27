

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles.css">
<title>Jet Journey</title>
</head>
<body>

<?php
session_start(); 

require_once 'config.php';
$conn = new mysqli(DB_HOSTNAME, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

   
    $sql = "SELECT * FROM registration WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
      
        if ($password === $user['Password']) { 
           
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['name'] = $user['Name'];
            
           
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<div class="video-background">
  <div class="video-shadow"></div>
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="video.mp4" type="video/mp4">
  </video>
</div>



<div class="form-container">

  <h2>Login</h2>
  <form action="login.php" method="post">
   
    <div>
      
    <div class="input-wrapper">
  <img src="email.svg" alt="Email Icon" class="input-icon1" id="input-icon1">
  <input type="email" id="email" name="email" placeholder="Email" required>
  </div>

  <div class="input-wrapper">
  <img src="passoword.svg" alt="Password Icon" class="input-icon2" id="input-icon2">
  <input type="password" id="password" name="password" placeholder="Password" required>
  </div>
  <button type="submit" class="submit-btn">Login</button>
  </form>






  <p class="register-link">Don't have an account? <a href="register.php">Register</a></p>
  <script src="script.js"></script>
</div>

</body>
</html>
