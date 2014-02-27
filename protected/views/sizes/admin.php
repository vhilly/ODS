<h1>Sizes</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'sizes-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'type',
		'name',
		'description',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
'viewButtonUrl'=>null,
),
),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'','buttonType'=>'link','icon'=>'icon-plus-sign','url'=>Yii::app()->createUrl('sizes/create'),'label'=>'Add Sizes'));

