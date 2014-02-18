<?php
$this->breadcrumbs=array(
	'Menus',
);

$this->menu=array(
array('label'=>'Create Menu','url'=>array('create')),
array('label'=>'Manage Menu','url'=>array('admin')),
);
?>

<h1>Menus</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
