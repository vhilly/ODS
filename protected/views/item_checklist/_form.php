<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'item-checklist-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>


<?php echo $form->dropDownListRow($model,'misc_item_id',CHtml::listData($misc,'id','name'),array('class'=>'span2')); ?>

<?php echo $form->textFieldRow($model,'qty',array('class'=>'span1')); ?>

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
