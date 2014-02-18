<?php
$this->breadcrumbs=array(
	'Menu Items',
);

$this->menu=array(
array('label'=>'Create MenuItems','url'=>array('create')),
array('label'=>'Manage MenuItems','url'=>array('admin')),
);
?>

<h1>Menu Items</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
