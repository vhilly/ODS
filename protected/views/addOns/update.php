<?php
$this->breadcrumbs=array(
	'Add Ons'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List AddOns','url'=>array('index')),
	array('label'=>'Create AddOns','url'=>array('create')),
	array('label'=>'View AddOns','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AddOns','url'=>array('admin')),
	);
	?>

	<h1>Update Add Ons</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
