<br><br>
<div class="container">
	<section class="py-5" style="min-height:330px;">    	    
		<h1>Login</h1> 
		<br>
		<div class="login-result"></div>
		<p>Demo user:
		<br><strong>E-mail:</strong> louiswol3@gmail.com
		<br><strong>Password:</strong> 1234
		</p>
		<form id="loginForm">			
			<div class="input-group">
				<input type="hidden" name="movie_id" value="<?= $movie_id; ?>" id="movie_id">
				<input type="text" name="user_email" value="" placeholder="Your e-mail" class="form-control" id="user_email">
			</div>
			<br>
			<div class="input-group">
				<input type="password" name="user_password" value="" placeholder="Your password" class="form-control" id="user_password">
			</div>		
			<br>	
			<div class="input-group">
				<input type="submit" class="btn btn-default" style="margin-top:20px;" value="Login" id="Login">
			</div>
			<div style="float:right"><a href="register">I need an account</a></div>
		</form>						        
	</section>
</div>