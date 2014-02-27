<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'menu-form',
	'enableAjaxValidation'=>false,
)); ?>


<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span3','maxlength'=>100)); ?>
<br>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
         <?php $this->widget('bootstrap.widgets.TbButton', array(
	   'buttonType'=>'link',
	   'url'=>$this->createUrl('app/menu'),
	   'type'=>'primary',
 	   'label'=>'Back',
         )); ?>

<?php $this->endWidget(); ?>
