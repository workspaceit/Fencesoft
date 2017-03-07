<div class="select-box" id="normal-background">
    <h2 class="dummy-prompt">Need Help Finding What You Are Looking For?</h2>
    
    <form action="#" name="dummy_selector_form" id="dummy_selector_form">
        <input type="hidden" name="search_type" value="search_advance">        
        <div id="dummy-set-1" data-next-tab="dummy-set-1" data-next-tab-alt="dummy-set-1" class="dummy-set-block">
            <select name="assign_categories" class="image-picker show-labels show-html dummy-options">
                <option value=""></option>
                <option data-img-src="<?php echo Yii::app()->request->baseUrl; ?>/images/Privacy.png" value="Privacy">Privacy</option>
                <?php 
                if(!empty($categoryList)): 
                    foreach ($categoryList as $key=>$data):
                ?>
                <option data-img-src="<?php echo Yii::app()->request->baseUrl.'/images/'.$data.'.png'; ?>" value="<?php echo $data;?>"><?php echo $data;?></option>
                <?php endforeach; endif;?>
            </select>
        </div>
    </form>
    
</div>