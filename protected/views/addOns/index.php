<?php
$this->breadcrumbs=array(
	'Add Ons',
);

$this->menu=array(
array('label'=>'Create AddOns','url'=>array('create')),
array('label'=>'Manage AddOns','url'=>array('admin')),
);
?>

<h1>Add Ons</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
