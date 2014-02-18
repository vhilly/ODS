<?php
$this->breadcrumbs=array(
	'Riders'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Riders','url'=>array('index')),
array('label'=>'Create Riders','url'=>array('create')),
array('label'=>'Update Riders','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Riders','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Riders','url'=>array('admin')),
);
?>

<h1>View Riders #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
),
)); ?>
