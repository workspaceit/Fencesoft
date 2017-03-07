<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="form-container">
		<h4>Create Users</h4>
		<?php if(isset($reply)):?>
		<p><?php echo $reply;?></p>
		<?php endif;?>
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>