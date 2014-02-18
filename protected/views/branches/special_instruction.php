<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'si-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>true,
        'validateOnType'=>true,
    ),
)); ?>

  <p class="help-block">Fields with <span class="required">*</span> are required.</p>

  <?php echo $form->textAreaRow($model,'special_instructions',array('class'=>'span3','maxlength'=>255)); ?>
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
             alert("Special instructions has been saved!");
             $("#modalClose").click();
           }
         }
       }'),
       'url' => Yii::app()->createUrl('branches/special_instruction'),
      'label'=>'Save',
  )); ?>
<?php $this->endWidget(); ?>
