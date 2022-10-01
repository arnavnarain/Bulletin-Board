<?php

require_once "config.php";
require_once "session.php";
error_reporting(E_ALL ^ E_WARNING);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) 
{
	$username = trim($_POST['username']);
 	$email = trim($_POST['email']);
 	$password = trim($_POST['password']);
 	$password_hash = password_hash($password, PASSWORD_BCRYPT);	
	
	if($query = $db->prepare("SELECT * FROM users1 WHERE username = ?"))
	{
		$error = '';
		
		$query->bind_param('s', $username);
 		$query->execute();
 		// Check database for prexisting username
 		$query->store_result();
		if ($query->num_rows > 0) 
		{
 			$error .= '<p class="error">The username is already registered!</p>';
 		} 
		else 
		{
 			// Validate password
 			if (strlen($password ) < 6) 
			{
 				$error .= '<p class="error">Password must have atleast 6 characters.</p>';
 			}
 			if (empty($error)) 
			{
 				$insertQuery = $db->prepare("INSERT INTO users1 (username, email, password) VALUES (?, ?, ?);");
 				$insertQuery->bind_param("sss", $username, $email, $password_hash);
				$result = $insertQuery->execute();
 				if ($result) 
				{
 					$error .= '<p class="success">Your registration was successful!</p>';
 				} 
				else 
				{
 					$error .= '<p class="error">Something went wrong!</p>';
 				}
 			}
 		}
 	}
 $query->close();
 $insertQuery->close();
 // Close DB connection
 mysqli_close($db);
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Sign Up</title>
  <link rel="stylesheet" href="test.css">
</head>

<body>
  <center>
    <div class="c">
      <div class="r">
        <h2>Register</h2>
	  <?php echo $success; ?>
	  <?php echo $error; ?>
        <form action="" method="post">
          <div class="div1">
            <label>Username</label>
            <input type="text" name="username" required placeholder="Username">
          </div>
          <div class="div2">
            <label>Email Address</label>
            <input type="email" name="email" required placeholder="Email">
          </div>
          <div class="div3">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Password">
          </div>
          <div class="div4">
            <input type="submit" name="submit" value="Submit" required>
          </div>
          <p>Already registered?
            <a href="login.php">Login here</a>.</p>
        </form>
      </div>
    </div>
  </center>
</body>

</html>