<?php foreach($riders as $r): ?>
  <a class='curpoint setRider' data-order_id=<?=$oid?> data-rider_id=<?=$r->id?> data-status_id=2><?=$r->name?></a><br>
<?php endforeach?>