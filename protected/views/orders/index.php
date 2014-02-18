<?php
  Yii::app()->clientScript->registerScript('updateTable', "
  $('.viewAll').click(function(){
  });
  var url = '".Yii::app()->createUrl('orders/incoming')."'
  $('#incoming').load(url);
  setInterval(function(){
    $('#incoming').load(url);
  },5000);
  $(document).on('click','.updateOrder',function(){
    $.ajax({
      url:'".Yii::app()->createUrl('orders/update&id=')."'+$(this).data('order_id')+'&sid='+$(this).data('status_id'),
      success:function(data){
        location.reload();
      },
      error:function(){
        alert(this.url);
      }
    });
    return false;
  });

  
  $('.selectRider').click(function(){
    $('#myModal').modal();
    $('#myModal .modal-header h4').html('Select Rider');
    $('#myModal .modal-footer').html('');
    $('#myModal .modal-body').load('".Yii::app()->createUrl('riders/select&oid=')."'+$(this).data('order_id'));
    return false;
  });
  
  $(document).on('click','.setRider',function(){
    $.ajax({
      url:'".Yii::app()->createUrl('orders/update&id=')."'+$(this).data('order_id')+'&sid='+$(this).data('status_id')+'&rid='+$(this).data('rider_id')+'&rname='+$(this).html(),
      success:function(data){
        location.reload();
      },
      error:function(){
        alert(this.url);
      }
    });
    return false;
  });

  $(document).on('click','.view',function(){
    var url='".Yii::app()->createUrl('orders/view&id=')."'+$(this).data('order_id');
    var target=$(this).data('target');
    $(target).load(url);
    return false;
  });

  $(document).on('click','.btnCall',function(){
     var dest = $(this).data('dest');
     var cid = $(this).data('cid');
     if(confirm('Call '+dest+'')){
       var obj ={};
       obj={action:'Originate',channel:'SIP/'+dest,context:'from-local',exten:cid,async:'true',callerid:'SHAKEYS'};
       now.send_data_to_asterisk(obj);
       e.preventDefault();
     }
  });
  var socket = io.connect('http://172.31.1.112:8000');
  socket.emit('updateOrders');

  ");
?>

<div class="row-fluid">
  <div class="span12">
    <div class="row-fluid">
      <div class="span4">
        <table class='table table-order table-bordered'>
          <tbody>
             <tr class='overall-header'><td colspan=2>Summary for: <?=date('d-m-Y')?></td></tr>
          </tbody>
        </table>
        <div style='position:fixed;width:450px;height:80%;overflow:auto' id=orderDetails></div>
      </div>
      <div class="span8">
        <table class='table table-order table-bordered'>
          <thead>
            <tr class='overall-header'>
              <td colspan=6>INCOMING ORDERS</td>
            </tr>
            <tr class='item-header'>
              <td>Order#</td>
              <td>Action</td>
              <td>Order Info.</td>
              <td>Customer</td>
              <td>Status</td>
              <td>On Queue</td>
              <td>Total Amount</td>
            </tr>
          </thead>
          <tbody id='incoming'>
          </tbody>
        </table>

        <table class='table table-order table-bordered'>
          <thead>
            <tr class='overall-header'>
              <td colspan=6>ACCEPTED ORDERS</td>
            </tr>
            <tr class='item-header'>
              <td>Order#</td>
              <td>Action</td>
              <td>Order Info.</td>
              <td>Customer</td>
              <td>Status</td>
              <td>In Branch</td>
              <td>Total Amount</td>
            </tr>
          </thead>
          <tbody>
          <?php foreach($accepted as $a):?>
            <tr>
              <td><?=$a->id?></td>
              <td><?=CHtml::link('Driver Out','#',array('class'=>'selectRider btn','data-order_id'=>$a->id, 'data-target'=>'#orderDetails'))?>
               <?=CHtml::link('Canceled','#',array('class'=>'updateOrder btn','data-order_id'=>$a->id,'data-status_id'=>-1,
               'data-target'=>'#orderDetails'))?>
              </td>
              <td><?=CHtml::link('View Details','#',array('class'=>'view btn','data-order_id'=>$a->id,'data-target'=>'#orderDetails'))?></td>
              <td><?=$a->customer->name?></td>
              <td>On Queue</td>
              <td><?=$a->branch_name?></td>
              <td><?=$a->total_amt?></td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>

        <table class='table table-order table-bordered'>
          <thead>
            <tr class='overall-header'>
              <td colspan=6>DRIVER OUT ORDERS</td>
            </tr>
            <tr class='item-header'>
              <td>Order#</td>
              <td>Action</td>
              <td>Order Info.</td>
              <td>Customer</td>
              <td>Driver Out</td>
              <td>Rider Name</td>
              <td>Total Amount</td>
            </tr>
          </thead>
          <tbody>
          <?php foreach($driverOut as $d):?>
            <tr>
              <td><?=$d->id?></td>
              <td><?=CHtml::link('Delivered','#',array('class'=>'updateOrder btn','data-order_id'=>$d->id,'data-status_id'=>4,
               'data-target'=>'#orderDetails'))?>
               <?=CHtml::link('Returned','#',array('class'=>'updateOrder btn','data-order_id'=>$d->id,'data-status_id'=>-2,
               'data-target'=>'#orderDetails'))?>
              </td>
              <td><?=CHtml::link('View Details','#',array('class'=>'view btn','data-order_id'=>$d->id,'data-target'=>'#orderDetails'))?></td>
              <td><?=$d->customer->name?></td>
              <td><?=$d->date_updated?></td>
              <td><?=$d->rider0->name?></td>
              <td><?=$d->total_amt?></td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>

        <table class='table  table-order table-bordered'>
          <thead>
            <tr class='overall-header'>
              <td colspan=7>ADVANCE ORDERS</td>
            </tr>
            <tr class='item-header'>
              <td>Order#</td>
              <td>Action</td>
              <td>Order Info.</td>
              <td>Customer</td>
              <td>Status</td>
              <td>Preparation Time</td>
              <td>On Queue</td>
              <td>Total Amount</td>
            </tr>
          <?php foreach($advance as $ad):?>
            <tr>
              <td><?=$ad->id?></td>
              <td><?=CHtml::link('Driver Out','#',array('class'=>'selectRider btn','data-order_id'=>$ad->id, 'data-target'=>'#orderDetails'))?>
               <?=CHtml::link('Canceled','#',array('class'=>'updateOrder btn','data-order_id'=>$ad->id,'data-status_id'=>-1,
               'data-target'=>'#orderDetails'))?>
              </td>
              <td><?=CHtml::link('View Details','#',array('class'=>'view btn','data-order_id'=>$ad->id,'data-target'=>'#orderDetails'))?></td>
              <td><?=$ad->customer->name?></td>
              <td></td>
              <td><?=$ad->date_ordered?></td>
              <td><?=$ad->date_updated?></td>
              <td><?=$ad->total_amt?></td>
            </tr>
          <?php endforeach;?>
          </thead>
        </table>

        <table id='churba' class='table table-order table-bordered'>
          <thead>
            <tr class='overall-header'>
              <td colspan=6>CANCELED ORDERS</td>
            </tr>
            <tr class='item-header'>
              <td>Order#</td>
              <td>Order Info.</td>
              <td>Customer</td>
              <td>Status</td>
              <td>As Of</td>
              <td>Total Amount</td>
            </tr>
          </thead>
          <?php foreach($cancel as $c):?>
          <tbody>
            <tr>
              <td><?=$c->id?></td>
              <td><?=CHtml::link('View Details','#',array('class'=>'view btn','data-order_id'=>$c->id,'data-target'=>'#orderDetails'))?></td>
              <td><?=$c->customer->name?></td>
              <td>Canceled	</td>
              <td><?=$c->date_updated?></td>
              <td><?=$c->total_amt?></td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
