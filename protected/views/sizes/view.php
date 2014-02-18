<?php
$this->breadcrumbs=array(
	'Sizes'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Sizes','url'=>array('index')),
array('label'=>'Create Sizes','url'=>array('create')),
array('label'=>'Update Sizes','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Sizes','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Sizes','url'=>array('admin')),
);
?>

<h1>View Sizes #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'type',
		'name',
		'description',
),
)); ?>
