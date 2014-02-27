<?php
$this->breadcrumbs=array(
	'Misc Items'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List MiscItems','url'=>array('index')),
array('label'=>'Create MiscItems','url'=>array('create')),
array('label'=>'Update MiscItems','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete MiscItems','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage MiscItems','url'=>array('admin')),
);
?>

<h1>View MiscItems #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
),
)); ?>
