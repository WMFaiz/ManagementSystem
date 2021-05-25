 <?php
    use PHPMailer\PHPMailer\PHPMailer;
    include_once('functions.php');

    if (isset($_POST['email'])) {
        include_once ('../includes/db_connection.php');

        $email = $connection->real_escape_string($_POST['email']);

        $sql = $connection->query("SELECT cid FROM company WHERE email='$email'");
        if ($sql->num_rows > 0) {

            $token = generateNewString();

	        $connection->query("UPDATE company SET token='$token', 
                      tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
                      WHERE email='$email'
            ");

	        include_once ('PHPMailer/PHPMailer.php');
	        include_once ('PHPMailer/Exception.php');

	        $mail = new PHPMailer();
	        $mail->addAddress($email);
	        $mail->setFrom("", "");
	        $mail->Subject = "Reset Password";
	        $mail->isHTML(true);
	        $mail->Body = "
	            Hi,<br><br>
	            
	            In order to reset your password, please click on the link below:<br>
	            <a href='
	            http://domain.com/reset_password.php?email=$email&token=$token
	            '>http://domain.com/reset_password.php?email=$email&token=$token</a><br><br>
	            
	            Kind Regards,<br>
	            Nur Izzati
	        ";

	        if ($mail->send())
    	        exit(json_encode(array("status" => 1, "msg" => 'Please Check Your Email Inbox!')));
    	    else
    	        exit(json_encode(array("status" => 0, "msg" => 'Something Wrong Just Happened! Please try again!')));
        } else
            exit(json_encode(array("status" => 0, "msg" => 'Please Check Your Inputs!')));
    }
?>