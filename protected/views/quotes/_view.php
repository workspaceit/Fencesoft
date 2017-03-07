<?php
/* @var $this QuotesController */
/* @var $data Quotes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('network_type')); ?>:</b>
	<?php echo CHtml::encode($data->network_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('store_id')); ?>:</b>
	<?php echo CHtml::encode($data->store_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('material_id')); ?>:</b>
	<?php echo CHtml::encode($data->material_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('material_type')); ?>:</b>
	<?php echo CHtml::encode($data->material_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_cap_id')); ?>:</b>
	<?php echo CHtml::encode($data->post_cap_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('gate_latch_id')); ?>:</b>
	<?php echo CHtml::encode($data->gate_latch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quotes_data')); ?>:</b>
	<?php echo CHtml::encode($data->quotes_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('extra_data')); ?>:</b>
	<?php echo CHtml::encode($data->extra_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_at')); ?>:</b>
	<?php echo CHtml::encode($data->modified_at); ?>
	<br />

	*/ ?>

</div>