<?php
$serverAddress = ($_SERVER['SERVER_ADDR']=='127.0.0.1') ? 'localhost' :$_SERVER['SERVER_ADDR'];

$featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/placeholder_blank.png';
if(!empty($selectedMaterial)){
    if(!empty($selectedMaterial['featured_image'])){
        $featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/materials/'.$selectedMaterial['featured_image'];
    } else if(!empty($selectedMaterial['product_image'])){
        $productImage = explode(',', $selectedMaterial['product_image']);
        $featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/materials/'.$productImage[0];        
    }
}
?>

<div id="content" class="row">
	<div class="four columns">
		<div class="widget-box">
			<div id="selected-material" class="widget">
				<h5 class="widget-title">Selected Material</h5>
				<img id="qtip-selected-img" class="selected-material" src="<?php echo $featuredImage; ?>" alt="Selected Material" />
				<ul class="float-left">
					<li class="field">
						<div class="picker full_w">
							<select name="material_id">
							<?php if(!empty($materialGroups)):?>
							<?php foreach ($materialGroups as $data):
							$selected = '';
							if(isset($_GET['fence_type']) && isset($_GET['fence_id'])):
							    if((strtolower($data['type_of_fence'])==strtolower($_GET['fence_type'])) && ($data['id']==$_GET['fence_id'])){ ?>
						          <option value="<?php echo $data['id'];?>" data-fence-type="<?php echo $data['type_of_fence'];?>" selected="selected">
							        <?php echo $data['system_name'];?>
						          </option>  
							<?php 
							    continue; }							    
							endif;
							?>
							    <option value="<?php echo $data['id'];?>" data-fence-type="<?php echo $data['type_of_fence'];?>" <?php echo $selected;?>>
							        <?php echo $data['system_name'];?>
							    </option>
							<?php endforeach;?>
							<?php else:
							if(!empty($selectedMaterial)):
							?>
							<option value="<?php echo $selectedMaterial['id'];?>" data-fence-type="<?php echo $_GET['fence_type'];?>" selected="selected">
						        <?php echo $selectedMaterial['system_name'];?>
						    </option>
							<?php endif; endif;?>								
							</select>
						</div>
					</li>
				</ul>
				<ul class="float-left">
					<li class="field">
						<div class="picker">
							<select name="postcap_id">
							    <?php if(!empty($materialPostCaps)):?>
    							<?php foreach ($materialPostCaps as $data):?>
    							    <option value="<?php echo $data['id'];?>">
    							        <?php echo $data['post_cap_style'];?>
    							    </option>
    							<?php endforeach;?>
    							<?php endif;?>
							</select>
						</div>
					</li>
					<li class="field add_btn">
						<div class="medium btn info pretty icon-right icon-plus-circled widget-btn">
						    <button name="add_material" title="Apply your material changes to drawing">Add Fence<i class="icon-plus-circled"></i></button>
					    </div>
					</li>
				</ul>
				<ul class="float-left">
					<li class="field">
						<div class="picker full_w">
							<select name="gate_id">
								<?php if(!empty($materialGates)):?>
    							<?php foreach ($materialGates as $data):?>
    							    <option value="<?php echo $data['id'];?>" data-gate-type="<?php echo $data['gate_type'];?>"  data-width="<?php echo $data['width'];?>">
    							        <?php echo $data['description'];?>
    							    </option>
    							<?php endforeach;?>
    							<?php endif;?>
							</select>
						</div>
					</li>
				</ul>
				<ul class="float-left">
					<li class="field">
						<div class="picker">
							<select name="gate_latch_option_id">
							    <?php if(!empty($materialGatesLatch)):?>
    							<?php foreach ($materialGatesLatch as $data):?>
    							    <option value="<?php echo $data['id'];?>">
    							        <?php echo $data['latch_option'];?>
    							    </option>
    							<?php endforeach;?>
    							<?php endif;?>
							</select>
						</div>
					</li>
					<li class="field add_btn">
						<div class="medium btn info pretty icon-right icon-plus-circled widget-btn">
						    <button name="add_gate" title="Apply your gate changes in toolbar">Apply Gate<i class="icon-plus-circled"></i></button>
						</div>
					</li>
				</ul>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div class="widget-box">
			<div id="customer-details" class="widget">
				<h5 class="widget-title">Customer Details</h5>
				<?php if(Yii::app()->session['isLogin']):?>
				<ul class="user-logged-in">
					<li class="field">
					    Name: <?php echo Yii::app()->session['profile']['full_name'];?>	
					</li>
					<li class="field">
					    Email: <?php echo Yii::app()->session['profile']['email'];?>	
					</li>
					<li class="field">
					    Address: <?php echo Yii::app()->session['profile']['address'];?>, <?php echo Yii::app()->session['profile']['city'];?>, <?php echo Yii::app()->session['profile']['state'];?> <?php echo Yii::app()->session['profile']['zip_code'];?>
					</li>
				</ul>
				<?php else:?>
				<form name="signup-form" id="signup-form" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=users/registration" method="post">
                        <ul id="SignUpWidget">
                            <li class="field">
                                <input name="Users[full_name]" id="full_name" placeholder="Full Name" required="required" type="text" class="xwide text" value="" />
                            </li>
                            <li class="field">
                                <input name="Users[login_name]" id="login_name" placeholder="User Name" required="required" type="text" class="normal text" value="" />
                                <input name="Users[password]" id="password" placeholder="Password" required="required" type="password" class="normal text" value="" />
                            </li>
                            <li class="append field"><input name="Users[user_email]" id="user_email" placeholder="Email" required="required" type="text" class="xwide email" value="" /><span class="adjoined">@</span></li>
                            <li class="field"><input name="Users[address]" id="address" placeholder="Address" required="required" class="xwide text" type="text" value="" /></li>
                            <li class="field">
                                <input name="Users[city]" placeholder="City" id="city" required="required" class="normal text" type="text" value="" />
                                <input name="Users[state]" placeholder="State" id="state" required="required" class="narrow text" type="text" value="" />
                            </li>
                            <li class="field">
                                <input name="Users[zip_code]" placeholder="Zip" id="zip" required="required" class="xnarrow text" type="text" value="" />
                                <input name="Users[phone]" placeholder="Phone" id="phone" required="required" class="narrow text" type="text" value="" />
                            </li>
                            <li class="field"><span style="font-size:12px;"><label class="checkbox checked" for="checkbox3"><input id="checkbox3" type="checkbox" checked="checked" name="checkbox3" /></label><span><i class="icon-check terms-check"></i></span>I Agree to the <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=index/termsAndConditions" target="_blank">Terms of Use</a></span></li>
                        </ul>
                        <div class="small btn primary icon-right icon-user-add widget-btn"><button name="sign_up" id="signupSubmit" type="submit" style="float:left;">Sign-Up<i class="icon-user-add"></i></button></div>
                        <div class="small btn info widget-btn"><a id="loginToggle" href="#" class="switch active" gumby-trigger="#login-fields" style="float:left;">Login<i class="icon-user"></i></a></div>
                    </form>					
					
				 <form name="login-form" id="login-form" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=users/login" method="post">
                        <div id="login-fields" class="drawer">
                            <hr />
                            <h5 class="widget-title">User Login | <span class="forget-pass"><a href="#" id="forgetPass" >Forget Password?</a></span></h5>
                            <ul id="LoginWidget">
                                <li class="field"><input name="LoginForm[username]" placeholder="User Name" required="required" type="text" class="xwide text" value="" /></li>
                                <li class="field append"><input name="LoginForm[password]" placeholder="Password" required="required" type="password" class="normal text" value="" style="width:66%;" />
                                    <div class="medium primary btn"><button id="loginSubmit" type="submit">Submit</button></div></li>
                            </ul>
                        </div>
                    </form>
				<?php endif;?>
			</div>
		</div>
		<?php if(Yii::app()->session['isLogin']):?>
		<div class="widget-box">
			<div class="widget">
				<h5 class="widget-title">Recent Quotes</h5>
				<div id="quotesList" class="scroll-box"></div>
				<div class="small btn info icon-right icon-export widget-btn"><button name="load_quote">Load Quote<i class="icon-export"></i></button></div>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<div class="eight columns">
		<div id="drawing-tool" class="widget-box widget">
			<div id="toolset">
				<ul class="float-left">
					<li><a href="#" id="BuildingObject" title="House | Building" class="fence-structure" data-type="house"><img class="toolset-ico" src="<?php echo Yii::app()->request->baseUrl; ?>/images/building-ico.png" alt="Building | Structure" /></a></li>
					<li><a href="#" id="DeckObject" title="Deck | Patio" class="fence-structure" data-type="deck"><img class="toolset-ico" src="<?php echo Yii::app()->request->baseUrl; ?>/images/deck-ico.png" alt="Deck | Patio" /></a></li>
					<li><a href="#" id="TreeObject" title="Tree | Bush" class="fence-structure" data-type="tree"><img class="toolset-ico" src="<?php echo Yii::app()->request->baseUrl; ?>/images/tree-ico.png" alt="Tree | Bush" /></a></li>
					<li><a href="#" id="PoolObject" title="Pool | Fountain" class="fence-structure" data-type="pool"><img class="toolset-ico" src="<?php echo Yii::app()->request->baseUrl; ?>/images/pool-ico.png" alt="Pool | Fountain" /></a></li>
					<li><a href="#" id="GateObject" title="Add selected gate to Drawing Grid" class="fence-gate" data-gate-id="0" data-gate-width="4" data-gate-type="single"><img class="toolset-ico" src="<?php echo Yii::app()->request->baseUrl; ?>/images/gate-ico.png" alt="Add selected gate to Drawing Grid..." /></a></li>
					<li class="field">
						<div class="picker">
							<select id="drawing_grid_length" name="drawing_grid_length">
								<option value="50">50ft</option>
								<option value="100"selected>100ft</option>
								<option value="250">250ft</option>
								<option value="500">500ft</option>
							</select>
						</div>
					</li>
					<li class="field">
						<div class="medium btn warning pretty icon-right icon-cancel-circled widget-btn"><button name="undo_last" id="undo_btn">Undo<i class="icon-cancel-circled"></i></button></div>
					</li>
					<li class="clearfix hide" id="node-remove-content">
					    <div class="node-remove-content">
					        <button name="remove" class="btn warning pretty"><i class="icon-trash"></i></button>
					        <button name="close" class="btn default pretty">X</button>
					    </div>
					</li>
					<li title="Click to view instructions"><i id="tool-qtip" class="icon-help-circled"></i></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div id="canvas-container"></div>			
			<div id="toolset-btns">
				<div style="float:left;" class="medium btn primary pretty icon-right icon-cog widget-btn"><button id="GenerateQuote" name="generate_quote">Generate Quote<i class="icon-cog"></i></button></div>
				<div style="float:left;" class="medium btn info pretty icon-right icon-folder widget-btn"><button id="SaveChanges" name="save_quote">Save Changes<i class="icon-folder"></i></button></div>
				<div style="float:left;" class="medium btn warning pretty icon-right icon-trash widget-btn"><button id="ClearData" name="clear_data">Clear Data<i class="icon-trash"></i></button></div>
                
                 <div style="float:left; width:120px; margin:20px 0 0 10px;">
                    <label>
                       <input style="padding:4px;" name="activefence" value="Fence Removal" type="checkbox" id="activefence" /> Fence Removal:
                   </label>
                </div>
                <div style="float:left; margin:15px 10px 0 0;">
                    <dd>
                            <select style="border-radius:3px 3px 3px 3px; border:1px solid #ccc; padding:4px 0; width:100px; font-size:13px; line-height:18px;" id="material_type" class="select2" title="Type of fence to be removed" disabled="disabled">
                            <option></option>
                            <option value="aluminum" data-removal="<?php echo $storeData['removal_aluminum'];?>" <?php if($quotesInfo){if($quotesInfo['removal_fence']=='aluminum'){ ?>selected="selected"<?php } }?>>Aluminum</option>
                            <option value="chainlink" data-removal="<?php echo $storeData['removal_chainlink'];?>" <?php if($quotesInfo){if($quotesInfo['removal_fence']=='chainlink'){ ?>selected="selected"<?php } }?>>Chainlink</option>
                            <option value="vinyl" data-removal="<?php echo $storeData['removal_vinyl'];?>" <?php if($quotesInfo){if($quotesInfo['removal_fence']=='vinyl'){ ?>selected="selected"<?php } }?>>Vinyl</option>
                            <option value="wood" data-removal="<?php echo $storeData['removal_wood'];?>" <?php if($quotesInfo){if($quotesInfo['removal_fence']=='wood'){ ?>selected="selected"<?php } }?>>Wood</option>	
                            </select>
                    </dd>
                </div>

                <div style="float:left; margin:15px 0 0 0;">
                    <dd>
                          <input title="Amount to be removed (ft)" id="feetRemoval" style="width:50px;" type="text" value="<?php if($quotesInfo){echo $quotesInfo->feet_removal; }?>" class="form-control" disabled="disabled"/>
                    </dd>
                </div>
			</div>
            <input type="hidden" id="notestext" value="<?php if($quotesInfo->notes){ echo $quotesInfo->notes; }?>" />
            <div class="col-md-10"><textarea rows="4" name="notes" id="notes" class="form-control wysiwyg" style="width:100%; margin:10px 0 5px 0;" placeholder="Install Notes..."></textarea></div>
            </div>
			<div class="hide">
			    <form id="pdf_generate_form" method="post" name="pdf_generate_form" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=index/generateQuotes">
			        <input type="hidden" name="quotes_id" value="<?php echo (isset($_GET['quote_id'])) ? $_GET['quote_id'] : "";?>">
			        <input type="hidden" name="quotes_material_id" value="<?php echo (isset($_GET['fence_id'])) ? $_GET['fence_id'] : "";?>">
			        <input type="hidden" name="quotes_material_type" value="<?php echo (isset($_GET['fence_type'])) ? $_GET['fence_type'] : "";?>">
			        <input type="hidden" name="quotes_image" value="">
			        <input type="hidden" name="quotes_data" value="">
			        <input type="hidden" name="quotes_post_cap_id" value="">
			        <input type="hidden" name="quotes_gate_latch_option_id" value="">
			        <input type="hidden" name="quotes_corner_post" value="">
			        <input type="hidden" name="quotes_end_post" value="">
			        <input type="hidden" name="quotes_blank_post" value="">
			        <input type="hidden" name="quotes_total_length" value="">
			        <input type="hidden" name="quotes_end_pos_gate" value="">
			        <div id="quotes_gate_details"></div>
			    </form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('#activefence').click(function(){
    if (this.checked) {
            $('#material_type').prop("disabled",false);  
            $('#feetRemoval').prop("disabled",false);
 //            $('#notes').prop("disabled",false);
             if($('#notestext').val()){
                  $('#notes').val($('#notestext').val());
             }else{
                 $('#notes').attr("placeholder","This is a test");
             }
             
            
            
        }else{
             $('#material_type').prop("disabled",true); 
             $('#feetRemoval').prop("disabled",true);
  //           $('#notes').prop("disabled",true);
        }
        
    });
_QuotesData = '<?php echo (!empty($quotesInfo)) ? $quotesInfo['quotes_data'] : "";?>';
_isDrawing = false;
$(function(){
	var setGateInfo = function(){
		var gateWidth = $('select[name=gate_id] option:selected').attr('data-width');
		var gateType = $('select[name=gate_id] option:selected').attr('data-gate-type');
		var gateID = $('select[name=gate_id] option:selected').val();
		
		$('.fence-gate').attr('data-gate-width',gateWidth)
		                .attr('data-gate-type',gateType)
		                .attr('data-gate-id',gateID);
	};

	var setMaterials = function(){
		var fence_id = $('select[name=material_id]').val();
		var fence_type = $('select[name=material_id] option:selected').attr('data-fence-type');
		 setDrawingInSession(function() {
                window.location.href = baseUrl + '/index.php?r=index/estimation&fence_type=' + fence_type + '&fence_id=' + fence_id;
            });
	};

	var getUserQuotes = function() {
		$.ajax({
			url : baseUrl+'/index.php?r=index/getUserQuotes',
			success : function(e){
				if(e.length){
					$('#quotesList').html("").html(e);
				}
			}
		});
	};
	<?php if(Yii::app()->session['isLogin']):?>
	getUserQuotes();
	<?php endif; ?>
	setGateInfo();
	
	$('button[name=add_gate]').on('click',function(){
		setGateInfo();
	});
	
	$('button[name=add_material]').on('click',function(){
		setMaterials();
	});
	
	$('button[name=generate_quote]').on('click',function(){
		
		var graph = stage.find('#graph-group');
		var canvasLayer = stage.find('#mainLayer')[0];

		var corner_post = 0, end_post = 0,blank_post = 0,end_pos_gate = 0,
	        total_gate_lenght = 0,total_line_length = "", 
	        gates = new Array();
        
		var drawingPoints = canvasLayer.find('.circle');
		var drawingGates = canvasLayer.find('.dropGate');
		var drawingLines = canvasLayer.find('.fence-line');
		var gateEndPoints = canvasLayer.find('.gate_end_point');

		var canvasLength = (stage.getWidth() > 500 ) ? 500 : stage.getWidth();
        var drawingLength = $('#drawing_grid_length').val();
        var lengthRatio = canvasLength / drawingLength;
		
		/* find end post and corner post*/
		$.map(drawingPoints,function(e,i){
			var lines = e.getAttr('lines');
			var isEnd = 0;
			for(var i = 0; i < gateEndPoints.length; i++){
				var distance = calculateLineDistance(e.getX(),e.getY(),gateEndPoints[i].getX(),gateEndPoints[i].getY());
	    		if(Math.round(distance/lengthRatio) == 0) {
	    			isEnd = 1;
                    end_pos_gate++;
                    break;
	    		}
			}
						
			if(lines.length > 1){
				if(!isEnd){
					corner_post++;
				}
			} else if(lines.length==1) {
				if(isEnd){
					blank_post++;
					end_post--;
				}else {				
				    end_post++;
				}
			}		    
		});
		
		/*find gate information*/
		$.map(drawingGates,function(e,i){
			var check = true;
			var gateInfo = e.getAttr('gateInfo');
			if(gates.length > 0 ){
				for(var i = 0; i < gates.length; i++){
					if(gates[i].id==gateInfo.gate_id) {
						total_gate_lenght += parseInt(gateInfo.gate_width);
						gates[i].value++;
						check = true;
						break;
					} else {
						check = false;
					}
				}

				if(check==false) {
					total_gate_lenght += parseInt(gateInfo.gate_width);
					gates.push({'id':gateInfo.gate_id, 'value':1});
				}
			} else {
				total_gate_lenght += parseInt(gateInfo.gate_width);
				gates.push({'id':gateInfo.gate_id, 'value':1});
			}
		});

		$('#quotes_gate_details').html("");
		$.map(gates,function(e,i){
			var htmlInputTag = '<input type="hidden" name="gate_id[]" value="'+e.id+'" >';
		        htmlInputTag += '<input type="hidden" name="total_gate['+e.id+']" value="'+e.value+'" >';
		    $('#quotes_gate_details').append(htmlInputTag);
		});

		/*get total length in string*/
		$.map(drawingLines,function(e,i){
			total_line_length += getLineLength(e); 			
		});	
		
		graph.hide();
		stage.toDataURL({
		    callback: function(dataUrl) {			    
		    	var fence_id = $('select[name=material_id]').val();
				var fence_type = $('select[name=material_id] option:selected').attr('data-fence-type');
				var postcap_id = $('select[name=postcap_id] option:selected').val();
				var gatelatchoption_id = $('select[name=gate_latch_option_id] option:selected').val();

				$('input[name=quotes_material_id]').val(fence_id);
				$('input[name=quotes_material_type]').val(fence_type);
				$('input[name=quotes_image]').val(dataUrl);
				$('input[name=quotes_post_cap_id]').val(postcap_id);
				$('input[name=quotes_gate_latch_option_id]').val(gatelatchoption_id);
				$('input[name=quotes_corner_post]').val(corner_post);
				$('input[name=quotes_end_post]').val(end_post);
				$('input[name=quotes_blank_post]').val(blank_post);
				$('input[name=quotes_total_length]').val(total_line_length);
				$('input[name=quotes_end_pos_gate]').val(end_pos_gate);

				if(isLogin=='TRUE'){
					saveQuote(function(e){
						if(e.type=='success'){
							$('form#pdf_generate_form').submit();
                            getUserQuotes();
						} else {
							notif({
							    msg: '<strong>Error:</strong> Oops, we were unable to save the estimate',
							    type: 'error',
							    position: "center"
							});
						}
					});				    
				} else {
					notif({
					    msg: '<strong>Warning:</strong> Please sign-up or login to your account',
					    type: 'error',
					    position: "center"
					});
				}
            }
        });
		graph.show();
	});

	var saveQuote = function(callback){
		var fence_id = $('select[name=material_id]').val();
		var fence_type = $('select[name=material_id] option:selected').attr('data-fence-type');
		var postcap_id = $('select[name=postcap_id] option:selected').val();
		var gatelatchoption_id = $('select[name=gate_latch_option_id] option:selected').val();
        var material = $("#material_type").val();
        var removal = $("#feetRemoval").val();
        var notes = $("#notes").val();
		stage.setAttr('gridScale',$('#drawing_grid_length').val());
		var canvasData = stage.toJSON();

		var sendData = {
				quotes_id : $('input[name=quotes_id]').val(),
				material_id : fence_id, 
				material_type : fence_type,
				postcap_id : postcap_id,
				gatelatchoption_id : gatelatchoption_id,
				quotes_data : canvasData,
                fence_removal : material,
                feetRemoval : removal,
                addNotes : notes
			};
		 
		$.ajax({
			url : baseUrl+'/index.php?r=index/saveQuotes',
			type : 'POST',
			data : sendData,
			success : function(e){
				e = $.parseJSON(e);
				if(e.type=='success'){
					$('input[name=quotes_id]').val(e.id);
				}
				notif({
				    msg: e.message,
				    type: e.type,
				    position: "right"
				});
				callback(e);
			}
		});
	};
	
	$('button[name=save_quote]').on('click',function(){
		var fence_id = $('select[name=material_id]').val();
		var fence_type = $('select[name=material_id] option:selected').attr('data-fence-type');
		var postcap_id = $('select[name=postcap_id] option:selected').val();
		var gatelatchoption_id = $('select[name=gate_latch_option_id] option:selected').val();
        var material = $("#material_type").val();
        var removal = $("#feetRemoval").val();
        var notes = $("#notes").val();
		stage.setAttr('gridScale',$('#drawing_grid_length').val());
		var canvasData = stage.toJSON();

		var sendData = {
				quotes_id : $('input[name=quotes_id]').val(),
				material_id : fence_id, 
				material_type : fence_type,
				postcap_id : postcap_id,
				gatelatchoption_id : gatelatchoption_id,
				quotes_data : canvasData,
                fence_removal : material,
                feetRemoval : removal,
                addNotes : notes
			};
		 
		$.ajax({
			url : baseUrl+'/index.php?r=index/saveQuotes',
			type : 'POST',
			data : sendData,
			success : function(e){
				e = $.parseJSON(e);
				if(e.type=='success'){
					$('input[name=quotes_id]').val(e.id);
				}
				notif({
				    msg: e.message,
				    type: e.type,
				    position: "right"
				});			
			}
		});
		
	});

	$('button[name=clear_data]').on('click',function(){
    $.ajax({
            url: baseUrl + '/index.php?r=index/destroy',
            type: 'POST',
            data: '',
            success: function(e) {
                //callback();
            }
      });
		clearCanvas();
	});

	var getLineLength = function(lineObj){
		var canvasLength = (stage.getWidth() > 500 ) ? 500 : stage.getWidth();
        var drawingLength = $('#drawing_grid_length').val();
        var lengthRatio = canvasLength / drawingLength;
        var lineLenghtStr = "";
		var pointsArr = new Array();
    	pointsArr.push({x:lineObj.getPoints()[0].x, y:lineObj.getPoints()[0].y});
    	pointsArr.push({x:lineObj.getPoints()[1].x, y:lineObj.getPoints()[1].y});
    	
    	for(var i = 0; i < lineObj.getAttr('gateIdList').length; i++){    		
    		var gateObj = stage.find('#'+lineObj.getAttr('gateIdList')[i])[0];
    		
    		if(!$.isEmptyObject(gateObj)){    			
    			pointsArr.push({x:gateObj.getPoints()[0].x, y:gateObj.getPoints()[0].y});
    			pointsArr.push({x:gateObj.getPoints()[1].x, y:gateObj.getPoints()[1].y});
    		} 
    	}
    	
    	if(lineObj.getPoints()[0].x == lineObj.getPoints()[1].x){
    		pointsArr.sort(function(a,b){
        		return a.y - b.y;
        	});
    	} else {
    		pointsArr.sort(function(a,b){
    			return a.x - b.x;
        	});
    	}
    	
    	for(var i = 0; i < pointsArr.length-1; i= i+2){
    		var distance = calculateLineDistance(pointsArr[i].x,pointsArr[i].y,pointsArr[i+1].x,pointsArr[i+1].y);
    		if(Math.round(distance/lengthRatio) > 0) {
    		    lineLenghtStr += ","+Math.round(distance/lengthRatio);
    		}    		
    	}

    	return lineLenghtStr;
	};
         var setDrawingInSession = function(callback) {
            var queries = {};
            $.each(document.location.search.substr(1).split('&'), function(c, q) {
                var i = q.split('=');
                queries[i[0].toString()] = i[1].toString();
            });

            if (queries.hasOwnProperty('fence_id')) {
                //if (_isDrawing) {
                    stage.setAttr('gridScale', $('#drawing_grid_length').val());
                    queries['quotes_data'] = stage.toJSON();
                //}
                $.ajax({
                    url: baseUrl + '/index.php?r=index/setSessionWithoutLogin',
                    type: 'POST',
                    data: queries,
                    success: function(e) {
                        callback();
                    }
                });
            } else {
                callback();
            }
        };
        $('#loginSubmit').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var form = $this.parents('form');

            var validator = $("#login-form").validate();
            if (validator.form()) {
                setDrawingInSession(function() {
                    form.submit();
                });
            }

        });
        $('#signupSubmit').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var form = $this.parents('form');

            var validator = $("#signup-form").validate();
            if (validator.form()) {
                $.ajax({
                    url: baseUrl + '/index.php?r=index/checkUserByEmailAndUsername',
                    type: 'POST',
                    data: {email: $('#user_email').val(), username: $('#login_name').val()},
                    success: function(e) {
                        e = $.parseJSON(e);
                        if (e.email == "1" || e.username == "1") {
                            if (e.email == "1") {
                                $('#user_email').addClass('error').val("").attr('placeholder', 'Email already taken');
                            }
                            if (e.username == "1") {
                                $('#login_name').addClass('error').val("").attr('placeholder', 'Username already taken');
                            }
                        } else {
                            setDrawingInSession(function() {
                                form.submit();
                            });
                        }
                    }
                });
            }

        });

	
        $("#qtip-LoginBox").on('click', function(e) {
            e.preventDefault();
            $this = $(this);
            setDrawingInSession(function() {
                window.location = $this.attr('href');
            });
        });
		
		$("#qtip-Home").on('click', function(e) {
            e.preventDefault();
            $this = $(this);
            setDrawingInSession(function() {
                window.location = $this.attr('href');
            });
        });
        
        $("#qtip-materialSection").on('click', function(e) {
            e.preventDefault();
            $this = $(this);
            setDrawingInSession(function() {
                window.location = $this.attr('href');
            });
        });

        
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
    					    msg: '<strong>Success:</strong> '+resp.message,
    					    type: 'success',
    					    position: "center",
    					    time : 5000
    					});
                        
                    } else {
                    	notif({
    					    msg: '<strong>Warning:</strong> '+resp.message,
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
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/canvas-draw.js"></script>