<?php
$this->breadcrumbs=array(
	'Item Add Ons'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List ItemAddOns','url'=>array('index')),
array('label'=>'Create ItemAddOns','url'=>array('create')),
array('label'=>'Update ItemAddOns','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ItemAddOns','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ItemAddOns','url'=>array('admin')),
);
?>

<h1>View ItemAddOns #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'item_id',
		'add_on_id',
		'is_available',
),
)); ?>
