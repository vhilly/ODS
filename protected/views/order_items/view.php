<?php
$this->breadcrumbs=array(
	'Order Items'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List OrderItems','url'=>array('index')),
array('label'=>'Create OrderItems','url'=>array('create')),
array('label'=>'Update OrderItems','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete OrderItems','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage OrderItems','url'=>array('admin')),
);
?>

<h1>View OrderItems #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'order_id',
		'menu_item_id',
		'qty',
),
)); ?>
