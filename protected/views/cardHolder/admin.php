<h1>Card Holders</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'card-holder-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
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
		*/
		'card_no',
		'date_created',
		'start_date',
		'expiration_date',
//		'card_type',
		
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
'viewButtonUrl'=>null,
),
),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'','buttonType'=>'link','icon'=>'icon-plus-sign','url'=>Yii::app()->createUrl('cardHolder/create'),'label'=>'Add Card Holder'));

