<div class="row">
	<div class="three columns"></div>
	<div class="widget-box six columns">
		<div id="customer-details" class="widget new-user-login">
			<h3>Thank You for Registering</h3>
			<h5 class="widget-title">Please, login to your account below...</h5>
			<form action="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=users/login" method="post">
				<div id="login-fields">
					<h5 class="widget-title">User Login | <span class="forget-pass"><a href="#" id="forgetPass">Forget Password?</a></span></h5>
					<ul>
						<li class="field"><input name="LoginForm[username]" placeholder="User Name" type="text" class="xwide text" value="" style="width:51%;" /></li>
						<li class="field append"><input name="LoginForm[password]" placeholder="Password" type="password" class="normal text" value="" style="width:40%;" />
						<div class="medium primary btn"><button id="loginSubmit" type="submit" title="Login to your account">Submit</button></div></li>
					</ul>
				</div>
			</form>			
		</div>
	</div>
	<div class="three columns"></div>
</div>