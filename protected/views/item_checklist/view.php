<?php
$this->breadcrumbs=array(
	'Item Checklists'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List ItemChecklist','url'=>array('index')),
array('label'=>'Create ItemChecklist','url'=>array('create')),
array('label'=>'Update ItemChecklist','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ItemChecklist','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ItemChecklist','url'=>array('admin')),
);
?>

<h1>View ItemChecklist #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'item_id',
		'misc_item_id',
		'qty',
),
)); ?>
