<?php
$this->breadcrumbs=array(
	'Item Sizes'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List ItemSizes','url'=>array('index')),
array('label'=>'Create ItemSizes','url'=>array('create')),
array('label'=>'Update ItemSizes','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ItemSizes','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ItemSizes','url'=>array('admin')),
);
?>

<h1>View ItemSizes #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'item_id',
		'size_id',
		'description',
		'price',
),
)); ?>
