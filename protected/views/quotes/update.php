<?php
/* @var $this QuotesController */
/* @var $model Quotes */

$this->breadcrumbs=array(
	'Quotes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Quotes', 'url'=>array('index')),
	array('label'=>'Create Quotes', 'url'=>array('create')),
	array('label'=>'View Quotes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Quotes', 'url'=>array('admin')),
);
?>

<div class="page-header">
	<div class="page-title">
		<h3>Update Quotes #<?php echo $model->id; ?></h3>
		<span>Fields with <i class="required">*</i> are required.</span>
	</div>	
</div>
<div class="row">
	<div class="col-md-12">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-reorder"></i>Update Form :: Quotes</h4>
			</div>
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>

