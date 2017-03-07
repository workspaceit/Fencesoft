<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="UTF-8">
		<title>FenceSoft 2.0</title>
		<!--iOS/android/handheld specific -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery-ui-bootstrap/css/jquery-ui-1.10.0.custom.css">		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css">		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/slider.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/notifIt/css/notifIt.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iOS-Overlay/css/iosOverlay.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iOS-Overlay/css/prettify.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fs-mods.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/hd-mods.css">
		<script>
	        var oldieCheck = Boolean(document.getElementsByTagName('html')[0].className.match(/\soldie\s/g));
	        if (!oldieCheck) {
	            document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"><\/script>');
	        } else {
	            document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"><\/script>');
	        }
    	</script>
	</head>
	<body>
		<!-- Header -->
	    <div class="row">
	        <div class="six columns">
				<!-- Network Logo | Need to replace image path with uploaded file in Global Settings -->
	            <!-- <img class="fs-logo" src="<?php echo Yii::app()->request->baseUrl; ?>/images/Freedom-Outdoor-Products.png" alt="Freedom Outdoor Products" /> -->
				<img class="fs-logo" src="<?php echo Yii::app()->request->baseUrl; ?>/images/Veranda.png" alt="Veranda" />
				<!-- <img class="fs-logo" src="<?php echo Yii::app()->request->baseUrl; ?>/images/ActiveYards.png" alt="ActiveYards" /> -->
	        </div>
	        <div class="three columns widget-box">
	            <div class="widget location-info">
					<i class="icon-info-circled"></i>
					<!-- Verbiage changes for Networks -->
	                <!-- <h5>Your Store Information</h5>
					<p>Nearest store location and details...</p> -->
					<h5>Your Dealer Information</h5>
					<p>Nearest dealer location and details...</p>
					<h4>Valparaiso, IN</h4>
					<div class="small default btn pretty more-info-btn"><a href="#" title="Find the dealer nearest to you...">More Info</a></div>
	            </div>
	        </div>	        
	        <div class="three columns widget-box">
	            <div class="widget login-signup">
	            <?php if(Yii::app()->session['isLogin']):?>
	            <a href="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=index/logout">Logout</a>
	            <?php else :?>
	                <h5>Are you a returning customer?</h5>
					<p>Sign back into your account below...</p>
	                <div class="small default btn pretty icon-right icon-user sign-in-btn"><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=users/registration" title="Sign-in to existing account or register for new...">Login<i></i>Sign-Up</a></div>
	            <?php endif;?>
	            </div>
	        </div>
	    </div>
	    <!-- Fixed Navigation -->
	    <div class="pretty navbar row" id="nav3">
	        <div class="row">
	            <a class="toggle" gumby-trigger="#nav3 > .row > ul" href="#"><i class="icon-menu"></i></a>
	            <ul class="six columns">
	                <li class="first-nav-item"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=index/index" title="Select your fence material..."><i class="icon-home"></i> Material Selection</a></li>
	                <li class="second-nav-item"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=index/estimation" title="Draw your design plans..."><i class="icon-pencil"></i> Draw Your Plans</a></li>
	                <li class="third-nav-item"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=index/estimation" title="Generate a fence material estimate..."><i class="icon-download"></i> Generate Quote</a></li>
				</ul>
				<div class="three columns"></div>
				<ul class="three columns search-column">
					<li class="field">
						<form action="#" method="get" name="single_search_form" id="single_search_form">
							<input type="hidden" name="search_type" value="generic" />
							<input id="generic_search" class="search input" name="search" type="search" placeholder="Search..." />
						</form>
					</li>
				</ul>	
	        </div>
	    </div>
	    <script type="text/javascript">
	        var baseUrl = '<?php echo Yii::app()->request->baseUrl; ?>';
	        var isLogin = '<?php if(Yii::app()->session['isLogin']){ echo 'TRUE'; } else { echo 'FALSE'; }?>';        
    		var getSpinnerObject = function(){
    			var spinnerOpts = {
            			lines: 13, // The number of lines to draw
            			length: 11, // The length of each line
            			width: 5, // The line thickness
            			radius: 17, // The radius of the inner circle
            			corners: 1, // Corner roundness (0..1)
            			rotate: 0, // The rotation offset
            			color: '#FFF', // #rgb or #rrggbb
            			speed: 1, // Rounds per second
            			trail: 60, // Afterglow percentage
            			shadow: false, // Whether to render a shadow
            			hwaccel: false, // Whether to use hardware acceleration
            			className: 'spinner', // The CSS class to assign to the spinner
            			zIndex: 2e9, // The z-index (defaults to 2000000000)
            			top: 'auto', // Top position relative to parent in px
            			left: 'auto' // Left position relative to parent in px
            		};
        		var target = document.createElement("div");
        		document.body.appendChild(target);
        		SpinnerObj = new Spinner(spinnerOpts).spin(target);
            };
            
	    	$(function(){	    		
	    		$('#single_search_form').on('submit',function(e){
	    			e.preventDefault();
	    			postData = $(this).serializeArray();
	    			$.ajax({
	    				url: '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=index/getfences',
	    				data : postData,
	    				type : 'GET',
	    				success : function(data){
	    					$('#fence-data').html(data);
	    				}
	    			});
	    		});	    		
		    });
	    </script>
		<?php echo $content; ?>
		<!-- Footer -->
	    <div id="footer" class="row">
	        <div class="four columns left-align">
				<!-- Network Footer Logo | Need to replace image path with 2nd uploaded file in Global Settings -->
	            <!-- <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Lowes.png" alt="Lowe's - Never Stop Improving" /> -->
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Home-Depot.png" alt="Home Depot" />
				<!-- <p class="copy2">&copy; 2013 ActiveYards. All rights reserved. | <a href="#">Terms &amp; Conditions</a></p> -->
	        </div>
			<div class="four columns middle">
				<h4 class="powered-by">Powered by: <a href="http://fencesoft.com" target="_blank">FenceSoft<span>&reg;</span></a></h4>
			</div>
	        <div class="four columns right-align">
	            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Barrette.png" alt="Built by Barrette Outdoor Living" />
				<!-- <h4 class="powered-by solo-banner">Powered by: <a href="http://fencesoft.com" target="_blank">FenceSoft<span>&reg;</span></a></h4> -->
	        </div>
	    </div>
		<div id="copyright" class="row">
			<div class="twelve columns">
				<p>&copy; 2013 Barrette Outdoor Living. All rights reserved. | <a href="#">Terms &amp; Conditions</a></p>
			</div>
		</div>
	    <script type="text/javascript">
	        if (!window.jQuery) {
	            if (!oldieCheck) {
	                document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/jquery-2.0.2.min.js"><\/script>');
	            } else {
	                document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/jquery-1.10.1.min.js"><\/script>');
	            }
		    }
	    </script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.3.custom.min.js"></script>
		<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ocanvas-2.4.0.min.js"></script>-->
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kinetic-v4.7.4.min.js"></script>
               
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/additional-methods.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-paginator.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/notifIt/js/notifIt.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iOS-Overlay/js/iosOverlay.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iOS-Overlay/js/prettify.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iOS-Overlay/js/spin.min.js"></script>
		<!-- <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-slider.js"></script>-->
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/gumby.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
	</body>
</html>
