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
              <td><?=CHtml::link('Driver Out','#',array('class'=>'selectRider btn','data-order_id'=>$a->id, 'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('riders/select&oid=')))?>
               <?=CHtml::link('Canceled','#',array('class'=>'updateOrder btn','data-order_id'=>$a->id,'data-status_id'=>-1,
               'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('orders/update&id=')))?>
              </td>
              <td><?=CHtml::link('View Details','#',array('class'=>'view btn','data-order_id'=>$a->id,'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('orders/view&id=')))?>
</td>
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
               'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('orders/update&id=')))?>
               <?=CHtml::link('Returned','#',array('class'=>'updateOrder btn','data-order_id'=>$d->id,'data-status_id'=>-2,
               'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('orders/update&id=')))?>
              </td>
              <td><?=CHtml::link('View Details','#',array('class'=>'view btn','data-order_id'=>$d->id,'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('orders/view&id=')))?>
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
              <td><?=CHtml::link('Driver Out','#',array('class'=>'selectRider btn','data-order_id'=>$ad->id, 'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('riders/select&oid=')))?>
               <?=CHtml::link('Canceled','#',array('class'=>'updateOrder btn','data-order_id'=>$ad->id,'data-status_id'=>-1,
               'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('orders/update&id=')))?>
              </td>
              <td><?=CHtml::link('View Details','#',array('class'=>'view btn','data-order_id'=>$ad->id,'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('orders/view&id=')))?>
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
              <td><?=CHtml::link('View Details','#',array('class'=>'view btn','data-order_id'=>$c->id,'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('orders/view&id=')))?>
              <td><?=$c->customer->name?></td>
              <td>Canceled	</td>
              <td><?=$c->date_updated?></td>
              <td><?=$c->total_amt?></td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>
