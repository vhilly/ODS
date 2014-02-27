<h1>Add Ons</h1>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'add-ons-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'name',
		'description',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
'viewButtonUrl'=>null,
),
),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'','buttonType'=>'link','icon'=>'icon-plus-sign','url'=>Yii::app()->createUrl('addOns/create'),'label'=>'Add Add Ons'));

