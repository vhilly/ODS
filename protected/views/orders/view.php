<table class='table  table-order table-bordered'>
  <thead>
    <tr class=overall-header>
      <th colspan=4><center>Customer Info</center></th>
    </tr>
    <tr>
      <td>Telephone Number:</td>
      <td colspan=3><button class="btn btn-success btnCall" data-dest="<?=$orders->customer->phone_1?>" data-cid="1002">
        <i class=icon-phone-sign></i> <?=$orders->customer->phone_1?></button>
      </td>
    </tr>
    <tr>
      <td>Customer Name:</td>
      <td colspan=3><?=$orders->customer->name?></td>
    </tr>
    <tr>
      <td>Customer Address:</td>
      <td colspan=3><?=$orders->customer->address?></td>
    </tr>
    <tr class=overall-header>
      <th colspan=5><center>Order # <?=$orders->id?></center></th>
    </tr>
    <?php if($orders->card_no):?>
    <tr>
      <td colspan=2 bgcolor=#0099FF><?=$orders->cardNo->card->name?></td><td bgcolor=#0099FF><button class="btn btn-inverse btnCardHolder" data-card_no=<?=$orders->card_no?> data-target=<?=$this->createUrl('app/verify_card&card_no=')?>>#<?=$orders->card_no?></button></td>
    </tr>
    <?php endif;?>
    <tr class='item-header'>
      <th>Description</th>
      <th>Qty</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <?php $checkList=array();?>
    <?php foreach($orders->orderItems as $o):?>
    <?php if($o->itemCheckList):?>
    <?php if(!isset($checkList[$o->itemCheckList->miscItem->name])){$checkList[$o->itemCheckList->miscItem->name]=0;}?>
    <?php $checkList[$o->itemCheckList->miscItem->name]+=$o->itemCheckList->qty*$o->qty;?>
    <?php endif;?>
    <tr>
      <td>
        <?=$o->menuItem->description?>
        <?=$o->size?'('.$o->size0->name.')':''?>
        <?php if($o->addOns):?>
          <?php foreach($o->addOns as $ao):?>
            (<?=$ao->addOn->size->name?>
            <?=$ao->addOn->addOn->description?>)
          <?php endforeach;?>
        <?php endif;?>
      </td>
      <td><?=$o->qty?></td>
      <td><?=number_format($o->price,2)?></td>
    </tr>
    <?php ?>
    <?php endforeach;?>
  </tbody>
  <tfoot>
    <tr class=red>
      <td colspan=2><center>Subtotal</center></td>
      <td><?=$orders->sub_total?></td>
    </tr>
    <tr class=green>
      <td colspan=2><center>Charges</center></td>
      <td><?=$orders->total_charges?></td>
    </tr>
    <tr class=red>
      <td colspan=2><center>Discount</center></td>
      <td><?=$orders->total_discount?></td>
    </tr>
    <tr class=green>
      <td colspan=2><center>VAT</center></td>
      <td><?=$orders->tax?></td>
    </tr>
    <tr class=red>
      <td colspan=2><center>Grand Total</center></td>
      <td><?=$orders->total_amt?></td>
    </tr>
  </tfoot>
</table>
<p>
Special Instructions:<?=$orders->special_instruction?>
<br>
Remarks:<?=$orders->remarks?>
<br>
Bill Change:<?=$orders->bill_change?>
</p>
Item Checklist:<br>
<?php foreach($checkList as $k=>$c):?>
  <?=$c.' '.$k?><br>
<?php endforeach;?>
