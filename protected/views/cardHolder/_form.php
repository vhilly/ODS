<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'card-holder-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'first_name',array('class'=>'span3','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'last_name',array('class'=>'span3','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'middle_name',array('class'=>'span3','maxlength'=>100)); ?>

	<?php echo $form->dropDownListRow($model,'gender',array('Male'=>'Male','Female'=>'Female'),array('class'=>'span3')); ?>

	<?php echo $form->datePickerRow($model,'birth_date', array('append'=>'<i class="icon-calendar" style="cursor:pointer"></i>','class'=>'span3','options'=>array( 'format' => 'yyyy-mm-dd')));?>

	<?php echo $form->textFieldRow($model,'card_no',array('class'=>'span3','maxlength'=>100)); ?>

	<?php echo $form->datePickerRow($model,'start_date', array('append'=>'<i class="icon-calendar" style="cursor:pointer"></i>','class'=>'span3','options'=>array( 'format' => 'yyyy-mm-dd')));?>

	<?php echo $form->datePickerRow($model,'expiration_date', array('append'=>'<i class="icon-calendar" style="cursor:pointer"></i>','class'=>'span3','options'=>array( 'format' => 'yyyy-mm-dd')));?>

	<?php echo $form->dropDownListRow($model,'card_type',CHtml::listData(PromoCards::model()->findAll(),'id','name'),array('class'=>'span3')); ?>

<br><br>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
                        'type'=>'danger',
                        'buttonType'=>'link',
                        'icon'=>'',
                        'url'=>Yii::app()->createUrl('cardHolder/admin'),'label'=>'Cancel'
		)); ?>

<?php $this->endWidget(); ?>
