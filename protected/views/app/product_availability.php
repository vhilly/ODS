<div class="row-fluid">
  <div class="span7">
    <table class='table table-order table-bordered'>
      <tbody>
      <?php foreach($menu as $m):?>
        <tr class='overall-header'><td><center><?=$m->description?></center></td><td colspan=2>Available?</td></tr>

        <?php if(array_key_exists($m->id,$menuItemList)):?>
          <?php foreach($menuItemList[$m->id] as $ml):?>
            <tr class=<?=$ml->is_available?'':'red'?>>
              <td><?=$ml->description?></td>
              <td><?=!isset($availability[$ml->id])?'YES':'NO'?></td>
              <td><?=CHtml::link('<i class=icon-retweet></i>',Yii::app()->createUrl('app/product_availability',
                 array('id'=>isset($availability[$ml->id])?$availability[$ml->id]:$ml->id,'remove'=>!isset($availability[$ml->id])?true:false)),array('class'=>'btn'))?></td>
            </tr>
          <?php endforeach;?>
        <?php endif;?>

      <?php endforeach;?>
      </tbody>
    </table>

  </div>
</div>

