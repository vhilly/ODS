<?php
$this->breadcrumbs=array(
	'Card Holders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List CardHolder','url'=>array('index')),
	array('label'=>'Create CardHolder','url'=>array('create')),
	array('label'=>'View CardHolder','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CardHolder','url'=>array('admin')),
	);
	?>

	<h1>Update CardHolder <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>