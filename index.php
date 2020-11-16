<?php
 include 'core/init.php';
  if($userObj->isLoggedIn()){
 	$userObj->redirect('home.php');
 }
  if(isset($_POST['login'])){
 	$email    = Validate::escape($_POST['email']);
     $password = Validate::escape($_POST['password']);
     
// Method to filter email
 	if(empty($email) or empty($password)){
 		$error = "Enter your email and password to login!";
 	}else {
 		if(!Validate::filterEmail($email)){
 			$error = "Invaild email";
 		}else{
 			if($user = $userObj->emailExist($email)){
                 $hash = $user->password;
                 // verifies if password entered matches hash in database
 				if(password_verify($password, $hash)){
 					//login
 					$_SESSION['user_id'] = $user->user_id;
 					$userObj->redirect('home.php');
 				}else{
 					$error = "Email or Password is incorrect!";
 				}
  			}else{
 				$error = "No account with that email exists";
 			}
 		}
 	}
 }
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>SMS Login Verification System: PHP & MySQL</title>
	<link rel="stylesheet" href="assets/css/style.css"/>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

</head>
<body class="body">
	<div class="wrapper">
	<div class="wrapper-inner">
		<div class="header-wrapper">
			<h1>Welcome! Karibu!</h1>
			<h3>Complete Login and Registration system with Email & Mobile verification Built on PHP & MySQL.</h3>
            <h4> </h4>			
		</div>
        
        <!--HEADER WRAPPER ENDS-->

		<div class="sign-div">
		<div class="sign-in">
			<div class="signIn-inner">
				<form method="POST">
				<div class="input-div">
				<input type="email" name="email" placeholder="Email">
				<input type="password" name="password" placeholder="Password">
				<button type="submit" name="login">Login</button>
				</div>
				</form>
				<?php if(isset($error)):?>
				   <div class="error shake-horizontal"><?php echo $error;?></div>
				<?php endif;?>
			</div>
		</div>
		<div class="r-pass">
			<a href="account/recover/">Forgot Password?</a>
		</div>
		</div>
        
        <!--CONTENT WRAPPER ENDS-->

		<div class="footer-wrapper">
			<div class="inner-footer-wrap">
			<div class="sign-up"><button class="sign-up-btn" onclick="location.href='register/';" type="submit">Sign Up</button></div>
			</div>
		</div>
        
        <!--FOOTER WRAPPER ENDS-->

	</div>
	</div>
    
    <!--WRAPPER ENDS-->

</body>
</html>
