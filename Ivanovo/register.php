

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

require_once 'config.php';
$conn = new mysqli(DB_HOSTNAME, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $conn->real_escape_string($_POST['name']);
    $surname = $conn->real_escape_string($_POST['surname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']); 
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    $checkEmailQuery = "SELECT email FROM registration WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    if (!$stmt) {
      die("Prepare failed: " . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "Email already registered.";
        $stmt->close();
    } else {
       
        $sql = "INSERT INTO registration (Name, Surname, Email, Password) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("ssss", $name, $surname, $email, $password);

        if ($stmt->execute()) {
            echo "Registered successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

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
  <h2>Register</h2>
  <form action="" method="post">


  <div class="input-wrapper">
  <img src="user.svg" alt="User Icon" class="input-icon4" id="input-icon4">
  <input type="text" id="user" name="name" placeholder="Name" required>
  </div>

  <div class="input-wrapper">
  <img src="surname.svg" alt="Surname Icon" class="input-icon3" id="input-icon3">
  <input type="text" id="surname" name="surname" placeholder="Surname" required>
  </div>

  

    <div class="input-wrapper">
  <img src="email.svg" alt="Email Icon" class="input-icon1" id="input-icon1">
  <input type="email" id="email" name="email" placeholder="Email" required>
  </div>

  <div class="input-wrapper">
  <img src="passoword.svg" alt="Password Icon" class="input-icon2" id="input-icon2">
  <input type="password" id="password" name="password" placeholder="Password" required>
  </div>

 



    <button type="submit">Register</button>
  </form>
  <p>Already have an account? <a href="login.php">Login</a></p>
</div>
  <script src="script.js"></script>
</div>

</body>
</html>
