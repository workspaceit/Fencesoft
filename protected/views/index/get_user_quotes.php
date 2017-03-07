<?php 
if(!empty($quotes)): 
?>
<ul>
<?php foreach ($quotes as $key=>$data):?>
    <li>
        <a href="<?php  echo Yii::app()->request->baseUrl.'/index.php?r=index/estimation&fence_type='.$data['material_type'].'&fence_id='.$data['material_id'].'&quote_id='.$data['id']; ?>" title="Click to select this quotes...">
            Quotes #<?php echo $key+1;?>
        </a>
    </li>
<?php endforeach;?>
</ul>
<?php else :?>
Quotes are empty
<?php endif;?>