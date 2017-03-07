<div class="select-box" id="normal-background">
    <h2 class="dummy-prompt">Need Help Finding What You Are Looking For?</h2>
    
    <form action="#" name="dummy_selector_form" id="dummy_selector_form">
        <input type="hidden" name="search_type" value="search_advance">        
        <div id="dummy-set-1" data-next-tab="dummy-set-2" data-next-tab-alt="dummy-set-4" class="dummy-set-block">
            <select name="assign_categories" class="image-picker show-labels show-html dummy-options">
                <option value="" selected="selected"></option>
				<option data-img-src="" value="blank"></option>
                <option data-img-src="<?php echo Yii::app()->request->baseUrl; ?>/images/Privacy.jpg" value="Privacy" name="Privacy">Privacy</option>
                <?php 
                if(!empty($categoryList)): 
                    foreach ($categoryList as $key=>$data):
                ?>
                <option data-img-src="<?php echo Yii::app()->request->baseUrl.'/images/'.$data.'.jpg'; ?>" value="<?php echo $data;?>"><?php echo $data;?></option>
				<option data-img-src="" value="blank"></option>
                <?php endforeach; endif;?>
            </select>
        </div>

        <!-- Display ONLY IF Privacy is selected-->
        <div id="dummy-set-4" data-next-tab="dummy-set-3" data-next-tab-alt="dummy-set-1" class="dummy-set-block hide">
			<select name="type[]" class="image-picker show-labels show-html dummy-options">
				<option value="" selected="selected"></option>
				<option data-img-src="" value="blank"></option>
				<option data-img-src="<?php echo Yii::app()->request->baseUrl; ?>/images/Vinyl.jpg" value="VinylFences">Vinyl</option>
				<option data-img-src="<?php echo Yii::app()->request->baseUrl; ?>/images/Wood.jpg" value="WoodFences">Wood</option>
				<option data-img-src="" value="blank"></option>
			</select>
        </div>
		
        <!-- Show ONLY IF Decorative is selected -->
        <div id="dummy-set-2" data-next-tab="dummy-set-3" data-next-tab-alt="dummy-set-1" class="dummy-set-block hide">
            <select name="type[]" class="image-picker show-labels show-html dummy-options">
                <option value="" selected="selected"></option>
				<option data-img-src="" value="blank"></option>
                <option data-img-src="<?php echo Yii::app()->request->baseUrl; ?>/images/Aluminum.jpg" value="AluminumFences">Aluminum</option>
                <option data-img-src="<?php echo Yii::app()->request->baseUrl; ?>/images/Vinyl.jpg" value="VinylFences">Vinyl</option>
                <option data-img-src="<?php echo Yii::app()->request->baseUrl; ?>/images/Wood.jpg" value="WoodFences">Wood</option>
            </select>
        </div>
        
        <!-- Do Not show this if Wood is selected -->
        <div id="dummy-set-3" data-next-tab="dummy-set-1" class="dummy-set-block hide">
            <select name="section_mount" class="image-picker show-labels show-html dummy-options">
                <option value="" selected="selected"></option>
				<option data-img-src="" value="blank"></option>
                <option data-img-src="<?php echo Yii::app()->request->baseUrl; ?>/images/Bracketed.jpg" value="Brackets">Bracketed</option>                
                <option data-img-src="<?php echo Yii::app()->request->baseUrl; ?>/images/Pro.jpg" value="Rails inserted">Pro Solution</option>
				<option data-img-src="" value="blank"></option>				
            </select>
        </div>
    </form>
    
</div>