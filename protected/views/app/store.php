<div class="row-fluid">
  <div class="span12">
    <div class="row-fluid">
      <div class="span6">
       <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	 'id'=>'menu-items-form',
 	 'enableAjaxValidation'=>false,
       )); ?>
       <?php echo $form->textFieldRow($store,'name',array('class'=>'span4','maxlength'=>100)); ?><br>
       <?php echo $form->textFieldRow($store,'contact_name',array('class'=>'span4','maxlength'=>100)); ?><br>
       <?php echo $form->textFieldRow($store,'contact_no',array('class'=>'span4','maxlength'=>100)); ?><br>
       <?php echo $form->textFieldRow($store,'address',array('class'=>'span6','maxlength'=>100)); ?><br>
      </div>
      <div class="span6">
       <h2>Store Hours</h2>
        <h5>Monday</h5>
        From:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[0][0]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[0])?$shrs[0]->open_time:'',
          )
        );?>
        To:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[0][1]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[0])?$shrs[0]->close_time:'',
          )
        );?>
        <h5>Tuesday</h5>
        From:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[1][0]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[1])?$shrs[1]->open_time:'',
          )
        );?>
        To:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[1][1]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[1])?$shrs[1]->close_time:'',
          )
        );?>
        <h5>Wednesday</h5>
        From:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[2][0]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[2])?$shrs[2]->open_time:'',
          )
        );?>
        To:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[2][1]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[2])?$shrs[2]->close_time:'',
          )
        );?>
        <h5>Thursday</h5>
        From:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[3][0]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[3])?$shrs[3]->open_time:'',
          )
        );?>
        To:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[3][1]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[3])?$shrs[3]->close_time:'',
          )
        );?>
        <h5>Friday</h5>
        From:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[4][0]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[4])?$shrs[4]->open_time:'',
          )
        );?>
        To:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[4][1]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[4])?$shrs[4]->close_time:'',
          )
        );?>
        <h5>Saturday</h5>
        From:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[5][0]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[5])?$shrs[5]->open_time:'',
          )
        );?>
        To:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[5][1]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[5])?$shrs[5]->close_time:'',
          )
        );?>
        <h5>Sunday</h5>
        From:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[6][0]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[6])?$shrs[6]->open_time:'',
          )
        );?>
        To:
        <?php $this->widget(
          'bootstrap.widgets.TbTimePicker',
          array(
            'name' => 'store_hours[6][1]',
            'options'=>array('placement'=>'right','showMeridian' => false),
            'value'=>isset($shrs[6])?$shrs[6]->close_time:'',
          )
        );?>
      </div>
    </div>
       <?php $this->widget('bootstrap.widgets.TbButton', array(
	 'buttonType'=>'submit',
	 'type'=>'primary',
 	 'label'=>'Save',
       )); ?>
      <?php $this->endWidget(); ?>
  </div>
</div>
