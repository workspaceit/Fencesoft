
<style type="text/css">

.fdata {
	border: 1px solid #ccc;
	padding: 10px;
}
.fdata h3, .fdata p {
	text-align: center;
}
</style>

<?php
$serverAddress = ($_SERVER['SERVER_ADDR']=='127.0.0.1') ? 'localhost' :$_SERVER['SERVER_ADDR'];

$featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/placeholder_blank.png';
?>

<ul class="four_up tiles" id="fcontent">
<?php 
if(!empty($fences)):
    $i = 0;
	$block = 1;
	foreach ($fences as $key=>$fence):
		if($i >= 8) $block++;	
?>
	<li class="fdata fblock_<?php echo $block;?>">
	    <?php
        if(!empty($fence['featured_image'])){
            $featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/materials/'.$fence['featured_image'];
        }else {            
            if(!empty($fence['product_image'])){
                $productImage = explode(',', $fence['product_image']);
                $featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/materials/'.$productImage[0];
            }else {
                $featuredImage = 'http://'.$serverAddress.'/fencesoft-admin/uploads/placeholder_blank.png';
            }
        }
	    ?>
	    
		<a <?php  echo ($fence['is_blank']) ? 'href="'.Yii::app()->request->baseUrl.'/index.php?r=index/materialDetails&fence_type='.$fence['type_of_fence'].'&fence_id='.$fence['id'].'" class="materialDetails"' : 'href="'.Yii::app()->request->baseUrl.'/index.php?r=index/estimation&fence_type='.$fence['type_of_fence'].'&fence_id='.$fence['id'].'"'; ?>><img src="<?php  echo $featuredImage; ?>" alt="" /></a>
    	<h3>
    	    <a <?php  echo ($fence['is_blank']) ? 'href="'.Yii::app()->request->baseUrl.'/index.php?r=index/materialDetails&fence_type='.$fence['type_of_fence'].'&fence_id='.$fence['id'].'" class="materialDetails"' : 'href="'.Yii::app()->request->baseUrl.'/index.php?r=index/estimation&fence_type='.$fence['type_of_fence'].'&fence_id='.$fence['id'].'"'; ?>>
    	        <?php
    	        $len = count($fence['system_name']);
    	        if($len > 65){
    	            echo substr($fence['system_name'], 0,65).'...';
    	        } else {
    	            echo $fence['system_name'];
    	        }
    	        
    	        ?>
    	    </a>
    	</h3>
        <p><?php echo $fence['short_description'];?></p>
		<a href="<?php  echo Yii::app()->request->baseUrl.'/index.php?r=index/materialDetails&fence_type='.$fence['type_of_fence'].'&fence_id='.$fence['id']; ?>" class="view-details materialDetails" title="Click to view material details">View Details</a>
    </li>
<?php
        if($i >= 8) $i=0;
	    $i++;
	endforeach;
else :
?>
    <li class="fdata fblock_1">
        <img src="<?php  echo $featuredImage; ?>"/>
    	<h3>No results matched your query...</h3>
    </li>
<?php 
endif;
?>    
</ul>

<?php if(!empty($fences)): ?>
<script type="text/javascript">
$(function(){
	$('.fdata').fadeOut('fast',function(){
		$('.fblock_1').fadeIn('slow');
	});
	$('#paginationHolder').bootstrapPaginator({
		currentPage: 1,
        totalPages: <?php echo ceil(count($fences)/8);?>,
        onPageChanged : function(event, oldPage, newPage){
			$('.fblock_'+oldPage).fadeOut('fast',function(){
				$('.fblock_'+newPage).fadeIn('slow');
			});
		}
	});

	$('.materialDetails').click(function(e){
		e.preventDefault();
		$this = $(this);
		$.ajax({
			url : $this.attr('href'),
			success : function(e){
				$.featherlight(e);
			}
		});
	});
	
});
</script>
<?php else:?>
<script type="text/javascript">
$(function(){
	$('.fdata').fadeOut('fast',function(){
		$('.fblock_1').fadeIn('slow');
	});
	$('#paginationHolder').bootstrapPaginator({
		currentPage: 1,
        totalPages: 1,
	});
	
});
</script>
<?php endif;?>