<?php
$this->breadcrumbs=array(
	'Card Holders'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List CardHolder','url'=>array('index')),
array('label'=>'Manage CardHolder','url'=>array('admin')),
);
?>

<h1>Create CardHolder</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>