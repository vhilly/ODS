<?php
$this->breadcrumbs=array(
	'Misc Items',
);

$this->menu=array(
array('label'=>'Create MiscItems','url'=>array('create')),
array('label'=>'Manage MiscItems','url'=>array('admin')),
);
?>

<h1>Misc Items</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
