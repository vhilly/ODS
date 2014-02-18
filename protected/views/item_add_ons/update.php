<?php
$this->breadcrumbs=array(
	'Item Add Ons'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List ItemAddOns','url'=>array('index')),
	array('label'=>'Create ItemAddOns','url'=>array('create')),
	array('label'=>'View ItemAddOns','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ItemAddOns','url'=>array('admin')),
	);
	?>

	<h1>Update ItemAddOns <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>