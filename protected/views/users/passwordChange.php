<?php if($status==1){ ?>
<div class="row">	<div class="three columns"></div>	<div class="widget-box six columns">		<div id="customer-details" class="widget new-user-login">			<h3>Reset Password</h3>			<h5 class="widget-title" style="margin-bottom:20px;">Enter your new password and confirm below...</h5>			<div id="login-fields">				<ul>					<li class="field" style="margin-bottom:20px;"><input name="password" id="password" placeholder="New Password" type="password" value="" style="width:46%; min-width:200px;" /><input id="email" value="<?php $user->user_email?>" type="hidden" /></li>					<li class="field append" style="margin-bottom:20px;"><input name="retype_password" id="retype_password" placeholder="Confirm Password" type="password"  value="" style="width:35%; min-width:150px;" />					<div class="medium primary btn"><button id="change-submit" type="submit">Submit</button></div></li>				</ul>				<p><span style="color:#FF0000" id="error_alert"></span></p>			</div>		</div>	</div>	<div class="three columns"></div></div><? }else{ ?><div class="row">	<div class="three columns"></div>	<div class="widget-box six columns">		<div id="customer-details" class="widget new-user-login">			<h3><?php echo $reply;?></h3>		</div>	</div>	<div class="three columns"></div></div><?php }?>
<script type="text/javascript">
    $(function(){
        $('#change-submit').on("click",function(e){
            e.preventDefault();
            var pass=$('#password').val();
            var repass=$('#retype_password').val();
            if(pass!==null){
                if(pass===repass){
                    $.ajax({
                        url:'<?php echo Yii::app()->request->baseUrl."/index.php?r=users/newPassword&email=".$_GET['email']."&passwordToken=".$_GET['passwordToken'];?>',
                        type:"POST",
                        data:{
	                        password:pass
                        },
                        success : function(e){
                            var reply = $.parseJSON(e);
                            if(reply.status=='success') {
                            	notif({
            					    msg: '<strong>Success:</strong>'+reply.message,
            					    type: 'success',
            					    position: "center",
            					    width : 'all',
            					    height : 100
            					});
            					window.location = "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=users/registration";
                            } else {
                            	notif({
            					    msg: reply.message,
            					    type: reply.staus,
            					    position: "center",
            					});
                            }
                        }
                    });
                } else {
                	notif({
					    msg: '<strong>Warning:</strong> Password do not match',
					    type: 'warning',
					    position: "center",
					    time : 5000
					});
                }
            }
        });
   
  
     });
</script>
