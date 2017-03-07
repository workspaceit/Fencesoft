<div id="content" class="row">
	<div class="four columns">
		<div class="widget-box">
			<div id="selected-material" class="widget">
				<h5 class="widget-title">Selected Material</h5>
				<img class="selected-material" src="<?php echo Yii::app()->request->baseUrl; ?>/images/fence-normal.jpg" alt="Selected Material" title="Currently selected material..." />
				<ul class="float-left">
					<li class="field">
						<div class="picker">
							<select title="Choose a material to use in Drawing Grid...">
								<option value="">6ft White Vinyl Privacy</option>
								<option value=""selected>6ft White Vinyl Semi-Private</option>
							</select>
						</div>
					</li>
					<li class="field">
						<div class="medium btn info pretty icon-right icon-plus-circled widget-btn"><button name="add_material" title="Select a new material to use in Drawing Grid...">Add Fence<i class="icon-plus-circled"></i></button></div>
					</li>
				</ul>
				<ul class="float-left">
					<li class="field">
						<div class="picker">
							<select title="Choose a gate style to apply to Drawing Grid...">
								<option value="">4ft Arched Convex</option>
								<option value=""selected>8ft Arched Convex</option>
							</select>
						</div>
					</li>
					<li class="field">
						<div class="medium btn info pretty icon-right icon-plus-circled widget-btn"><button name="add_material" title="Add selected gate to Drawing Grid...">Apply Gate<i class="icon-plus-circled"></i></button></div>
					</li>
				</ul>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div class="widget-box">
			<div id="customer-details" class="widget">
				<h5 class="widget-title">Customer Details</h5>
				<form action="#" method="post">
					<ul>
						<li class="field">
							<input name="name-field" placeholder="Full Name" type="text" class="normal text" value="" />
							<input name="username" placeholder="User Name" type="text" class="normal text" value="" />
						</li>
						<li class="field">
							<input name="password" placeholder="Password" type="password" class="normal text" value="" />
							<input name="repassword" placeholder="Re-type Password" class="normal text" type="password" value="" />
						</li>
						<li class="append field"><input name="email" placeholder="Email" type="text" class="xwide email" value="" /><span class="adjoined">@</span></li>
						<li class="field"><input name="address" placeholder="Address" class="xwide text" type="text" value="" /></li>
						<li class="field">
							<input name="city" placeholder="City" class="normal text" type="text" value="" />
							<input name="state" placeholder="State" class="narrow text" type="text" value="" />
						</li>
						<li class="field">
							<input name="zip" placeholder="Zip" class="xnarrow text" type="text" value="" />
							<input name="phone" placeholder="Phone" class="narrow text" type="text" value="" />
						</li>
						<li class="field"><label class="checkbox checked" for="checkbox3"><input id="checkbox3" type="checkbox" checked="checked" name="checkbox3" /><span><i class="icon-check"></i></span>I Agree to the <a href="#">Terms of Use</a></label></li>
					</ul>
					<div class="small btn primary icon-right icon-user-add widget-btn"><button name="sign_up" type="submit" style="float:left;" title="Create a new customer account using the info above...">Sign-Up<i class="icon-user-add"></i></button></div>
					<div class="small btn info widget-btn"><a href="#" class="switch active" gumby-trigger="#login-fields" style="float:left;" title="Login to an existing user account...">Login<i class="icon-user"></i></a></div>
					<div id="login-fields" class="drawer">
						<hr />
						<h5 class="widget-title">User Login | <span class="forget-pass"><a href="#">Forget Password?</a></span></h5>
						<ul>
							<li class="field"><input name="username" placeholder="User Name" type="text" class="xwide text" value="" /></li>
							<li class="field append"><input name="password" placeholder="Password" type="password" class="normal text" value="" style="width:66%;" /><div class="medium primary btn"><a href="#" title="Enter your user info to login to your account...">Submit</a></div></li>
						</ul>
					</div>
				</form>
			</div>
		</div>
		<div class="widget-box">
			<div class="widget">
				<h5 class="widget-title">Recent Quotes</h5>
				<div class="scroll-box"></div>
				<div class="small btn info icon-right icon-export widget-btn"><button name="load_quote" title="Open a recent quote to edit...">Load Quote<i class="icon-export"></i></button></div>
			</div>
		</div>
	</div>
	<div class="eight columns">
		<div id="drawing-tool" class="widget-box widget">
			<div id="toolset">
				<ul class="float-left">
					<li><a href="#" title="House | Building" class="selected"><img class="toolset-ico" src="<?php echo Yii::app()->request->baseUrl; ?>/images/building-ico.png" alt="Building | Structure" /></a></li>
					<li><a href="#" title="Deck | Patio"><img class="toolset-ico" src="<?php echo Yii::app()->request->baseUrl; ?>/images/deck-ico.png" alt="Deck | Patio" /></a></li>
					<li><a href="#" title="Tree | Bush"><img class="toolset-ico" src="<?php echo Yii::app()->request->baseUrl; ?>/images/tree-ico.png" alt="Tree | Bush" /></a></li>
					<li><a href="#" title="Pool | Fountain"><img class="toolset-ico" src="<?php echo Yii::app()->request->baseUrl; ?>/images/pool-ico.png" alt="Pool | Fountain" /></a></li>
					<li><a href="#" title="Add selected gate to Drawing Grid..."><img class="toolset-ico" src="<?php echo Yii::app()->request->baseUrl; ?>/images/gate-ico.png" alt="Add selected gate to Drawing Grid..." /></a></li>
					<li class="field">
						<div class="picker">
							<select id="drawing_grid_length" name="drawing_grid_length" title="Change the scale for the Drawing Grid...">
								<option value="50">50ft</option>
								<option value="100"selected>100ft</option>
								<option value="250">250ft</option>
								<option value="500">500ft</option>
							</select>
						</div>
					</li>
					<li class="field">
						<div class="medium btn warning pretty icon-right icon-cancel-circled widget-btn"><button name="undo_last" title="Remove the last created object from Drawing Grid...">Undo<i class="icon-cancel-circled"></i></button></div>
					</li>
					<li class="clearfix hide" id="node-remove-content">
					    <div class="node-remove-content">
					        <button name="remove" class="btn warning pretty"><i class="icon-trash"></i></button>
					        <button name="close" class="btn default pretty">X</button>
					    </div>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div id="canvas-container"></div>			
			<div id="toolset-btns">
				<div class="medium btn primary pretty icon-right icon-cog widget-btn"><button name="generate_quote" title="Generate a new estimate from plan...">Generate Quote<i class="icon-cog"></i></button></div>
				<div class="medium btn info pretty icon-right icon-folder widget-btn"><button name="save_quote" title="Save the current plan...">Save Changes<i class="icon-folder"></i></button></div>
				<div class="medium btn warning pretty icon-right icon-trash widget-btn"><button name="clear_data" title="Clear the Drawing Grid above...">Clear Data<i class="icon-trash"></i></button></div>
			</div>
		</div>
	</div>
</div>