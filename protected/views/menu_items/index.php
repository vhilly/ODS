<?php
    $row='';
    foreach($menuItems as $m){
      $row .= '<li><button class="btn span3 itemSelect btn-large" data-prod_id="'.$m->id.'" data-prod_name="'.$m->description.'" data-target="'.$this->createUrl("app/order_details&iid=").'">
              <strong>'.$m->description.'</strong>
            </button></li>';
    }
    echo "<ul class=box-span>$row</ul>";
?>
