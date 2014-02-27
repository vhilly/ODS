<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'add-ons-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span3','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span3','maxlength'=>100)); ?>
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
                        'url'=>Yii::app()->createUrl('addOns/admin'),'label'=>'Cancel'
		)); ?>

<?php $this->endWidget(); ?>
