<?php

  Yii::app()->bootstrap->registerPackage('x-editable');
  Yii::app()->bootstrap->registerPackage('select2');
  Yii::app()->clientScript->registerScript('orderTaker', "
  $('#btnShowMap').click(function(){
    return windowpop('".Yii::app()->createUrl('app/map')."', 1000, 600);
  });
  $('#branch').change(function(){
    if($(this).val())
      $('.btnCategory').prop('disabled',false);
    else
      $('.btnCategory').prop('disabled',true);
    $('#menuHolder').html('');
  });
  $('#customerPhone1').change(function(){
    $.ajax({
      url:'".Yii::app()->createUrl('orders/history&cid=')."'+$(this).val(),
      success:function(data){
        if(data !=''){
          $('#myModal .modal-body').html(data);
          $('#myModal .modal-header h4').html('Order History');
          $('#myModal .modal-footer').html('<button class=btn data-dismiss=modal>Close</button>');
          $('#myModal').modal();
          $('#customerName').val($('#myModal .modal-body #customer_name').html());
          $('#customerAddress').val($('#myModal .modal-body #customer_address').html());
          $('#customerID').val($('#myModal .modal-body #customer_id').html());

        }
      },
      error:function(){
        alert(this.url);
      }
    });
  });

  ");
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
               <td><input type=text id=customerPhone1></td>
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
                   'htmlOptions' => array('id'=>'btnShowMap'),
                 ));?>
               </td>
            </tr>
          </tbody>
        </table>
        <div id=orderListHolder></div>
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
            <button class="btn span3 btnCategory btn-large btn-primary" disabled=true data-menu_id=<?=$m->id?>>
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
    'htmlOptions' => array('id'=>'btnPO'),
  )
);?>
<?php $this->renderPartial('_orderModal')?>
<script>
  function updateOrderList(){
    $.ajax({ url:'<?php echo Yii::app()->createUrl('app/order_list')?>',success:function(data){
       $('#orderListHolder').html(data);
    },cache:false});
  };
  function clearData(){
    $('#branch').val('');
    $('#branch').change();
    $('#orderRemarks').val('');
    $('#orderSI').val('');
    $('#orderBillChange').val('');
    $('#customerID').val('');
    $('#customerName').val('');
    $('#customerPhone1').val('');
    $('#customerAddress').val('');
    $('#delivery_date').val('');
    $('#delivery_time').val('');
  };
  window.onload = function() {
  $('.btnCategory').click(function(){
    $.ajax({
      url:'<?php echo Yii::app()->createUrl('menu_items/getAll&menu_id=')?>'+$(this).data('menu_id')+'&bid='+$('#branch').val(),
      success:function(data){
       $('#menuHolder').html(data);
      },
      error:function(){
        alert(this.url);
      }
    });
   });
  $(document.body).on("click", '.deleteOrder', function(){
    if(confirm('Are you sure?')){
      $.ajax({
        url:'<?php echo Yii::app()->createUrl('app/order_delete&id=')?>'+$(this).data('order_id'),
        success:function(data){
         location.reload();
        },
        error:function(){
         alert(this.url);
        }
      });
    }
   });
  $(document.body).on("click", '.itemSelect', function(){
    var header=$(this).data('prod_name');
    $.ajax({
      url:'<?php echo Yii::app()->createUrl('app/order_details&iid=')?>'+$(this).data('prod_id'),
      success:function(data){
    $('#orderModal .modal-body').html('');
       $('#orderModal .modal-body').html(data);
       $('#orderModal .modal-header h4').html(header);
       $('#orderModal').modal();
      },
      error:function(){
        alert(this.url);
      }
    });
   });
  //place order
  $(document.body).on("click", '#btnPO', function(){
     if(!$('#customerName').val() || !$('#customerPhone1').val() || !$('#customerAddress').val()){
       alert('Please enter complete customer details');
       return false;
     }
     if(!$("#currentOrders tr").html()){
         alert('There\'s no item in the orderlist!');
         return false;
     }
     if(!$('#branch').val()){
       alert('Please select branch!');
       return false;
     }
     if(confirm('Are you sure?')){
       if($("#currentOrders tr").html()){
        var order ={bid:$('#branch').val(),bname:$('#branch option:selected').text(),remarks:$('#orderRemarks').val(),si:$('#orderSI').val(),bchange:$('#orderBillChange').val(),
         delivery_date:$('#delivery_date').val(),delivery_time:$('#delivery_time').val()}
        var customer = {id:$('#customerID').val(),name:$('#customerName').val(),phone1:$('#customerPhone1').val(),address:$('#customerAddress').val(),geocode:$('#customerGeocode').val()};
        $.post( "<?=Yii::app()->createUrl('app/place_order')?>", 
         { customer:customer,order:order }).done(function( data ) {
          alert(  data );
          updateOrderList();
          clearData();
          socket.emit('updateOrders');
          socket.emit('updateSeries',[order.bid,new Date().getHours()]);
        }).fail(function(data){
          console.log(data)
        });
       }
     }
  });
  var socket = io.connect('http://ryouko.imperium.jp:8000');
  }
  function windowpop(url, width, height) {
    var leftPosition, topPosition;
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    window.open(url, "map", "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + 
     leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=yes,location=no,directories=no");
  }
  updateOrderList();
</script>
