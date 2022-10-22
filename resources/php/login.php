<?php

//session_start();
require_once "config.php";
require "session.php";

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) 
{
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	
	if (empty($username))
	{
		$error .= '<p class="error">Field cannot be empty.</p>';
	}

	if (empty($password))
	{
		$error .= '<p class="error">Field cannot be empty.</p>';
	}

	if (empty($error))
	{
		if($query = $db->prepare("SELECT * FROM users1 WHERE username = ?"))
		{
			$query->bind_param('s', $username);
 			$query->execute();
			$row = $query->fetch();
			if ($row) 
			{
				//if (password_verify($password, $row['password']))
				$password = password_hash($password, PASSWORD_BCRYPT);
				if (strcmp($password,  $row['password']))
				{
					//print "<h1>HI, </h1> <p> {$row['password']}</p>";
					//print "<h1>HI, </h1> <p> {$password}</p>";
					//session_start();
					//print "<h1>HI, </h1> <p> {$row}</p>";					
					$_SESSION["userid"] = $row['id'];
					$_SESSION["user"] = $row;
					
					header("location: index.php");
					exit;
				}
				else
				{
					$error .= '<p class="error">The password is incorrect.</p>';
					
				}
			}
			else
			{
				$error .= '<p class="error">No such username was found.</p>';
			}
		}
		$query->close();
	}
	mysqli_close($db);
}
?>
<!DOCTYPE html>
<html>
<title>Login</title>

<body style="background-color:#F9FEFF">
  <?php echo $error; ?>
  <form action="" method="post">
    <h1>
      <center>User Login</center>
    </h1>
    <p>
      <center>
        <label for="Username">Username:</label>
        <input type="text" id="Username" name="username" placeholder="Username" required />
      </center>
      <center>
        <label for="Password">Password:</label>
        <input type="password" id="Password" name="password" placeholder="Password" required>
      </center>
      <br>
      <center>
        <input type="submit" name="submit" value="Submit" required>
      </center>
  </form>
  <br>
  <center>
    <p>Don't have an account? Sign up
      <a href="signup.php">here</a>.</p>
  </center>
  </p>
</body>

</html>

