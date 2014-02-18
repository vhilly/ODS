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
  <h6>DATE: <?=$o->date_ordered?> BRANCH: <?=$o->branch->name?></h6>
  <table class='table  table-order table-bordered'>
    <thead>
      <tr class=overall-header>
        <th colspan=5><center>Order Details</center></th>
      </tr>
      <tr class='item-header'>
        <th>Description</th>
        <th>Qty</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($o->orderItems as $oi):?>
      <tr>
        <td><?=$oi->menuItem->description?></td>
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
  <?php endforeach;?>
<?php endif;?>
