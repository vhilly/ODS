<?php foreach($riders as $r): ?>
  <a class='curpoint setRider btn btn-primary' data-content=<?=Yii::app()->createUrl('orders/update&id=') ?> data-order_id=<?=$oid?> data-rider_id=<?=$r->id?> data-status_id=2><?=$r->name?></a><br><br>
<?php endforeach?>
