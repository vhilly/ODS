<?php
$this->breadcrumbs=array(
	'Order Items'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List OrderItems','url'=>array('index')),
array('label'=>'Manage OrderItems','url'=>array('admin')),
);
?>

<h1>Create OrderItems</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>