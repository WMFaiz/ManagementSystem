 <?php
	include_once ('functions.php');

	if (isset($_GET['email']) && isset($_GET['token'])) {
	include_once ('../includes/db_connection.php');

		$email = $connection->real_escape_string($_GET['email']);
		$token = $connection->real_escape_string($_GET['token']);

		$sql = $connection->query("SELECT cid FROM company WHERE
			email='$email' AND token='$token' AND token<>'' AND tokenExpire > NOW()
		");

		if ($sql->num_rows > 0) {
			$newPassword = generateNewString();
			$newPasswordEncrypted = password_hash($newPassword, PASSWORD_BCRYPT);
			$connection->query("UPDATE company SET token='', password = '$newPasswordEncrypted'
				WHERE email='$email'
			");

			echo "Your New Password Is $newPassword<br><a href='login.php'>Click Here To Log In</a>";
		} else
			redirectToLoginPage();
	} else {
		redirectToLoginPage();
	}
?>