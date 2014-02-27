<?php
$this->breadcrumbs=array(
	'Add Ons'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List AddOns','url'=>array('index')),
array('label'=>'Manage AddOns','url'=>array('admin')),
);
?>

<h1>Add Add Ons</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
