<?php require_once('views/header.php') ?>
<?php require_once('views/navbar.php') ?>

<?php if(Logged_In()) {redirect('dashboard.php');} ?>

<div class="card bg-secondary" style="border: 0px">
<article class="card-body mx-auto" style="width: 500px;">
	<h4 class="card-title mt-3 text-center">Create Account</h4>
	

	<?php signupForm_validation();?>

	<form method="POST">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="username" class="form-control" placeholder="Username" type="text" required>
    </div> <!-- form-group// -->
	<div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="fullname" class="form-control" placeholder="Full Name" type="text" required>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email address" type="email" required>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>
		<select name="first_phone" class="custom-select" style="max-width: 120px;">
		    <option value="30" selected="">+30</option>
		    <option value="20">+20</option>
		    <option value="70">+70</option>
		    <option value="46">+46</option>
		</select>
    	<input name="phone" class="form-control" placeholder="Phone number" type="text" required>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password" class="form-control" placeholder="Create password" type="password" required>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input  name="confPassword" class="form-control" placeholder="Repeat password" type="password" required>
    </div> <!-- form-group// -->                                      
    <div class="form-group">
        <button type="submit" name="reg_submit" class="btn btn-primary btn-block"> Create Account  </button>
    </div> <!-- form-group// -->      
    <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>                                                                 
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->







<?php require_once('views/footer.php') ?>