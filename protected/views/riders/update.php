<?php
$this->breadcrumbs=array(
	'Riders'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Riders','url'=>array('index')),
	array('label'=>'Create Riders','url'=>array('create')),
	array('label'=>'View Riders','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Riders','url'=>array('admin')),
	);
	?>

	<h1>Update Riders <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>