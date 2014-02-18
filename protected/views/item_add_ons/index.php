<?php
$this->breadcrumbs=array(
	'Item Add Ons',
);

$this->menu=array(
array('label'=>'Create ItemAddOns','url'=>array('create')),
array('label'=>'Manage ItemAddOns','url'=>array('admin')),
);
?>

<h1>Item Add Ons</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
