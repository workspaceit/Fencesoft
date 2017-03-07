<?php
$serverAddress = ($_SERVER['SERVER_ADDR']=='127.0.0.1') ? 'localhost' :$_SERVER['SERVER_ADDR'];

$featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/placeholder_blank.png';
$fImageName = 'placeholder_blank.png';
if(!empty($selectedMaterial)){
    if(!empty($selectedMaterial['featured_image'])){
        $fImageName = $selectedMaterial['featured_image'];
        $featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/materials/'.$selectedMaterial['featured_image'];
    } else if(!empty($selectedMaterial['product_image'])){
        $productImage = explode(',', $selectedMaterial['product_image']);
        $fImageName = $productImage[0];
        $featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/materials/'.$productImage[0];        
    }

?>
<div>
    <div class="row">
        <div class="twelve columns">
            <h2><?php echo $selectedMaterial['system_name'];?></h2>
        </div>
    </div>

    <div class="row">
        <div class="eight columns">
            <img class="photo image" alt="" src="<?php echo $featuredImage; ?>" />
            <?php if(!empty($selectedMaterial['product_image'])):
                $productImage = explode(',', $selectedMaterial['product_image']);
                if(!empty($productImage) && (count($productImage) > 0)):
            ?>
        </div>
        <div class="four columns">
            <?php if(!empty($selectedMaterial['description'])):?>
            <p style="font-size:14px;"><?php echo $selectedMaterial['description']; ?></p>
	        <?php endif;?>
        </div>
    </div>

    <div class="row">
        <div class="twelve columns">
            <ul class="three_up tiles">
            <?php foreach ($productImage as $key=>$data):if($fImageName==$data) continue;?>
                <li class="silo-img">
                    <img alt="" src="<?php echo 'http://'.$serverAddress.'/fencesoft-admin/uploads/materials/'.$data; ?>" />
                </li>
            <?php endforeach;?>
            </ul>
            <?php 
                endif;
                endif;
            ?>
        </div>
    </div>
	
    <div class="row">
        <div class="twelve columns">
         <?php if(!empty($selectedMaterial['product_document'])):
            $productDoc = explode(',', $selectedMaterial['product_document']);
            if(!empty($productImage)):
        ?>
        <h3>Material Documents</h3>
        <ul>
        <?php foreach ($productDoc as $key=>$data):?>
            <li>
                <a href="<?php echo 'http://'.$serverAddress.'/fencesoft-admin/uploads/materials/'.$data; ?>" target="_blank"><?php echo $data;?></a>
            </li>
        <?php endforeach;?>
        </ul>
        <?php 
            endif;
         endif;
         ?>
        </div>
    </div>
    
    <?php 
    if($selectedMaterial['is_blank']):
        if(!empty($materialGroups)):
    ?>
    <div class="row">
        <div class="twelve columns">
		<h3>Select Your Material, Choose the Size and Color Option Below...</h3>
            <ul class="three_up tiles">
            <?php 
                foreach ($materialGroups as $key=>$data):
            ?>
                <li class="silo-img">
            	    <?php
                    if(!empty($data['featured_image'])){
                        $featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/materials/'.$data['featured_image'];
                    }else {            
                        if(!empty($data['product_image'])){
                            $productImage = explode(',', $data['product_image']);
                            $featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/materials/'.$productImage[0];
                        }else {
                            $featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/placeholder_blank.png';
                        }
                    }
            	    ?>
            		<a class="click-sub-material" href="<?php  echo Yii::app()->request->baseUrl.'/index.php?r=index/estimation&fence_type=Chainlink&fence_id='.$data['id']; ?>" title="Click to select this material"><img src="<?php  echo $featuredImage; ?>" alt="" /></a>
                	<h5>
                	    <a class="click-sub-material" href="<?php  echo Yii::app()->request->baseUrl.'/index.php?r=index/estimation&fence_type=Chainlink&fence_id='.$data['id']; ?>" title="Click to select this material">
                	        <?php
                	        $len = count($data['system_name']);
                	        if($len > 65){
                	            echo substr($data['system_name'], 0,65).'...';
                	        } else {
                	            echo $data['system_name'];
                	        }
                	        
                	        ?>
                	    </a>
                	</h5>		
                </li>
            <?php endforeach;?>
            </ul>
        </div>
    </div>
    <?php            
        endif;
    endif;
    ?>
    
    <div class="row material-specs">
    <?php if(!empty($selectedMaterial['short_description'])):?>
    <div>
    	<strong>Short Description:</strong>
    	<div><?php echo $selectedMaterial['short_description']; ?></div>
	</div>
	<?php endif;?>
    
    <?php if(!empty($selectedMaterial['description'])):?>
    <div>
    	<strong>Description:</strong>
    	<div><?php echo $selectedMaterial['description']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['fence_grade'])):?>
    <div>
    	<strong>Fence Grade:</strong>
    	<div><?php echo $selectedMaterial['fence_grade']; ?></div>
	</div>
	<?php endif;?>	
		
	<?php if(!empty($selectedMaterial['height'])):?>
    <div>
    	<strong>Height:</strong>
    	<span><?php echo $selectedMaterial['height']; ?> ft</span>
	</div>
	<?php endif;?>
    
    <?php if(!empty($selectedMaterial['section_post_spacing'])):?>
    <div>
    	<h3>Sections Details:</h3>
    	<div>Post Spacing : <?php echo $selectedMaterial['section_post_spacing']; ?></div>
    	<div>Divition Style : <?php echo $selectedMaterial['section_division_style']; ?></div>
	</div>
	<?php endif;?>
    
    <?php if(!empty($selectedMaterial['color'])):?>
    <div>
    	<strong>Fence color:</strong>
    	<span><?php echo $selectedMaterial['color']; ?></span>
	</div>
	<?php endif;?>	
    
    <?php if(!empty($selectedMaterial['pricing'])):?>
    <div>
    	<strong>Pricing:</strong>
    	<span><?php echo $selectedMaterial['pricing']; ?></span>
	</div>
	<?php endif;?>	
    
    <?php if(!empty($selectedMaterial['line_post_specs'])):?>
    <div>
    	<h3>Line Post:</h3>
    	<div>Post Specs : <?php echo $selectedMaterial['line_post_specs']; ?></div>
    	<div>Post Price : <?php echo $selectedMaterial['line_post_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['line_post_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['line_post_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['terminal_post_specs'])):?>
    <div>
    	<h3>Terminal Post:</h3>
    	<div>Post Specs : <?php echo $selectedMaterial['terminal_post_specs']; ?></div>
    	<div>Post Price : <?php echo $selectedMaterial['terminal_post_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['terminal_post_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['terminal_post_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['rail_specs'])):?>
    <div>
    	<h3>Top Rails:</h3>
    	<div>Rail Specs : <?php echo $selectedMaterial['rail_specs']; ?></div>
    	<div>Rail Price : <?php echo $selectedMaterial['rail_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['rail_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['rail_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['fabric_specs'])):?>
    <div>
    	<h3>Fabrics:</h3>
    	<div>Fabric Specs : <?php echo $selectedMaterial['fabric_specs']; ?></div>
    	<div>Fabric Price : <?php echo $selectedMaterial['fabric_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['fabric_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['fabric_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['loop_caps_specs'])):?>
    <div>
    	<h3>Loop Caps:</h3>
    	<div>Loop Caps Specs : <?php echo $selectedMaterial['loop_caps_specs']; ?></div>
    	<div>Loop Caps Price : <?php echo $selectedMaterial['loop_caps_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['loop_caps_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['loop_caps_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['dome_caps_specs'])):?>
    <div>
    	<h3>Dome Caps:</h3>
    	<div>Dome Caps Specs : <?php echo $selectedMaterial['dome_caps_specs']; ?></div>
    	<div>Dome Caps Price : <?php echo $selectedMaterial['dome_caps_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['dome_caps_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['dome_caps_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['tension_bars_specs'])):?>
    <div>
    	<h3>Tension Bars:</h3>
    	<div>Tension Bar Specs : <?php echo $selectedMaterial['tension_bars_specs']; ?></div>
    	<div>Tension Bar Price : <?php echo $selectedMaterial['tension_bars_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['tension_bars_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['tension_bars_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['wire_ties_specs'])):?>
    <div>
    	<h3>Wire Ties:</h3>
    	<div>Wire Tie Specs : <?php echo $selectedMaterial['wire_ties_specs']; ?></div>
    	<div>Wire Tie Price : <?php echo $selectedMaterial['wire_ties_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['wire_ties_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['wire_ties_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['nuts_bolts_specs'])):?>
    <div>
    	<h3>Nuts &amp; Bolts:</h3>
    	<div>Nuts/Bolts Specs : <?php echo $selectedMaterial['nuts_bolts_specs']; ?></div>
    	<div>Nuts/Bolts Price : <?php echo $selectedMaterial['nuts_bolts_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['nuts_bolts_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['nuts_bolts_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['brace_band_specs'])):?>
    <div>
    	<h3>Brace Band:</h3>
    	<div>Brace Band Specs : <?php echo $selectedMaterial['brace_band_specs']; ?></div>
    	<div>Brace Band Price : <?php echo $selectedMaterial['brace_band_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['brace_band_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['brace_band_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['rail_end_specs'])):?>
    <div>
    	<h3>Rail Ends:</h3>
    	<div>Rail Ends Specs : <?php echo $selectedMaterial['rail_end_specs']; ?></div>
    	<div>Rail Ends Price : <?php echo $selectedMaterial['rail_end_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['rail_end_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['rail_end_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['tension_band_specs'])):?>
    <div>
    	<h3>Tension Bands:</h3>
    	<div>Tension Band Specs : <?php echo $selectedMaterial['tension_band_specs']; ?></div>
    	<div>Tension Band Price : <?php echo $selectedMaterial['tension_band_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['tension_band_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['tension_band_sku']; ?></div>
    	<div># Bands per-Post: <?php echo $selectedMaterial['tension_band_perpost']; ?></div>
	</div>
	<?php endif;?>
    </div>

    <div class="row">	
	<?php if(!empty($materialPostCaps)):?>
	<h3>Post Caps:</h3>
	<div><?php echo $materialPostCaps; ?></div>
	<?php endif;?>
	
	<?php if(!empty($materialGatesLatch)):?>
	<h3>Gate Latch Options:</h3>
	<div><?php echo $materialGatesLatch;?></div>
	<?php endif;?>
	
	<?php if(!empty($materialSingleGates)):?>
	<h3>Single Gates:</h3>
	<div><?php echo $materialSingleGates;?></div>
	<?php endif;?>
	
	<?php if(!empty($materialDoubleGates)):?>
	<h3>Double Gates:</h3>
	<div><?php echo $materialDoubleGates;?></div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['install_labor_cost'])):?>
	<h3>Labor and Markup</h3>
	<div>Install Labor Cost (per-foot) : <?php echo $selectedMaterial['install_labor_cost'];?></div>
	<div>Material Markup Percent (%) : <?php echo $selectedMaterial['material_markup_percent'];?></div>
	<?php endif;?>
    </div>
	
	<div style="clear:both; margin-bottom:20px;"></div>
</div>
<?php } ?>
