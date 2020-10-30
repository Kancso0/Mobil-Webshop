<?php require_once('views/header.php'); 
 require_once('views/navbar.php'); 

 $Google_loginURL = $gClient->createAuthUrl();   // Google Link

 $redirectURL = "http://localhost/CarWebshop/functions/facebookAuth_callback.php";  // Facebook Link
 $permisson = ['email'];
 $facebook_LoginURL = $facebook_helper->getLoginUrl($redirectURL,$permisson);

 if(Logged_In()) {redirect('dashboard.php');} 

 display_message();
 
 ?>


<div class="card bg-secondary" style="border: 0px">
<article class="card-body mx-auto" style="width: 500px;">
<h4 class="card-title mt-3 text-center">Log in with</h4>

    <p>
		<button name="login_google"  onclick="window.location='<?php echo $Google_loginURL ?>'" type="button" class="btn btn-block btn-twitter"> <i class="fab fa-google"></i>   Login via Google</button>
		<button name="login_facebook" onclick="window.location='<?php echo $facebook_LoginURL ?>'" type="button"  class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</button>
	</p>
	<p class="divider-text">
        <span class="bg-light">OR</span>
	</p>

    <?php loginForm_validation() ?>

	<form method="POST">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="username" class="form-control" placeholder="Username" type="text" required>
    </div> <!-- form-group// -->
    
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password" class="form-control" placeholder="Create password" type="password" required>
    </div> <!-- form-group// -->
                                          
    <div class="form-group">
        <button type="submit" name="login_submit" class="btn btn-primary btn-block"> Log in  </button>
    </div> <!-- form-group// -->
    <div class="card-footer">
    <input  type="checkbox" name="rememberMe" > <span>Remember Me</span>
    <a href="forget.php" class="float-right"> Forget password </a>
    </div>
          
    <p class="text-center">Dont have an account? <a href="register.php">Register</a> </p>                                                                 
</form>
</article>
</div> <!-- card.// -->

 
<!--container end.//-->

<?php require_once('views/footer.php') ?>


