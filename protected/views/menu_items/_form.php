<?php
  Yii::app()->clientScript->registerScript('updateTable', "
  $('#hasSize').change(function(){
    if(this.checked)
      $('#price').val(0);
     
    $('#price_holder').toggle();
  });
  
  $('.deleteThis').click(function(){
    if(confirm('Are You Sure?')){
      $.post($(this).data('target'),function(){
        window.location.reload();
      });
    }
  });
  ");
?>
<div class="row-fluid">
  <div class="span12">
    <div class="row-fluid well">
      <div class="span8">
       <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	 'id'=>'menu-items-form',
         'htmlOptions'=>array('class'=>'well'),
 	 'enableAjaxValidation'=>false,
       )); ?>

       <?php echo $form->errorSummary($model); ?>

       <?php echo $form->dropDownListRow($model,'menu_id',CHtml::listData($menu,'id','description'),array('class'=>'span3')); ?>

       <?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>100)); ?><br>

       <?php echo $form->checkBox($model,'per_size',array('id'=>'hasSize')); ?>Price depends on size<Br><br>
       <div id=price_holder style=<?=$model->per_size?'display:none':''?>>
  	 <?php echo $form->textFieldRow($model,'price',array('class'=>'span3','id'=>'price','maxlength'=>15)); ?>
       </div>
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
       </table>
      </div>
      <?php if(!$model->isNewRecord):?>
      <?php if($model->per_size):?>
      <div class="span8">
         <table class='table table-order'>
           <thead>
             <tr class='overall-header'>
               <th colspan=3>Sizes</th>
             </tr>
           </thead>
           <tbody>
             <?php foreach($model->itemSizes as $s):?>
             <?php if($s->deleted==1){continue;}?>
             <tr>
               <td><?=$s->size->name?></td>
               <td><?=$s->price?></td>
               <td><a class='btn deleteThis' data-target=<?=$this->createUrl('item_sizes/delete',array('id'=>$s->id))?>> <i class=icon-trash></i></a></td>
             </tr>
             <?php endforeach;?>
             <tr>
               <td>
               <?php $this->widget('bootstrap.widgets.TbButton', array(
	         'buttonType'=>'link',
                 'url'=>$this->createUrl('item_sizes/create',array('iid'=>$model->id)),
	         'type'=>'success',
	         'label'=>'Add',
                )); ?>
               </td>
             </tr>
           </tbody>
         </table>
      </div>
      <?php endif;?>
      <div class="span8">
         <table class='table table-order'>
           <thead>
             <tr class='overall-header'>
               <th colspan=2>Add Ons</th>
             </tr>
           </thead>
           <tbody>
             <?php foreach($model->itemAddOns as $a):?>
             <?php if($a->deleted==1){continue;}?>
             <tr>
               <th><?=$a->addOn->description?></th>
               <td><a class='btn deleteThis' data-target=<?=$this->createUrl('item_add_ons/delete',array('id'=>$a->id))?>> <i class=icon-trash></i></a></td>
             </tr>
             <?php endforeach;?>
             <tr>
               <td>
               <?php $this->widget('bootstrap.widgets.TbButton', array(
	         'buttonType'=>'link',
                 'url'=>$this->createUrl('item_add_ons/create',array('iid'=>$model->id)),
	         'type'=>'success',
	         'label'=>'Add',
               )); ?>
               </td>
             </tr>
           </tbody>
         </table>
      </div>

      <div class="span8">
         <table class='table table-order'>
           <thead>
             <tr class='overall-header'>
               <th colspan=3>Item Checklist</th>
             </tr>
           </thead>
           <tbody>
             <?php foreach($model->itemCheckList as $c):?>
             <?php if($c->deleted==1){continue;}?>
             <tr>
               <td><?=$c->miscItem->name?></td>
               <td><?=$c->qty?> pcs</td>
               <td><a class='btn deleteThis' data-target=<?=$this->createUrl('item_checklist/delete',array('id'=>$c->id))?>> <i class=icon-trash></i></a></td>
             </tr>
             <?php endforeach;?>
             <tr>
               <td>
               <?php $this->widget('bootstrap.widgets.TbButton', array(
	         'buttonType'=>'link',
                 'url'=>$this->createUrl('item_checklist/create',array('iid'=>$model->id)),
	         'type'=>'success',
	         'label'=>'Add',
               )); ?>
               </td>
             </tr>
           </tbody>
         </table>
      </div>
      <?php endif;?>
    </div>

  </div>
</div>
