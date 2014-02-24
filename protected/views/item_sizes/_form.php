<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'item-sizes-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
	<?php echo $form->dropDownListRow($model,'size_id',CHtml::listData($sizes,'id','name'),array('class'=>'span3')); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5','maxlength'=>15)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'url'=>$this->createUrl('menu_items/update',array('id'=>$model->item_id)),
			'type'=>'primary',
			'label'=>'Back',
		)); ?>
</div>

<?php $this->endWidget(); ?>
