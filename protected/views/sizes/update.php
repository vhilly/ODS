<?php
$this->breadcrumbs=array(
	'Sizes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Sizes','url'=>array('index')),
	array('label'=>'Create Sizes','url'=>array('create')),
	array('label'=>'View Sizes','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Sizes','url'=>array('admin')),
	);
	?>

	<h1>Update Sizes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>