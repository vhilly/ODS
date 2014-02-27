<h1>Checklists</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'misc-items-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'name',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'','buttonType'=>'link','icon'=>'icon-plus-sign','url'=>Yii::app()->createUrl('miscItems/create'),'label'=>'Add Checklists'));

