<?php
$this->breadcrumbs=array(
	'Sizes',
);

$this->menu=array(
array('label'=>'Create Sizes','url'=>array('create')),
array('label'=>'Manage Sizes','url'=>array('admin')),
);
?>

<h1>Sizes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
