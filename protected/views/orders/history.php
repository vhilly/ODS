<?php if($cust):?>
  <span style=display:none id=customer_id><?=$cust->id?></span>
  <table class='table table-condensed table-bordered'>
    <tr class=overall-header>
      <td colspan=2><center>Customer Info:</center></td>
    </tr>
    <tr>
      <td>Telephone Number</td>
      <td><?=$cust->phone_1?></td>
    </tr>
    <tr>
      <td>Customer Name</td>
      <td id=customer_name><?=$cust->name?></td>
    </tr>
    <tr>
      <td>Customer Address</td>
      <td id=customer_address><?=$cust->address?></td>
    </tr>
    <tr>
      <td>Frequent Food Order</td>
      <td><?=implode(',',array_map('array_shift',$freq));?></td>
    </tr>
  </table>
  <?php foreach($orders as $o):?>
  <h6 <?=($o->status<4 && $o->status>-1)?'style=color:red':''?>>DATE: <?=$o->date_ordered?> BRANCH: <?=$o->branch->name?></h6>
  <table class='table  table-order table-bordered'>
    <thead>
      <?php if($o->status<4 && $o->status>-1):?>
      <tr class=overall-header>
          <th colspan=1><center>Pending Order</center></th>
          <th colspan=2><a class='btn followUp' data-order_id=<?=$o->id?> data-target=<?=$this->createUrl('follow_up&id=')?>>Follow Up</a></th>
      </tr>
      <?php else:?>
      <tr class=green>
          <th colspan=3><center>Order Details</center></th>
      </tr>
      <?php endif;?>
      <tr class='item-header'>
        <th>Description</th>
        <th>Qty</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($o->orderItems as $oi):?>
      <tr>
        <td>
          <?=$oi->menuItem->description?>
          <?=$oi->size?'('.$oi->size0->name.')':''?>
          <?php if($oi->addOns):?>
            <?php foreach($oi->addOns as $ao):?>
              (<?=$ao->addOn->size->name?>
              <?=$ao->addOn->addOn->description?>)
            <?php endforeach;?>
          <?php endif;?>
        </td>
        <td><?=$oi->qty?></td>
        <td><?=number_format($oi->price,2)?></td>
      </tr>
      <?php ?>
    <?php endforeach;?>
    </tbody>
    <tfoot>
      <tr class=green>
        <td colspan=2><center>Grand Total</center></td>
        <td><?=$o->total_amt?></td>
      </tr>
    </tfoot>
  </table>
  <p>
  Remarks:<?=$o->remarks?>
  </p>
  <p>
  Special Instructions:<?=$o->special_instruction?>
  </p>
  <?php endforeach;?>
<?php endif;?>
