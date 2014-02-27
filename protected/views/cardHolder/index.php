<?php
$this->breadcrumbs=array(
	'Card Holders',
);

$this->menu=array(
array('label'=>'Create CardHolder','url'=>array('create')),
array('label'=>'Manage CardHolder','url'=>array('admin')),
);
?>

<h1>Card Holders</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
