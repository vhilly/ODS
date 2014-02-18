<?php
$this->breadcrumbs=array(
	'Menu Items'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List MenuItems','url'=>array('index')),
array('label'=>'Create MenuItems','url'=>array('create')),
array('label'=>'Update MenuItems','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete MenuItems','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage MenuItems','url'=>array('admin')),
);
?>

<h1>View MenuItems #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'menu_id',
		'description',
		'price',
		'img',
		'is_available',
		'date_created',
		'date_updated',
		'deleted',
),
)); ?>
