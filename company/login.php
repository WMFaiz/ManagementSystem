  <?php
  
   session_start(); 
    include_once ('../includes/db_connection.php');

$msg = "";



if (isset($_POST['login-btn'])) {
    $email = $connection->real_escape_string($_POST['email']);
		$password = $connection->real_escape_string($_POST['password']);

		if ($email == "" || $password == "")
			$msg = "Please check your inputs!";
		else {
			$sql = $connection->query("SELECT * FROM company WHERE email='$email'");
			if ($sql->num_rows > 0) {
                $data = $sql->fetch_array();
                if (password_verify($password, $data['password'])) {
                    if ($data['email_confirmed'] == 0)
	                    $msg = "Please verify your email!";
                    else {
                        
                        $_SESSION['cid']= $data['cid'];
                        $_SESSION['email']= $data['email'];
	                    $_SESSION['name']= $data['name'];
	                    
	                    // header ('location: dashboard.php');
                        header ('location: index.php');
                    }
                } else
	                $msg = "Invalid password. Please try again";
			} else {
				$msg = "Please check your inputs!";
			}
		}
	}
?>
 
 
 <!DOCTYPE html>
<html>
    
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <?php include 'css/css.php'; ?>
    
    
</head>

<body>

<!-- Main Container -->
    
    <div class="desktop-container" style="padding: 20px;">
        
        <p id="text" style="border-bottom:1px solid lightgrey; padding-bottom:10px; padding-left:10px; font-size: 22px;color: rgba(0,0,0,1); text-align:center;">Sign in</p>
        
        <div style="padding: 20px; text-align:center">
 
        <img src="../img/MyIntern.svg" style="display: block; margin-left: 43%; margin-top: 60px; margin-bottom: 25px; width:60px; height:667; ">
        
        <p id="text" style="font-size:25px; padding-left:20px; font-weight: bold;font-size: 24px; color: rgba(0,0,0,1); "><b>Welcome to myintern</b></p>
        <p style="padding-left:20px; font-family: Helvetica Neue;font-style: normal;font-weight: normal;font-size: 16px;color: rgba(112,112,112,1);">Please enter your email and password.</p>
        
            <div class="login-form" style="padding: 20px; text-align:center" >
                
                    <?php if ($msg != "") echo $msg ?>
             
                    <form method="post" action="login.php" style="text-align:center">
                        
                        <div class="form-group" id="Email_or_username">
                            <input type="text" class="form-control" placeholder="Email" name ="email" required />
                        </div>
                        <br>
                        <div class="form-group" id="Email_or_username">
                            <input type="password" class="form-control" placeholder="Password" name ="password" required/>
                        </div>
                        <br>
                        
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" name="login-btn" value="Sign In">
                        </div>
                        <br>
                        <p style="text-align: center;font-family:Helvetica Neue; font-style:normal; font-weight:normal; font-size: 16px;color: rgba(112,112,112,1);">
                            or use your social networks</p>
                        <br>
                        <div class="form-group">
                            <input type="submit" class="btnSubmitFacebook" name="submit" value="Facebook">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmitGoogle" name="submit" value="Google">
                        </div>
                        
                        <div class="form-group">
                            <a id="link" href="signupterms.php" class="" value="Login" style="float:center; margin-right:420px; color:grey"><b>Sign up</b></a>
                            
                            <a id="link2" href="forgotpassword.php" class="ForgetPwd" value="Login" style="float:center; color:grey"><b>Forgot Password</b></a>
                        </div>
                        
                    </form>
            </div>
        </div>
<!-- Main Container -->
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- <?php include 'js/js.php'; ?> -->

</body>
</html>


