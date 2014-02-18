<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'menu_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'price',array('class'=>'span5','maxlength'=>15)); ?>

		<?php echo $form->textFieldRow($model,'img',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'is_available',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'date_created',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'date_updated',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'deleted',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
