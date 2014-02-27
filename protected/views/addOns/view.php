<?php
$this->breadcrumbs=array(
	'Add Ons'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List AddOns','url'=>array('index')),
array('label'=>'Create AddOns','url'=>array('create')),
array('label'=>'Update AddOns','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete AddOns','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage AddOns','url'=>array('admin')),
);
?>

<h1>View AddOns #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'description',
),
)); ?>
