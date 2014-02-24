<?php
  Yii::app()->bootstrap->registerPackage('x-editable');
  Yii::app()->bootstrap->registerPackage('select2');
?>
<div class="row-fluid">
  <div class="span12">
    <div class="row-fluid">
      <div class="span7">
        <table class="table table-order  table-condensed">
          <tbody>
            <tr class=overall-header>
               <td colspan=4><center>Assigned Branch:</center></td>
            </tr>
            <tr>
               <td colspan=4>
                 <center>
                 <?=CHtml::dropDownList('branch','',CHtml::listData($branches,'id','name'),array('id'=>'branch','empty'=>'--------'))?>
                 </center>
               </td>
            </tr>
            <tr class=overall-header>
               <td colspan=4><center>Customer Info:</center></td>
            </tr>
            <tr>
               <td>Telephone Number</td>
               <td><input type=text id=customerPhone1 data-target=<?=$this->createUrl('orders/history&cid=')?>></td>
               <td>Customer Name</td>
               <td>
                 <input type=text id=customerName>
                 <input type=hidden id=customerID value=0>
               </td>
            </tr>
            <tr>
               <td>
                 Customer Address
               </td>
               <td colspan=3>
                 <input type=text id=customerAddress class=span7>
                 <input type=hidden id=customerGeocode class=span10 readonly=true>
                 <?php $this->widget(
                 'bootstrap.widgets.TbButton',
                 array(
                   'label' => 'Store Locator',
                   'icon' => 'map-marker',
                   'htmlOptions' => array('id'=>'btnShowMap','data-target'=>$this->createUrl('map')),
                 ));?>
               </td>
            </tr>
          </tbody>
        </table>
        <div id=orderListHolder data-target='<?=$this->createUrl('order_list')?>'></div>
        <table class='table table-order'>
            <tr>
               <td>Special Instruction</td>
               <td><input type=text id=orderSI class=span10></td>
            </tr>
            <tr>
               <td>Remarks</td>
               <td><input type=text id=orderRemarks class=span10></td>
            </tr>
            <tr>
               <td>Bill Change</td>
               <td><input type=text id=orderBillChange class=span2></td>
            </tr>
        </table>
        <table class=''>
            <tr>
               <td>Delivery Date:</td>
               <td>
       <?php $this->widget(
	 'bootstrap.widgets.TbDatePicker',
	 array(
	   'name' => 'delivery_date',
	   'options'=>array('autoclose'=>true,'format'=>'yyyy-mm-dd'),
	   'htmlOptions'=>array('id'=>'delivery_date'),
	 )
       );?>
               </td>
               <td>Delivery Time:</td>
               <td>
               <?php $this->widget(
                 'bootstrap.widgets.TbTimePicker',
                 array(
                   'name' => 'delivery_time',
                   'options'=>array('placement'=>'right','showMeridian' => false),
                   'htmlOptions'=>array('id'=>'delivery_time'),
                 )
               );?>
               </td>
            </tr>
        </table>
      </div>
      <div class="span5">
        <ul class=box-span>
          <?php foreach($menu as $m):?>
          <li>
            <button class="btn span3 btnCategory btn-large btn-primary" disabled=true data-target=<?=$this->createUrl('menu_items/index&menu_id=')?> data-menu_id=<?=$m->id?>>
              <i class="label label-important"><?=$m->description?></i><br>
            </button>
          </li>
          <?php endforeach;?>
        </ul><br>
        <div id=menuHolder></div>
      </div>
    </div>
  </div>
</div>
<?php $this->widget(
  'bootstrap.widgets.TbButton',
  array(
    'label' => 'Place Order',
    'type' => 'success',
    'htmlOptions' => array('id'=>'btnPO','data-target'=>$this->createUrl('place_order')),
  )
);?>
<?php $this->renderPartial('_orderModal')?>
