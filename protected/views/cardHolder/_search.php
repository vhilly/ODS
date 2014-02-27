<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'first_name',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'last_name',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'middle_name',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'gender',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'birth_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'mobile',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'civil_status',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'zip_code',array('class'=>'span5','maxlength'=>4)); ?>

		<?php echo $form->textFieldRow($model,'is_student',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'is_employed',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'occupation',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'company',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'company_school_address',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'card_no',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'date_created',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'start_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'expiration_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'card_type',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
