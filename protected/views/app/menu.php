<div class="row-fluid">
  <div class="span7">
    <table class='table table-order table-bordered'>
      <tbody>
      <?php foreach($menu as $m):?>
        <tr class='overall-header'><td><center><?=$m->description?></center></td><td colspan=2></td></tr>

        <?php if(array_key_exists($m->id,$menuItemList)):?>
          <?php foreach($menuItemList[$m->id] as $ml):?>
            <tr class=<?=$ml->is_available?'':'red'?>>
              <td><?=$ml->description?></td>
              <td><?=CHtml::link('<i class=icon-pencil></i>',Yii::app()->createUrl('menu_items/update',array('id'=>$ml->id)),array('class'=>'btn'))?></td>
            </tr>
          <?php endforeach;?>
        <?php endif;?>

      <?php endforeach;?>
      </tbody>
    </table>

    <?php $this->widget(
     'bootstrap.widgets.TbButton',
     array(
       'label' => 'Add Menu',
       'buttonType' => 'link',
       'url' => Yii::app()->createUrl('menu/create'),
     )
     );?>

    <?php $this->widget(
     'bootstrap.widgets.TbButton',
     array(
       'label' => 'Add Menu Item',
       'buttonType' => 'link',
       'url' => Yii::app()->createUrl('menu_items/create'),
     )
     );?>
  </div>
</div>

