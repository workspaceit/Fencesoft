<div class="row widget-box signup-page">
	<div class="two columns"></div>
	<div class="four columns">
		<div id="customer-details" class="widget">
			<h4 class="widget-title">New user registration</h4>
			<?php if(Yii::app()->session['isLogin']):?>
			<ul class="user-logged-in">
				<li class="field">Name: <?php echo Yii::app()->session['profile']['full_name'];?></li>
				<li class="field">Email: <?php echo Yii::app()->session['profile']['email'];?></li>
				<li class="field">Address: <?php echo Yii::app()->session['profile']['address'];?>, <?php echo Yii::app()->session['profile']['city'];?>, <?php echo Yii::app()->session['profile']['state'];?> <?php echo Yii::app()->session['profile']['zip_code'];?></li>
			</ul>
			<?php else:?>
			<?php if(isset($reply)){?><h5 class="widget-title">Please enter your user information in the form below...</h5><?php }
                        $phLoginName = ($error['loginname']) ? 'Username is already taken' : 'User Name *';
                        $phEmail = ($error['email']) ? 'Email is already taken' : 'Email *';
                            
                                ?>
                        
			<form action="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=users/registration" method="post">
				<ul>
					<li class="field">
						<input name="Users[full_name]" placeholder="Full Name" required="required" type="text" class="xwide text" value="" />
					</li>
					<li class="field">
						<input name="Users[login_name]" placeholder="<?php echo $phLoginName;?>" type="text" required="required" class="normal text <?php if($error['loginname']){ ?> error <?php }?>" value="" />
						<input name="Users[password]" placeholder="Password" type="password" required="required" class="normal text" value="" />
					</li>
					<li class="append field"><input name="Users[user_email]" placeholder="<?php echo $phEmail;?>" required="required" type="email" class="xwide email <?php if($error['email']){ ?> error <?php }?>" value="" /><span class="adjoined">@</span></li>
					<li class="field"><input name="Users[address]" placeholder="Address" required="required" class="xwide text" type="text" value="" /></li>
					<li class="field">
						<input name="Users[city]" placeholder="City" required="required" class="normal text" type="text" value="" />
						<input name="Users[state]" placeholder="State" required="required" class="narrow text" type="text" value="" />
					</li>
					<li class="field">
						<input name="Users[zip_code]" placeholder="Zip" required="required" class="xnarrow text" type="text" value="" />
						<input name="Users[phone]" placeholder="Phone" required="required" class="narrow text" type="text" value="" />
					</li>
					<li class="field"><span style="font-size:12px;"><label class="checkbox checked" for="checkbox3"><input id="checkbox3" type="checkbox" checked="checked" name="checkbox3" /></label><span><i class="icon-check terms-check"></i></span>I Agree to the <a href="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=index/termsAndConditions" target="_blank">Terms of Use</a></span></li>
				</ul>
				<div class="small btn primary icon-right icon-user-add widget-btn"><button name="sign_up" id="signupSubmit" type="submit" style="float:left;" title="Create a new customer account using the info above...">Sign-Up<i class="icon-user-add"></i></button></div>
			</form>					
		</div>
	</div>

	<div class="four columns">
		<div class="widget">
			<h4 class="widget-title">Returning customers, login here...</h4>
			<h5 class="widget-title">User Login | <span class="forget-pass"><a href="#" id="forgetPass">Forget Password?</a></span></h5>
			<form name="login-form" id="login-form" action="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=users/login" method="post">
				<div id="login-fields">
					<ul>
						<li class="field"><input name="LoginForm[username]" id="username" placeholder="User Name" type="text" class="xwide text" value="" /></li>
						<li class="field append"><input name="LoginForm[password]" id="pass" placeholder="Password" type="password" class="normal text" value="" style="width:66%;" />
						<div class="medium primary btn"><button id="loginSubmit" type="submit" title="Enter your user info to login to your account...">Submit</button></div></li>
					</ul>
				</div>
			</form>
			<?php endif;?>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(function(){
        $("#forgetPass").on('click',function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=users/forgetPassword',
                type : 'POST',
                success : function(e){
				$.featherlight(e);
			}
            });            
        });
   
        $('#loginSubmit').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var form = $this.parents('form');
            var validator = $("#login-form").validate();
            if (validator.form(e)) {
                    $.ajax({
                        url: baseUrl + '/index.php?r=users/login',
                        type: 'POST',
                        data: {username: $('#username').val(), password: $('#pass').val()},
                        success: function(e) {
                            e = $.parseJSON(e);
                            if (e.status == "success") {
                                window.location = baseUrl + '/index.php?r=index/';
                            } else {
                                notif({
                                    msg: '<strong>Failed:</strong> ' + e.message,
                                    type: 'error',
                                    position: "center",
                                    time: 5000
                                });

                            }
                        }

                    });
               
            }


        });
        $('body').on('click','#forgetSubmitLink', function(e) {
            e.preventDefault();
            $('#error_alert').html('');
        
            var email = $('#email').val();
            var username = $('#username').val();            
            if (email !== "" || username !== "") {
                $.ajax({
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=users/sendforgetPass',
                    type:'POST',
                    data: {
                        email: email,
                        username: username
                    },
                    success: function(data) {
                        var resp = JSON.parse(data);                        
                        $(".featherlight-close").trigger('click');
                        if (resp.status) {
                        	notif({
        					    msg: '<strong>Success:</strong>'+resp.message,
        					    type: 'success',
        					    position: "center",
        					    time : 5000
        					});
                            
                        } else {
                        	notif({
        					    msg: '<strong>Warning:</strong>'+resp.message,
        					    type: 'error',
        					    position: "center",
        					    time : 5000
        					});
                        }
                    }                    
                });
            } else {
            }
        });
    });

</script>