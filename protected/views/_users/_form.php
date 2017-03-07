<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_fname'); ?>
		<?php echo $form->textField($model,'user_fname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'user_fname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_lname'); ?>
		<?php echo $form->textField($model,'user_lname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'user_lname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'type'=>'email', 'required'=>'required')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>100,'type'=>'password', 'required'=>'required')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="row">
		<label>Re-type Password *</label>
		<input type="password" name="retype_password" value="">
	</div>

<?php /*?>
	<div class="row">
		<?php echo $form->labelEx($model,'site_id'); ?>
		<?php echo $form->textField($model,'site_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'site_id'); ?>
	</div>
<?php */ ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
$(function(){
	
	$( "#users-form" ).validate({
		rules: {
			password: {
				required: true,
			},
			retype_password: {
				equalTo: "#Users_password"
			}
		}
	});
	$("#Users_email").rules("add", { required:true,email:true });
	
});
</script>

