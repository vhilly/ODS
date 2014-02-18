<?php
$this->breadcrumbs=array(
	'Item Sizes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List ItemSizes','url'=>array('index')),
	array('label'=>'Create ItemSizes','url'=>array('create')),
	array('label'=>'View ItemSizes','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ItemSizes','url'=>array('admin')),
	);
	?>

	<h1>Update ItemSizes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>