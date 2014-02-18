<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'customers-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'phone_1',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'phone_2',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'geocode',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'note',array('class'=>'span5','maxlength'=>255)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
