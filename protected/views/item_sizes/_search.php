<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'item_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'size_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'price',array('class'=>'span5','maxlength'=>15)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
