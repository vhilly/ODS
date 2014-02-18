<?php
$this->breadcrumbs=array(
	'Item Sizes',
);

$this->menu=array(
array('label'=>'Create ItemSizes','url'=>array('create')),
array('label'=>'Manage ItemSizes','url'=>array('admin')),
);
?>

<h1>Item Sizes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
