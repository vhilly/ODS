<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'sizes-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'type',array('item'=>'item','add_on'=>'add on'),array('class'=>'span3')); ?>

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
                        'url'=>Yii::app()->createUrl('sizes/admin'),'label'=>'Cancel'
		)); ?>

<?php $this->endWidget(); ?>
