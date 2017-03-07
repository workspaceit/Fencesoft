<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="UTF-8">
		<title>Lowe's Fence Estimation</title>
		<!--iOS/android/handheld specific -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery-ui-bootstrap/css/jquery-ui-1.10.0.custom.css">		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css">		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/slider.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/featherlight/featherlight.min.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/notifIt/css/notifIt.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iOS-Overlay/css/iosOverlay.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iOS-Overlay/css/prettify.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/image-picker/image-picker.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery.qtip.custom/jquery.qtip.min.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fs-mods.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lowes-mods.css">
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
				<a href="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=index/index"><img class="fs-logo" src="<?php echo Yii::app()->request->baseUrl; ?>/images/Freedom-Outdoor-Products.png" alt="Freedom Outdoor Products" /></a>
	        </div>
	        <div class="three columns widget-box">
	            <div class="widget location-info">
					<i class="icon-info-circled"></i>
					<div class="location-info-centered">
						<h5 class="tool-tip">Your Local Store Information</h5>
						<h4><?php echo $this->storeCity;?>, <?php echo $this->storeState;?></h4>
						<div class="small default btn pretty more-info-btn"><a href="#" id="qtip-StoreInfo">More Info</a></div>
					</div>
	            </div>
	        </div>	  
	        <div class="three columns widget-box">			
	            <div class="widget login-signup">
	            <?php if(Yii::app()->session['isLogin']):?>
					<h5 style="margin-bottom:10px;">Welcome back, <?php echo Yii::app()->session['profile']['full_name'];?></h5>
					<div class="small default btn pretty icon-left icon-user sign-in-btn"><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=index/logout">Logout</a></div>
	            <?php else :?>
	                <h5>Are you a returning customer?</h5>
					<p>Sign back into your account</p>
	                <div class="small default btn pretty icon-left icon-user sign-in-btn"><a id="qtip-LoginBox" href="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=users/registration">Sign-Up<i></i>Login</a></div>
	            <?php endif;?>
	            </div>
	        </div>
	    </div>
	    <!-- Fixed Navigation -->
	    <div class="pretty navbar row" id="nav3">
	        <div class="row">
	            <a class="toggle" gumby-trigger="#nav3 > .row > ul" href="#"><i class="icon-menu"></i></a>
	            <ul class="six columns">
	                <li class="first-nav-item"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=index/index"><i class="icon-home"></i> Material Selection</a></li>
	                <li class="second-nav-item"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=index/estimation"><i class="icon-pencil"></i> Draw Your Plans</a></li>
	                <li class="third-nav-item"><a href="#"><i class="icon-download"></i> Generate Quote</a></li>
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
	        
	    	$(function(){
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
        		var target = $('#ajax-loader');        		
        		var SpinnerObj = new Spinner(spinnerOpts).spin(target);
        		var overlayObj = new Object();
        		
        		$(document).ajaxStart(function(){
        			overlayObj = iosOverlay({
            			text: "Loading..",
            			spinner: SpinnerObj
            		});
            	});

        		$(document).ajaxSuccess(function(){
        			overlayObj.hide();
            	});

        		$(document).ajaxError(function(){
        			overlayObj.update({			
        				text: "Sorry!",
        				icon: baseUrl+"/plugins/iOs-Overlay/img/cross.png",
        			});
        			window.setTimeout(function() {
        				overlayObj.hide();
        			}, 1e3);
            	});
            	
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

	    		$('.second-nav-item, third-nav-item').on('click','a',function(e){
		    		e.preventDefault();
		    		notif({
					    msg: '<strong>Note:</strong> Please Select Your Fence Material First',
					    type: 'warning',
						bgcolor: "#004890",
					    position: "center"
					});
		    	});
				
				/* $('.third-nav-item').on('click','a',function(e){
		    		e.preventDefault();
		    		notif({
					    msg: '<strong>Note:</strong> Please Sign-Up or Login to Your Account',
					    type: 'warning',
						bgcolor: "#004890",
					    position: "center"
					});
		    	}); */
				
		    });
	    </script>
		<?php echo $content; ?>
		<!-- Footer -->
	    <div id="footer" class="row">
	        <div class="four columns left-align">
	            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Lowes.png" alt="Lowe's - Never Stop Improving" />
	        </div>
			<div class="four columns middle">
				<h4 class="powered-by">Powered by: <a href="http://fencesoft.com" target="_blank">FenceSoft<span>&reg;</span></a></h4>
			</div>
	        <div class="four columns right-align">
	            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Barrette.png" alt="Built by Barrette Outdoor Living" />
	        </div>
	    </div>
		<div id="copyright" class="row">
			<div class="twelve columns">
				<p>&copy; 2014 Barrette Outdoor Living. All rights reserved. | <a href="#">Terms &amp; Conditions</a></p>
			</div>
		</div>
		<div id="ajax-loader" class="hide"></div>
		
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kinetic-v4.7.4.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/additional-methods.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-paginator.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/featherlight/featherlight.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/notifIt/js/notifIt.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iOS-Overlay/js/iosOverlay.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iOS-Overlay/js/prettify.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iOS-Overlay/js/spin.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/image-picker/image-picker.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery.qtip.custom/jquery.qtip.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/gumby.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
		
		<!-- QTips2 Setup and Styling -->
		<script type="text/javascript">
			$('[title!=""]').qtip({style:{classes:'qtip-light'}, position:{at:'right center', my:'left center'}});
			$('#qtip-StoreInfo').qtip({id:'StoreInfo', content:{title:'Your Local Store Information', text:'The above is the Lowes store nearest to you based on your zip-code.  If you would like to change to a different store location, click on <a href="#">More Info</a> above.', button:true}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:1000, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'bottom center', my:'top center'}});
			$('#qtip-LoginBox').qtip({id:'LoginBox', content:{title:'Login or Sign-Up for New Account', text:'In order to generate a fence estimate you will need to signup for an account by providing basic customer details.<br />Please <a href="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=users/registration">Sign-Up / Login</a> now.', button:true}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:1000, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'bottom center', my:'top center'}});
			$('#dummy-set-1').qtip({id:'dummy-set-1', content:{title:'Choose Your Style of Fence', text:'Select a style of fence by filtering the results below based on your choices from the options above.'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'bottom center', my:'top center'}});
			$('#generic_search').qtip({id:'generic_search', content:{title:'Search for Materials', text:'Find fence materials based on keywords or key phrases (use spaces to separate keywords).'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'bottom center', my:'top center'}});
			$('#drawing_grid_length').qtip({id:'drawing_grid_length', content:{title:'Change Drawing Grid Scale', text:'Adjust the scale for the Drawing Grid by selecting the maximum distance necessary to draw your plan from the drop-down list above.'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'bottom center', my:'top center'}});
			$('#BuildingObject').qtip({id:'BuildingObject', content:{title:'Building | Structure', text:'Add a building or structure to your drawing by dragging and dropping the building icon above to the drawing grid below.<br /><br />Single-click the object on the drawing grid to adjust the object dimensions.  Double-click the object to remove.'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'bottom center', my:'top center'}});
			$('#DeckObject').qtip({id:'DeckObject', content:{title:'Deck | Patio', text:'Add a deck or patio to your drawing by dragging and dropping the deck icon above to the drawing grid below.<br /><br />Single-click the object on the drawing grid to adjust the object dimensions.  Double-click the object to remove.'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'bottom center', my:'top center'}});
			$('#TreeObject').qtip({id:'TreeObject', content:{title:'Tree | Bush', text:'Add a tree or bush to your drawing by dragging and dropping the tree icon above to the drawing grid below.<br /><br />Single-click the object on the drawing grid to adjust the object dimensions.  Double-click the object to remove.'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'bottom center', my:'top center'}});
			$('#PoolObject').qtip({id:'PoolObject', content:{title:'Pool | Fountain', text:'Add a pool or fountain to your drawing by dragging and dropping the pool icon above to the drawing grid below.<br /><br />Single-click the object on the drawing grid to adjust the object dimensions.  Double-click the object to remove.'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'bottom center', my:'top center'}});
			$('#GateObject').qtip({id:'GateObject', content:{title:'Apply Gate to Drawing', text:'Apply the currently selected gate by dragging and dropping the gate icon above to the drawing grid below and then attaching it to a length of fence by positioning it onto a line.<br /><br />You may reposition the gate by either double-clicking it and then moving it to a new position or by single-clicking the left/right point next to the gate as needed (this will adjust the gate position left or right in single-foot increments when clicked).'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'bottom center', my:'top center'}});
			$('#undo_btn').qtip({id:'undo_btn', content:{title:'Undo and Remove', text:'Remove the last created object(s) from the Drawing Grid.'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'bottom center', my:'top center'}});
			$('#GenerateQuote').qtip({id:'GenerateQuote', content:{title:'Create New Fence Estimate', text:'Click the Generate Quote button below to create a new estimate using the currently selected material and the drawing above.'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'top center', my:'bottom center'}});
			$('#SaveChanges').qtip({id:'SaveChanges', content:{title:'Save Changes to Estimate', text:'Click the Save Changes button below to save any changes or edits to your existing estimate.'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'top center', my:'bottom center'}});
			$('#ClearData').qtip({id:'ClearData', content:{title:'Clear the Drawing Grid', text:'Click the Clear Data button below to remove all of the objects and fence lines from the drawing grid.'}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:100, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'top center', my:'bottom center'}});
			$('#SignUpWidget').qtip({id:'SignUpWidget', content:{title:'Login or Sign-Up for New Account', text:'In order to generate a fence estimate you will need to signup for an account by providing basic customer details.<br /><br />Please fill in your information in the sign-up form and click the submit button.<br /><br />Already a registered user?  Login to your account by clicking the Login button.', button:true}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:1000, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'right center', my:'left center'}});
			$('#qtip-selected-img').qtip({id:'qtip-selected-img', content:{title:'Select Your Material Options', text:'Select your post-cap and gate options using the drop-downs to the left.<br /><br />If you want to change your material color/size or post-cap, simply select the corresponding option from the drop-down list and click Add Fence.<br /><br />When changing your currently selected gate or gate-latch options in the drop-down lists, be sure to click Apply Gate to use in your drawing.', button:true}, style:{classes:'qtip-bootstrap'}, show:{delay:1000, solo:true, effect:function(offset){$(this).fadeIn(500);}}, hide:{delay:1000, fixed:true, effect:function(offset){$(this).fadeOut(1000);}}, position:{at:'right center', my:'left center'}});
			$('#tool-qtip').qtip({
				id:'tool-tips',
				content:{title:'<strong>How to Design Your Fence Plan | Using the Drawing Tool</strong>', text:'Now that you have selected your material, you can begin to draw your fence plan.  Here you are provided a drawing tool interface which will allow you to draw lengths of fence and apply gates to your design. Start by selecting the post-cap and gate options for your design.<br /><br /><strong>Here are the steps to follow to complete your fence plan...</strong><br /><br />1. Set the scale of the drawing grid by choosing either 50ft, 100ft, 250ft or 500ft from the drop-down option in the toolbar.<br /><br />2. Draw your lengths of fence by double-clicking your mouse on the drawing grid at the starting point, then double-click again to release the line at the desired end-point.<br /><br />3. You may connect two lines with an intersecting corner post by dragging and dropping one point onto another.<br /><br />4. In order to add gates to your drawing, simply choose your gate from the gate drop-down to the left, then drag and drop the gate object icon to the drawing grid.<br /><br />5. Dragging and dropping other object icons from the toolbar (such as buildings, decks, trees and pools) allows you to apply these elements for reference in your plan.<br /><br />When you are completed with your drawing, make sure you have signed-up and are logged into your customer account, then click the Generate Quote button below.<br /><br /><strong>For further instructions, check out this quick <a href="#">video tutorial</a>.</strong><br /><br />', button:true},
				style:{classes:'qtip-bootstrap qtip-mods'},
				show:{solo:true, modal:{on:true}, event:'click', effect:function(offset){$(this).fadeIn(1000);}},
				hide:{effect:function(offset){$(this).fadeOut(1000);}},
				position:{at:'center', my:'center', target:$(document.body)},
				events:{render:function(event, api){var elem = api.elements.overlay;}}
			});
		</script>

	</body>
</html>