<?php
$this->breadcrumbs=array(
	'Card Holders'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List CardHolder','url'=>array('index')),
array('label'=>'Create CardHolder','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('card-holder-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Card Holders</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'card-holder-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'first_name',
		'last_name',
		'middle_name',
		'gender',
		'birth_date',
		/*
		'phone',
		'mobile',
		'civil_status',
		'address',
		'email',
		'zip_code',
		'is_student',
		'is_employed',
		'occupation',
		'company',
		'company_school_address',
		'card_no',
		'date_created',
		'start_date',
		'expiration_date',
		'card_type',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
