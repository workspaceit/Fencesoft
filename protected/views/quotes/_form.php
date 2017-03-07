<?php
/* @var $this QuotesController */
/* @var $model Quotes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quotes-form',
	'htmlOptions'=> array('class'=>'form-horizontal row-border'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<div class="col-md-10">
		<?php echo $form->textField($model,'user_id',array('size'=>20,'maxlength'=>20)); ?>
		</div>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'network_type'); ?>
		<div class="col-md-10">
		<?php echo $form->textField($model,'network_type',array('size'=>12,'maxlength'=>12)); ?>
		</div>
		<?php echo $form->error($model,'network_type'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'store_id'); ?>
		<div class="col-md-10">
		<?php echo $form->textField($model,'store_id',array('size'=>60,'maxlength'=>255)); ?>
		</div>
		<?php echo $form->error($model,'store_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'material_id'); ?>
		<div class="col-md-10">
		<?php echo $form->textField($model,'material_id',array('size'=>20,'maxlength'=>20)); ?>
		</div>
		<?php echo $form->error($model,'material_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'material_type'); ?>
		<div class="col-md-10">
		<?php echo $form->textField($model,'material_type',array('size'=>9,'maxlength'=>9)); ?>
		</div>
		<?php echo $form->error($model,'material_type'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'post_cap_id'); ?>
		<div class="col-md-10">
		<?php echo $form->textField($model,'post_cap_id',array('size'=>20,'maxlength'=>20)); ?>
		</div>
		<?php echo $form->error($model,'post_cap_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'gate_latch_id'); ?>
		<div class="col-md-10">
		<?php echo $form->textField($model,'gate_latch_id',array('size'=>20,'maxlength'=>20)); ?>
		</div>
		<?php echo $form->error($model,'gate_latch_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'quotes_data'); ?>
		<div class="col-md-10">
		<?php echo $form->textArea($model,'quotes_data',array('rows'=>6, 'cols'=>50)); ?>
		</div>
		<?php echo $form->error($model,'quotes_data'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'extra_data'); ?>
		<div class="col-md-10">
		<?php echo $form->textArea($model,'extra_data',array('rows'=>6, 'cols'=>50)); ?>
		</div>
		<?php echo $form->error($model,'extra_data'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'created_at'); ?>
		<div class="col-md-10">
		<?php echo $form->textField($model,'created_at'); ?>
		</div>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'modified_at'); ?>
		<div class="col-md-10">
		<?php echo $form->textField($model,'modified_at'); ?>
		</div>
		<?php echo $form->error($model,'modified_at'); ?>
	</div>

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-lg btn-info pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
