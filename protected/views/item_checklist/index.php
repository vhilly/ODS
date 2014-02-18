<?php
$this->breadcrumbs=array(
	'Item Checklists',
);

$this->menu=array(
array('label'=>'Create ItemChecklist','url'=>array('create')),
array('label'=>'Manage ItemChecklist','url'=>array('admin')),
);
?>

<h1>Item Checklists</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
