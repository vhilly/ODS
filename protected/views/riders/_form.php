<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'test',
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>true,
        'validateOnType'=>true,
    ),
)); ?>

  <p class="help-block">Fields with <span class="required">*</span> are required.</p>

  <?php echo $form->errorSummary($model); ?>

  <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>
  <?php echo $form->textFieldRow($model,'contact_no',array('class'=>'span5','maxlength'=>255)); ?>
  <br>
  <?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
      'type'=>'primary',
       'buttonType'=>'ajaxSubmit',
       'htmlOptions'=>array('id'=>'ajaxSubmit','style'=>'display:none'),
       'ajaxOptions' => array('success' => 'function(data){
         if(data){
           var obj= $.parseJSON(data);
           if(obj==""){
             alert("Rider added sucessfully!");
             $("#modalClose").click();
           }
         }
       }'),
       'url' => Yii::app()->createUrl('riders/create'),
      'label'=>'Save',
  )); ?>
<?php $this->endWidget(); ?>
