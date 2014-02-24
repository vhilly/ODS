          <?php foreach($incoming as $i):?>
            <tr>
              <td><?=$i->id?></td>
              <td><?=CHtml::link('Accept','#',array('class'=>'updateOrder btn','data-order_id'=>$i->id,'data-status_id'=>1,
               'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('orders/update&id=')))?>
               <?=CHtml::link('Canceled','#',array('class'=>'updateOrder btn','data-order_id'=>$i->id,'data-status_id'=>-1,
               'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('orders/update&id=')))?>
              </td>
              <td><?=CHtml::link('View Details','#',array('class'=>'view btn','data-order_id'=>$i->id,'data-target'=>'#orderDetails','data-content'=>Yii::app()->createUrl('orders/view&id=')))?>
              <td><?=$i->customer->name?></td>
              <td>On Queue</td>
              <td><?=date('G:iA  Y-m-d',strtotime($i->date_ordered))?></td>
              <td><?=$i->total_amt?></td>
            </tr>
          <?php endforeach;?>
