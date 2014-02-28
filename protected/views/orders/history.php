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
    <tr>
      <td>Average Spending</td>
      <td>P<?=number_format($avg[0],2)?></td>
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
    <?php $st=0;$totalDiscount=0;?>
    <?php foreach($o->orderItems as $oi):?>
    <?php $st+=$oi->price;?>
    <?php $totalDiscount+=$oi->discount;?>
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
    <?php endforeach;?>
    <?php
      $totalCharges=$st * ($charges/100.0);
      $preTax= $st+$totalCharges;
      $VAT=$preTax * ($tax/100.0);
      $grandTotal=$preTax + $VAT;
    ?>
    </tbody>
    <tfoot>
      <tr class=red>
        <td colspan=2>Subtotal</td>
        <td><?=number_format($st,2)?></td>
      </tr>
      <tr class=green>
        <td colspan=2>Charges (<?=$charges?>%)</td>
        <td><?=number_format($totalCharges,2)?></td>
      </tr>
      <tr class=red>
        <td colspan=2>Total Discount</td>
        <td colspan=2><?=number_format($totalDiscount,2)?></td>
      </tr>
      <tr class=green>
        <td colspan=2>VAT (<?=$tax?>%)</td>
        <td><?=number_format($VAT,2)?></td>
      </tr>
      <tr class=red>
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
