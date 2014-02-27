<?php
$this->breadcrumbs=array(
	'Card Holders'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List CardHolder','url'=>array('index')),
array('label'=>'Create CardHolder','url'=>array('create')),
array('label'=>'Update CardHolder','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete CardHolder','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage CardHolder','url'=>array('admin')),
);
?>

<h1>View CardHolder #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'first_name',
		'last_name',
		'middle_name',
		'gender',
		'birth_date',
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
),
)); ?>
