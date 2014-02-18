<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Customers','url'=>array('index')),
array('label'=>'Create Customers','url'=>array('create')),
array('label'=>'Update Customers','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Customers','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Customers','url'=>array('admin')),
);
?>

<h1>View Customers #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'address',
		'phone_1',
		'phone_2',
		'geocode',
		'note',
),
)); ?>
