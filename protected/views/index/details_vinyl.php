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
            		<a class="click-sub-material" href="<?php  echo Yii::app()->request->baseUrl.'/index.php?r=index/estimation&fence_type=Vinyl&fence_id='.$data['id']; ?>" title="Click to select this material"><img src="<?php  echo $featuredImage; ?>" alt="" /></a>
                	<h5>
                	    <a class="click-sub-material" href="<?php  echo Yii::app()->request->baseUrl.'/index.php?r=index/estimation&fence_type=Vinyl&fence_id='.$data['id']; ?>" title="Click to select this material">
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
	
	<?php if(!empty($selectedMaterial['fence_style'])):?>
    <div>
    	<strong>Fence Style:</strong>
    	<div><?php echo $selectedMaterial['fence_style']; ?></div>
	</div>
	<?php endif;?>	
	
	<?php if(!empty($selectedMaterial['section_mount'])):?>
    <div>
    	<strong>Type of section mount:</strong>
    	<span><?php echo $selectedMaterial['section_mount']; ?></span>
	</div>
	<?php endif;?>	
	
	<?php if(!empty($selectedMaterial['height'])):?>
    <div>
    	<strong>Height:</strong>
    	<span><?php echo $selectedMaterial['height']; ?></span>
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
        
    <?php if(!empty($selectedMaterial['section_specs']) && ($selectedMaterial['section_mount']!='Rails')):?>
    <div>
    	<h3>Sections:</h3>
    	<div>Section Specs : <?php echo $selectedMaterial['section_specs']; ?></div>
    	<div>Section Price : <?php echo $selectedMaterial['section_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['section_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['section_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['rail_specs']) && ($selectedMaterial['section_mount']=='Rails')):?>
    <div>
    	<h3>Rails:</h3>
    	<div>Rail Specs : <?php echo $selectedMaterial['rail_specs']; ?></div>
    	<div>Rail Price : <?php echo $selectedMaterial['rail_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['rail_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['rail_sku']; ?></div>
    	<div>Rail Length : <?php echo $selectedMaterial['rail_length']; ?></div>
    	<div># of Rail: <?php echo $selectedMaterial['no_of_rail']; ?></div>
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
	
	<?php if(!empty($selectedMaterial['corner_post_specs'])):?>
	<div>
    	<h3>Corner Post:</h3>
    	<div>Post Specs : <?php echo $selectedMaterial['corner_post_specs']; ?></div>
    	<div>Post Price : <?php echo $selectedMaterial['corner_post_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['corner_post_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['corner_post_sku']; ?></div>
    </div>
	<?php endif;?>	

	<?php if(!empty($selectedMaterial['end_post_specs'])):?>
	<div>
    	<h3>End Post:</h3>
    	<div>Post Specs : <?php echo $selectedMaterial['end_post_specs']; ?></div>
    	<div>Post Price : <?php echo $selectedMaterial['end_post_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['end_post_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['end_post_sku']; ?></div>
	</div>
	<?php endif;?>
	
	<?php if(($selectedMaterial['section_mount']=='Brackets') &&(!empty($selectedMaterial['bracket_kits_specs']))): ?>
	<div>
    	<h3>Bracket kits:</h3>
    	<div>Post Specs : <?php echo $selectedMaterial['bracket_kits_specs']; ?></div>
    	<div>Post Price : <?php echo $selectedMaterial['bracket_kits_price']; ?></div>
    	<div>Item # : <?php echo $selectedMaterial['bracket_kits_item']; ?></div>
    	<div>SKU # : <?php echo $selectedMaterial['bracket_kits_sku']; ?></div>
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
