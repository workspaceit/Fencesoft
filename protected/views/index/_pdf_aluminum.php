<?php 
$featuredImage = Yii::app()->basePath.'/../../fencesoft-admin/uploads/placeholder_blank.png';
if(!empty($selectedMaterial)){
    if(!empty($selectedMaterial['featured_image'])){
        $featuredImage = Yii::app()->basePath.'/../../fencesoft-admin/uploads/materials/'.$selectedMaterial['featured_image'];
    } else if(!empty($selectedMaterial['product_image'])){
        $productImage = explode(',', $selectedMaterial['product_image']);
        $featuredImage = Yii::app()->basePath.'/../../fencesoft-admin/uploads/materials/'.$productImage[0];        
    }
}
$totalCost = 0;
$total_length = 0;
$total_number_post = 0;
$total_line_post = (isset($quotes_line_post)) ? $quotes_line_post : 0;
$total_section = 0;
$total_post_caps = 0;
$total_gate_width = 0;
$total_gate_post = 0;

// Determine Total Length and # of Line Posts
foreach ($lengthList as $line) {
    $total_length = ((float) $total_length + (float) $line);
    $total_line_post = ($total_line_post + ceil(((float) $line / $selectedMaterial['section_post_spacing'])) -1);
}
$total_line_post = $total_line_post + 1;
$total_post_caps = $total_line_post + $total_corner_post + $total_end_post;

// If division style is even - calculate sections to the nearest half
if($selectedMaterial['section_division_style'] == 'Even') {
	foreach ($lengthList as $line) {
		$section_line = ((float) $line / $selectedMaterial['section_post_spacing']);
		$section_round = round($section_line * 2, 0) / 2;
		$total_section = $total_section + $section_round;
	}
	// Total sections for even
	$total_section = ceil($total_section);
} else {
	// Total sections for economical
	$total_section = ceil($total_length / $selectedMaterial['section_post_spacing']);
}

// If bracketed find total bracket kits
if($selectedMaterial['section_mount']=='Brackets') {
    $total_braket_kits = (2 * $total_line_post) + (2 * $total_corner_post) + (1 * $total_end_post);
}
?>

<table style="width:100%; margin:5px 0 10px; border-bottom:1px solid #efefef; padding-bottom:5px;">
	<tr>
		<td style="width:50%; vertical-align:top;">
			<span style="font-size:12px;"><?php echo $selectedMaterial['system_name'];?></span><br />
			<img src="<?php echo $featuredImage;?>" style="height:169px; width:300px; padding:10px 0;" /><br />
			<span style="font-size:10px;" class="veranda"><i>For additional product infromation visit: <a href="http://veranda.barretteoutdoorliving.com">veranda.barretteoutdoorliving.com</a></i></span>
			<span style="font-size:10px;" class="freedom"><i>For additional product infromation visit: <a href="http://freedom.barretteoutdoorliving.com">freedom.barretteoutdoorliving.com</a></i></span>
			<span style="font-size:10px;" class="activeyards"><i>For additional product infromation visit: <a href="http://activeyards.com">www.activeyards.com</a></i></span>
		</td>
		<td style="width:50%; vertical-align:top;"><img src="<?php echo $canvasImage ?>" style="height:225px; width:300px; padding:0; margin:8px 0;" /></td>
	</tr>
</table>

<table style="width:100%;">
	<tr>
		<td colspan="5" style="height:16px;"><span style="font-size:12px;">MATERIAL ITEMS LIST</span></td>
	</tr>
	<tr style="background:#efefef;">
		<td style="height:16px; width:10%;"><span style="font-size:12px;">QTY</span></td>
		<td style="height:16px; width:15%;"><span style="font-size:12px;">ITEM #</span></td>
		<td style="height:16px; width:15%;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">UNIT PRICE</span><?php } ?></td>
		<td style="height:16px; width:40%;"><span style="font-size:12px;">DESCRIPTION</span></td>
		<td style="height:16px; width:20%;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">TOTAL</span><?php } ?></td>
	</tr>
	
	<?php if(!empty($selectedMaterial['system_name'])):?>
	<tr>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $total_section;?></span></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedMaterial['system_id'];?></span></td>
		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($selectedMaterial['section_price'], "$"), 2, '.', ',');?></span><?php } ?></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedMaterial['system_name'];?></span></td>
		<td style="height:16px;">
		    <span style="font-size:12px;">
                <?php $total = $total_section * number_format(trim($selectedMaterial['section_price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
                $totalCost +=$total;
                ?>
		    </span>
		</td>
	</tr>
	<?php endif;?>
	
	<?php if(!empty($selectedMaterial['line_post_specs'])):?>
	<tr>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $total_line_post;?></span></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedMaterial['line_post_item'];?> <?php echo $selectedMaterial['line_post_sku'];?></span></td>
		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($selectedMaterial['line_post_price'], "$"), 2, '.', ',');?></span><?php } ?></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedMaterial['line_post_specs'];?></span></td>
		<td style="height:16px;">
		    <span style="font-size:12px;">
		        <?php $total = $total_line_post * number_format(trim($selectedMaterial['line_post_price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
		        $totalCost +=$total;
		        ?>
		    </span>
		</td>
	</tr>
	<?php endif;?>	
	
	<?php if(!empty($selectedMaterial['corner_post_specs']) && ($total_corner_post!=0)):?>
	<tr>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $total_corner_post;?></span></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedMaterial['corner_post_item'];?> <?php echo $selectedMaterial['corner_post_sku'];?></span></td>
		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($selectedMaterial['corner_post_price'], "$"), 2, '.', ',');?></span><?php } ?></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedMaterial['corner_post_specs'];?></span></td>
		<td style="height:16px;">
		    <span style="font-size:12px;">
		        <?php $total = $total_corner_post * number_format(trim($selectedMaterial['corner_post_price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
		        $totalCost +=$total;
		        ?>
		    </span>
		</td>
	</tr>
	<?php endif;?>	

    <?php if(!empty($selectedMaterial['end_post_specs']) && empty($selectedMaterial['gate_post_price']) && ($total_end_post!=0)):?>
    <tr>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php echo $total_end_post;?>
        </span></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php echo $selectedMaterial['end_post_item'];?>
                <?php echo $selectedMaterial['end_post_sku'];?> </span>
        </td>
        <td style="height: 16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { ?><span style="font-size: 12px;">$<?php echo number_format(trim($selectedMaterial['end_post_price'], "$"), 2, '.', ',');?>
        </span><?php } ?></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php echo $selectedMaterial['end_post_specs'];?>
        </span></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php $total = $total_end_post * number_format(trim($selectedMaterial['end_post_price'], "$"), 2, '.', ',');
        if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {echo '$'. number_format($total, 2, '.', ',');}
        $totalCost +=$total;
        ?>
        </span>
        </td>
    </tr>
    <?php endif;?>

	<?php if(!empty($selectedMaterial['blank_post_price']) && ($total_blank_post!=0)):?>
	<tr>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $total_blank_post;?></span></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedMaterial['blank_post_item'];?> <?php echo $selectedMaterial['blank_post_sku'];?></span></td>
		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($selectedMaterial['blank_post_price'], "$"), 2, '.', ',');?></span><?php } ?></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedMaterial['blank_post_specs'];?></span></td>
		<td style="height:16px;">
		    <span style="font-size:12px;">
		        <?php $total = $total_blank_post * number_format(trim($selectedMaterial['blank_post_price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
		        $totalCost +=$total;
		        ?>
	        </span>
	    </td>
	</tr>
	<?php endif;?>
	
	<?php if(($selectedMaterial['section_mount']=='Brackets') && (!empty($selectedMaterial['bracket_kits_specs']))): ?>
	<tr>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $total_braket_kits; ?></span></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedMaterial['bracket_kits_item'];?> <?php echo $selectedMaterial['bracket_kits_sku'];?></span></td>
		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($selectedMaterial['bracket_kits_price'], "$"), 2, '.', ',');?></span><?php } ?></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedMaterial['bracket_kits_specs'];?></span></td>
		<td style="height:16px;">
		    <span style="font-size:12px;">
		        <?php $total = $total_braket_kits * number_format(trim($selectedMaterial['bracket_kits_price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
		        $totalCost +=$total;
		        ?>
	        </span>
	    </td>
	</tr>
	<?php endif;?>	
	
	<?php if(!empty($selectedPostCaps)):?>
	<tr>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $total_post_caps;?></span></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedPostCaps['item'];?> <?php echo $selectedPostCaps['sku'];?></span></td>
		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($selectedPostCaps['price'], "$"), 2, '.', ',');?></span><?php } ?></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedPostCaps['post_cap_style'];?></span></td>
		<td style="height:16px;">
		    <span style="font-size:12px;">
		        <?php $total = $total_post_caps * number_format(trim($selectedPostCaps['price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
		        $totalCost +=$total;
		        ?>
	        </span>
	    </td>
	</tr>
	<?php endif;?>	

	<?php if(!empty($storeData['concrete_cost'])):?>
	<tr>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $total_post_caps * $selectedMaterial['bags_of_concrete'];?></span></td>
		<td style="height:16px;"><span style="font-size:12px;">N/A</span></td>
		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($storeData['concrete_cost'], "$"), 2, '.', ',');?></span><?php } ?></td>
		<td style="height:16px;"><span style="font-size:12px;">Bags of Concrete</span></td>
		<td style="height:16px;">
		    <span style="font-size:12px;">
		        <?php $total = ($total_post_caps * number_format(trim($storeData['concrete_cost'], "$"), 2, '.', ',')) * $selectedMaterial['bags_of_concrete'];
				$totalConcrete = ($total_post_caps * number_format(trim($storeData['concrete_cost'], "$"), 2, '.', ',')) * $selectedMaterial['bags_of_concrete'];
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
		        $totalCost +=$total;
		        ?>
	        </span>
	    </td>
	</tr>
	<?php endif;?>
	
	<?php if(!empty($selectedGates)):
	foreach ($selectedGates as $key=>$gate):	    
	    $gateMultiply = ($gate['details']['gate_type']=='single') ? 1 : 1;
	    $gateWidthMultiply = ($gate['details']['width'] < 8) ? 1 : 2;
	    $total_gate_width += ($gate['details']['width'] * $gate['number']);
	?>	    
    <tr>
    	<td style="height:16px;"><span style="font-size:12px;"><?php echo $qty = $gateMultiply * $gate['number'];?></span></td>
    	<td style="height:16px;"><span style="font-size:12px;"><?php echo $gate['details']['gate_item'];?> <?php echo $gate['details']['gate_sku'];?></span></td>
    	<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($gate['details']['gate_price'], "$"), 2, '.', ',');?></span><?php } ?></td>
    	<td style="height:16px;"><span style="font-size:12px;"><?php echo $gate['details']['description'];?></span></td>
    	<td style="height:16px;">
    	    <span style="font-size:12px;">
    	        <?php $total = $qty * number_format(trim($gate['details']['gate_price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
    	        $totalCost +=$total; $total_gate_post += $qty;
				?>
    	    </span>
    	</td>
    </tr>
    	
    <?php if(!empty($gate['details']['gate_kit_price'])){?>
    <tr>
    	<td style="height:16px;"><span style="font-size:12px;"><?php echo $qty = $gateMultiply * $gate['number'];?></span></td>
    	<td style="height:16px;"><span style="font-size:12px;"><?php echo $gate['details']['gate_kit_item'];?> <?php echo $gate['details']['gate_kit_sku'];?></span></td>
    	<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($gate['details']['gate_kit_price'], "$"), 2, '.', ',');?></span><?php } ?></td>
    	<td style="height:16px;"><span style="font-size:12px;"><?php echo $gate['details']['gate_style'];?></span></td>
    	<td style="height:16px;">
    	    <span style="font-size:12px;">
    	        <?php $total = $qty * number_format(trim($gate['details']['gate_kit_price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
    	        $totalCost +=$total;
    	        ?>
    	    </span>
    	</td>
    </tr>
	<?php } ?>

	<?php if(!empty($selectedGatesLatch)){?>
   	<tr>
   		<td style="height:16px;"><span style="font-size:12px;"><?php echo $qty = $gate['number'];?></span></td>
   		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedGatesLatch['latch_item'];?> <?php echo $selectedGatesLatch['latch_sku'];?></span></td>
   		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($selectedGatesLatch['latch_price'], "$"), 2, '.', ',');?></span><?php } ?></td>
   		<td style="height:16px;"><span style="font-size:12px;"><?php echo $selectedGatesLatch['latch_option'];?></span></td>
   		<td style="height:16px;">
   		    <span style="font-size:12px;">
   		        <?php $total = $qty * number_format(trim($selectedGatesLatch['latch_price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
   		        $totalCost +=$total;
   		        ?>
   		    </span>
   		</td>
   	</tr>
   	<?php }?>

   	<?php if(!empty($gate['details']['hinges_price'])){?>
   	<tr>
   		<td style="height:16px;"><span style="font-size:12px;"><?php echo $qty = $gateWidthMultiply * $gate['number'];?></span></td>
   		<td style="height:16px;"><span style="font-size:12px;"><?php echo $gate['details']['hinges_item'];?> <?php echo $gate['details']['hinges_sku'];?></span></td>
   		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($gate['details']['hinges_price'], "$"), 2, '.', ',');?></span><?php } ?></td>
   		<td style="height:16px;"><span style="font-size:12px;">Gate Hinges (set)</span></td>
   		<td style="height:16px;">
   		    <span style="font-size:12px;">
                <?php $total = $qty * number_format(trim($gate['details']['hinges_price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
                $totalCost +=$total;
                ?>
   		    </span>
   		</td>
   	</tr>
   	<?php }?>

	<?php if(!empty($gate['details']['drop_rod_price'])){?>
   	<tr>
   		<td style="height:16px;"><span style="font-size:12px;"><?php echo $qty = $gate['number'];?></span></td>
   		<td style="height:16px;"><span style="font-size:12px;"><?php echo $gate['details']['drop_rod_item'];?> <?php echo $gate['details']['drop_rod_sku'];?></span></td>
   		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($gate['details']['drop_rod_price'], "$"), 2, '.', ',');?></span><?php } ?></td>
   		<td style="height:16px;"><span style="font-size:12px;">Drop-Rod</span></td>
   		<td style="height:16px;">
   		    <span style="font-size:12px;">
   		        <?php $total = $qty * number_format(trim($gate['details']['drop_rod_price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
   		        $totalCost +=$total;
   		        ?>
   		    </span>
   		</td>
   	</tr>
   	<?php }?>

	<?php if(!empty($gate['details']['gate_post_price'])){?>
   	<tr>
   		<td style="height:16px;"><span style="font-size:12px;"><?php echo $qty = $gateWidthMultiply * $gate['number'];?></span></td>
   		<td style="height:16px;"><span style="font-size:12px;"><?php echo $gate['details']['gate_post_item'];?> <?php echo $gate['details']['gate_post_sku'];?></span></td>
   		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($gate['details']['gate_post_price'], "$"), 2, '.', ',');?></span><?php } ?></td>
   		<td style="height:16px;"><span style="font-size:12px;">Gate Post Insert</span></td>
   		<td style="height:16px;"><span style="font-size:12px;"><?php $total = $qty * number_format(trim($gate['details']['gate_post_price'], "$"), 2, '.', ',');
                if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total, 2, '.', ','); }
   		        $totalCost +=$total;
   		        ?>
        </span>
        </td>
   	</tr>
   	<?php } ?>

	<?php
	endforeach; 
	endif;?>

    <?php if(!empty($selectedMaterial['end_post_specs']) && !empty($selectedMaterial['gate_post_price']) && ($total_end_post!=0)):?>
    <tr>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php $total_end_post = $total_end_post - $total_gate_post + $total_blank_post; echo $total_end_post;?>
        </span></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php echo $selectedMaterial['end_post_item'];?>
                <?php echo $selectedMaterial['end_post_sku'];?> </span>
        </td>
        <td style="height: 16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { ?><span style="font-size: 12px;">$<?php echo number_format(trim($selectedMaterial['end_post_price'], "$"), 2, '.', ',');?>
        </span><?php } ?></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php echo $selectedMaterial['end_post_specs'];?>
        </span></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php $total = $total_end_post * number_format(trim($selectedMaterial['end_post_price'], "$"), 2, '.', ',');
        if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {echo '$'. number_format($total, 2, '.', ',');}
        $totalCost +=$total;
        ?>
        </span>
        </td>
    </tr>
    <?php endif;?>
	
	<?php if(!empty($selectedMaterial['blank_post_specs']) && empty($selectedMaterial['gate_post_price']) && ($total_blank_post!=0)):?>
    <tr>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php echo $total_blank_post;?>
        </span></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php echo $selectedMaterial['blank_post_item'];?>
                <?php echo $selectedMaterial['blank_post_sku'];?> </span>
        </td>
        <td style="height: 16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { ?><span style="font-size: 12px;">$<?php echo number_format(trim($selectedMaterial['blank_post_price'], "$"), 2, '.', ',');?>
        </span><?php } ?></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php echo $selectedMaterial['blank_post_specs'];?>
        </span></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php $total = $total_blank_post * number_format(trim($selectedMaterial['blank_post_price'], "$"), 2, '.', ',');
        if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {echo '$'. number_format($total, 2, '.', ',');}
        $totalCost +=$total;
        ?>
        </span>
        </td>
    </tr>
    <?php endif;?>
	
    <?php if(!empty($selectedMaterial['gate_post_price']) && $gate['number']!=0){?>
    <tr>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php echo $total_gate_post;?>
        </span></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php echo $selectedMaterial['gate_post_item'];?> <?php echo $selectedMaterial['gate_post_sku'];?></span></td>
        <td style="height: 16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { ?><span style="font-size: 12px;">$<?php echo number_format(trim($selectedMaterial['gate_post_price'], "$"), 2, '.', ',');?>
        </span><?php } ?></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php echo $selectedMaterial['gate_post_specs'];?></span></td>
        <td style="height: 16px;"><span style="font-size: 12px;"><?php $total = $total_gate_post * number_format(trim($selectedMaterial['gate_post_price'], "$"), 2, '.', ',');
            if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {echo '$'. number_format($total, 2, '.', ',');}
            $totalCost +=$total;
            ?>
        </span>
        </td>
    </tr>
    <?php }?>	

	<?php
	// Apply Multiplier if exists
	if ($storeData['multiplier_site'] == 1) {
		$totalCost = (($totalCost - $totalConcrete) * ($storeData['multiplier_aluminum'] / 100)) + $totalConcrete;
	}
	
	// Check if Price Per Foot
	if ($selectedMaterial['pricing'] == 'Price-per-foot') {
	// Calculate Estimated Cost for Price-per-foot Method
	    $totalAmount = ((float) $total_length + $total_gate_width) * $selectedMaterial['pricing_value'];
	// Else Use Calculated Price Method
	}else {
	    
	}

	$total_labor_cost = 0;
	// Check if labor is on/off
	if($storeData['is_labor']=='on'){

		//check is labor cost set in material lavel
		if($selectedMaterial['labor_cost']!=''){
			//check if cost type is price per foot OR price per post
			if($selectedMaterial['labor_cost_type']=='price-per-foot') {
				$total_labor_cost = $selectedMaterial['labor_cost'] * ($total_length + $total_gate_width);
			} else {
				$total_labor_cost = ($selectedMaterial['labor_cost'] * $total_line_post) + ($selectedMaterial['labor_cost'] * $total_corner_post) + ($selectedMaterial['labor_cost'] * $total_end_post);
			}
		} else {
			$total_labor_cost = $storeData['aluminum_labor_cost'] * ($total_length + $total_gate_width);
		}
		// Add fence removal amount to labor if exists
		if(!empty($quotesInfo['feet_removal'])){
			if($quotesInfo['removal_fence']=='aluminum'){
				$removal_type = 'Aluminum';
				$removal_cost = $storeData['removal_aluminum'];
				$total_removal_cost = ($quotesInfo['feet_removal'] * $storeData['removal_aluminum']);
            }
            else if($quotesInfo['removal_fence']=='chainlink'){
				$removal_type = 'Chainlink';
				$removal_cost = $storeData['removal_chainlink'];
				$total_removal_cost = ($quotesInfo['feet_removal'] * $storeData['removal_chainlink']);
            }
            else if($quotesInfo['removal_fence']=='vinyl'){
				$removal_type = 'Vinyl';
				$removal_cost = $storeData['removal_vinyl'];
				$total_removal_cost = ($quotesInfo['feet_removal'] * $storeData['removal_vinyl']);
            }
            else if($quotesInfo['removal_fence']=='wood'){
				$removal_type = 'Wood';
				$removal_cost = $storeData['removal_wood'];
				$total_removal_cost = ($quotesInfo['feet_removal'] * $storeData['removal_wood']);
            }
            $total_labor_cost = $total_labor_cost + $total_removal_cost;
		}
	}	

	// Calculate Material Markup and Sales Tax
	$storeData['sales_tax_amount'] = (!empty($storeData['sales_tax_amount'])) ? $storeData['sales_tax_amount'] : 0;
	$storeData['markup_aluminum'] = (!empty($storeData['markup_aluminum'])) ? $storeData['markup_aluminum'] : 0;
	$markup_total = 0;	$sales_tax_total = 0;
	// I apply sales tax to markup materials
	if($storeData['sales_tax_method']=='markup_materials'){
		// Markup method for markup of cost
		if($storeData['markup_method']=='markup_of_cost'){
			$markup_total = $totalCost * ($storeData['markup_aluminum']/100);
			$totalAmount = $totalCost + $markup_total + $total_labor_cost;
			$sales_tax_total += ($totalCost + $markup_total) * ($storeData['sales_tax_amount']/100);
			$totalAmount = $totalAmount + $sales_tax_total;
		// Markup method for markup of selling price
		} else if($storeData['markup_method']=='markup_of_sale'){
			$markup_total = $totalCost / (1-($storeData['markup_aluminum'])/100);
			$totalAmount = $markup_total + $total_labor_cost;
			$sales_tax_total += $markup_total * ($storeData['sales_tax_amount']/100);
			$totalAmount = $totalAmount + $sales_tax_total;
        } else {
            $totalAmount = $totalCost + $total_labor_cost;
        }
	// I apply sales tax when I purchase materials
	} else if($storeData['sales_tax_method']=='with_materials'){
		$sales_tax_total = $totalCost * ($storeData['sales_tax_amount']/100);
		$totalCost = $totalCost + $sales_tax_total;
		// Markup method for markup of cost
		if($storeData['markup_method']=='markup_of_cost'){
			$markup_total = $totalCost * ($storeData['markup_aluminum']/100);
			$totalAmount = $totalCost + $markup_total + $total_labor_cost;
		// Markup method for markup of selling price
		} else if($storeData['markup_method']=='markup_of_sale'){
			$markup_total = $totalCost / (1-($storeData['markup_aluminum'])/100);
			$totalAmount = $markup_total + $total_labor_cost;
        } else {
            $totalAmount = $totalCost + $total_labor_cost;
        }
	}
	// Apply price adjustment
	$totalAmount = $totalAmount + $adjustmentPrice;
	?>
	
	<?php if(($storeData['is_labor']=='on') && !empty($total_removal_cost)):?>
	<tr>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $quotesInfo['feet_removal'];?>FT</span></td>
		<td style="height:16px;"><span style="font-size:12px;">N/A</span></td>
		<td style="height:16px;"><?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) {?><span style="font-size:12px;">$<?php echo number_format(trim($removal_cost, "$"), 2, '.', ',');?></span><?php } ?></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $removal_type; ?> Fence Removal</span></td>
		<td style="height:16px;">
		    <span style="font-size:12px;">
		        <?php if(($storeData['show_item_price']==1) && ($selectedMaterial['pricing'] != 'Price-per-foot')) { echo '$'.number_format($total_removal_cost, 2, '.', ','); } ?>
	        </span>
	    </td>
	</tr>
	<?php endif;?>
</table>

<table style="width:100%;">
	<tr style="background:#efefef;">
		<?php if(($storeData['sales_tax_method']=='markup_materials') && ($selectedMaterial['pricing'] != 'Price-per-foot')){ ?>
		<?php if(($storeData['markup_method']=='markup_of_cost')){ ?>
		<td style="height:16px;"><span style="font-size:12px;">MATERIAL (<?php echo $total_length + $total_gate_width;?>FT): $<?php echo number_format($markup_total + $totalCost, 2, '.', ',');?></span></td>
		<?php } ?>
		<?php if(($storeData['markup_method']=='markup_of_sale')){ ?>
		<td style="height:16px;"><span style="font-size:12px;">MATERIAL (<?php echo $total_length + $total_gate_width;?>FT): $<?php echo number_format($markup_total, 2, '.', ',');?></span></td>
		<?php } ?>
		<td style="height:16px; width:20%;"><span style="font-size:12px;">SALES TAX: $<?php echo number_format($sales_tax_total, 2, '.', ',');?></span></td>
		<?php if($storeData['is_labor']=='on') {?>
		<td style="height:16px; width:20%;"><span style="font-size:12px;">LABOR: $<?php echo number_format($total_labor_cost, 2, '.', ',');?></span></td>
		<?php } ?>
		<td style="height:16px; width:20%;"><span style="font-size:12px;">TOTAL: $<?php echo number_format($totalAmount, 2, '.', ',');?></span></td>
		<?php } elseif ($selectedMaterial['pricing'] == 'Price-per-foot'){ $totalAmount = ((float) $total_length + $total_gate_width) * $selectedMaterial['pricing_value']; ?>
		<td style="height:16px;"><span style="font-size:12px;">ESTIMATED COST (<?php echo $total_length + $total_gate_width;?>FT)</span></td>
		<td style="height:16px; width:20%;"><span style="font-size:12px;">$<?php echo number_format($totalAmount, 2, '.', ',');?></span></td>
		<?php } elseif ($storeData['sales_tax_method']=='with_materials'){?>
		<td style="height:16px;"><span style="font-size:12px;">ESTIMATED COST (<?php echo $total_length + $total_gate_width;?>FT)</span></td>
		<td style="height:16px; width:20%;"><span style="font-size:12px;">$<?php echo number_format($totalAmount, 2, '.', ',');?></span></td>
		<?php } else { ?>
		<td style="height:16px;"><span style="font-size:12px;">MATERIAL (<?php echo $total_length + $total_gate_width;?>FT): $<?php echo number_format($totalCost + $markup_total + $sales_tax_total, 2, '.', ',');?></span></td>
		<?php if($storeData['is_labor']=='on') {?>
		<td style="height:16px; width:20%;"><span style="font-size:12px;">LABOR: $<?php echo number_format($total_labor_cost, 2, '.', ',');?></span></td>
		<?php } ?>
		<td style="height:16px; width:20%;"><span style="font-size:12px;">$<?php echo number_format($totalAmount, 2, '.', ',');?></span></td>
		<?php } ?>
	</tr>
</table>

<?php $helper->updateQuoteForPayment($quotes_id,$totalAmount,$store_id); ?>
