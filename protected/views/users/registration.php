<div class="row">
    <div class="three columns"></div>
    <div class="widget-box six columns">
        <div id="customer-details" class="widget new-user-login">
            <h3>Thank You for Registering</h3>
            <h5 class="widget-title">Please, login to your account below...</h5>
            <form name="login-form" id="login-form" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=users/login" method="post">
                <div id="login-fields">
                    <h5 class="widget-title">User Login | <span class="forget-pass"><a href="#">Forget Password?</a></span></h5>
                    <ul>
                        <li class="field"><input name="LoginForm[username]" id="username" placeholder="User Name" required="required" type="text" class="xwide text" value="" style="width:51%;" /></li>
                        <li class="field append"><input name="LoginForm[password]" id="pass" placeholder="Password" required="required" type="password" class="normal text" value="" style="width:40%;" />
                            <div class="medium primary btn"><button id="loginSubmit" type="submit" title="Enter your user info to login to your account...">Submit</button></div></li>
                    </ul>
                </div>
            </form>			
        </div>
    </div>
    <div class="three columns"></div>
</div>
<script type="text/javascript">
    $(function() {
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
                                window.location = baseUrl + 'index.php?r=index';
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
    });
</script>