  <?php
  
  $msg = "";
	use PHPMailer\PHPMailer\PHPMailer;
	


//echo "<pre>"; 
//print_r($_POST);

if (isset($_POST['signup-btn']))
{
		include_once ('../includes/db_connection.php');

		$email = $connection->real_escape_string($_POST['email']);
		$password = $connection->real_escape_string($_POST['password']);
		$cPassword = $connection->real_escape_string($_POST['cPassword']);

		if ($email == "" || $password != $cPassword)
			$msg = "Password do not match!";
		else {
			$sql = $connection->query("SELECT cid FROM company WHERE email='$email'");
			if ($sql->num_rows > 0) {
				$msg = "Email already exists in the database!";
			} else {
				$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				$token = str_shuffle($token);
				$token = substr($token, 0, 10);

				$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

				$connection->query("INSERT INTO company (email,password,email_confirmed,token)
					VALUES ('$email', '$hashedPassword', '0', '$token');
				");

                include_once "PHPMailer/PHPMailer.php";

                $mail = new PHPMailer();
                $mail->setFrom('app@myintern.com.my');
                $mail->addAddress($email);
                $mail->Subject = "Please verify your company email to finish signing up for MyIntern!";
                $mail->isHTML(true);
                $mail->Body = "
                    In order to start using your MyIntern account, you need to confirm your email address.
                    Please click on the link below:<br><br>
                    
                    <a href='http://myintern.com.my/app/company/verify.php?email=$email&token=$token'>Click Here</a>
                ";

                 if ($mail->send())
                    {
                       
                        header('location:login.php');
                    }
                    else
                    {
                        $msg = "Something wrong happened! Please try again!";
                    }
			    }
	}
}

?>
 
 <!DOCTYPE html>
<html>
    
<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <?php include 'css/css.php'; ?>
    
    
</head>

<body>

<!-- Main Container -->

    <div class="desktop-container" style="padding: 20px;">
        
        <p id="text" style=" border-bottom:1px solid lightgrey; padding-bottom:10px; padding-left:10px; font-size: 22px;color: rgba(0,0,0,1); text-align:center ">Sign up with email</p>
        
        
        <img src="" style="display: block; margin-left: auto; margin-right: auto; margin-top: 20px; margin-bottom: 0px; width:90%;">

            <div class="signup-form" style="padding: 20px; width:auto; text-align:center">
        
                <?php if ($msg != "") echo $msg . "<br><br>" ?>
        
                <br>
                <br>
            <form method="post" action="register.php">
                            
                            <div class="form-group">
                                <input type="email" class="form-control" id="Email_or_username" placeholder="Email" name="email" value="" required />
                            </div><br>
                            <div class="form-group">
                                <input type="password" class="form-control" id="Email_or_username" placeholder="Password" name="password" value="" required/>
                            </div><br>
                            <div class="form-group">
                                <input type="password" class="form-control" id="Email_or_username" placeholder="Confirm Password" name="cPassword" value="" required/>
                            </div><br>
                            <br>
                            <div class="form-group">
                                <input type="submit" class="btnSubmit" name="signup-btn" value="Sign Up"/>
                            </div>
 
                           <div class="form-group" style="text-align:center;">
                                <p style="color:black">Already have an account? <a id="link" href="login.php" class="Login" style="">Sign in</a></p>
                            </div>
                        </form>
            
    
        <br>
        <p id="text" style="text-align: center;font-size: 10px;color: rgba(112,112,112,1);">
            By joining, you agree to myintern's <a style="color:rgba(0,147,182,1);" href="https://myintern.com.my/app/student/signup.php">Terms of Service</a></p>

</div>
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php include 'js/js.php'; ?>

</body>
</html>

