<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Customers','url'=>array('index')),
	array('label'=>'Create Customers','url'=>array('create')),
	array('label'=>'View Customers','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Customers','url'=>array('admin')),
	);
	?>

	<h1>Update Customers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>