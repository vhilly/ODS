<?php $optFields = array(); ?>
<?php $opts = array(); ?>
<h5>QTY:<input type=text id=qtyHolder onkeypress="return isNumberKey(event)" value=1 class=span1><br>
    PHP <span id=totalPriceHolder></span>
</h5>
<input type=hidden id=price value=<?= $item->price ?>>
<input type=hidden id=iid value=<?= $item->id ?>>
<input type=hidden id=totalPrice value=<?= $item->price ?>>
<table>
  <?php if ($item->per_size && count($sizes)): ?>
    <tr><th colspan=2>Sizes<th></td>
    <?php foreach ($sizes as $k => $s): ?>
      <?php $checked = !$k ? 'checked' : '' ?>
    <tr>
      <td><?= $s->size->name ?></td>
      <td><input <?= $checked ?> class='options' type='radio' id='<?= $s->id ?>' name='item_size_id'  data-target='#item_size' data-price=<?= $s->price ?> value=<?= $s->id ?> ></td>
    <?php endforeach; ?>
    <input type=hidden id=item_size_id name=item_size value=<?= isset($sizes[0]) ? $sizes[0]['id'] : 0 ?>>
    <input type=hidden id=item_size_price value=<?= isset($sizes[0]) ? $sizes[0]['price'] : 0 ?>>
    <?php $opts[] = "parseFloat($('#item_size_price').val())"; ?>
  <?php endif; ?>

<?php if (count($addons)): ?>
    <?php foreach ($addons as $a): ?>
    <tr><th colspan=2><?=$a->addOn->description?><th></td>
      <?php foreach (AddOnSizes::model()->findAllByAttributes(array('add_on_id' => $a->id)) as $c): ?>
    <tr>
        <td><?= $c->size->name ?></td>
        <td><input class='options' type='radio' id='<?= $c->id ?>' name='<?= $a->addOn->name ?>'  
               data-target='#<?= $a->addOn->name ?>' data-price=<?= $c->price ?> value=<?= $c->id ?> >
        </td>
    </tr>
             <?php endforeach; ?>
      <input type=hidden id='<?= $a->addOn->name ?>_id' name=<?= $a->addOn->name ?> >
      <input type=hidden id='<?= $a->addOn->name ?>_price' value=0>
      <?php $opts[] = "parseFloat($('#{$a->addOn->name}_price').val())"; ?>
      <?php $optFields[] = "{$a->addOn->name}_id:$('#{$a->addOn->name}_id').val()"; ?>
    <?php endforeach; ?>
  <?php endif; ?>

</table><br>
<a class=btn id=addItem> Add Item</a>
<?php $opts = count($opts) ? '+' . implode('+', $opts) : ''; ?>
<?php $optFields = count($optFields) ? implode(',', $optFields) : ''; ?>
<script>
    function updateFields(target, id, price){
    $(target + '_id').val(id);
      $(target + '_price').val(price);
    }
    $('.options').click(function(){
    updateFields($(this).data('target'), $(this).val(), $(this).data('price'));
      updatePrice();
    });
    $('#addItem').click(function(event){
      updatePrice();
      var qty = $('#qtyHolder').val();
      var iid = $('#iid').val();
      var size= $('#item_size_id').val();
      var opts = {<?= $optFields ?>};
      $.post("<?= $this->createUrl('order_query') ?>",
      { item:{iid:iid, qty:qty, totalPrice:$('#totalPrice').val(),size:size}, opts:opts}).done(function(data) {
       updateOrderList();
       $('#orderModal').modal('hide');
      }).fail(function(){
        alert(this.url)
      });
      event.preventDefault()
    });
    function updatePrice(){
      totalPrice = (parseFloat($('#price').val()) <?= $opts ?>) * $('#qtyHolder').val();
        $('#totalPrice').val(totalPrice);
        $('#totalPriceHolder').html(totalPrice);
    }
    $('#qtyHolder').keyup(function(){
      if ($(this).val() == 0){
      $(this).val(1);
        return false;
      }
      updatePrice();
    });
    updatePrice();
</script>
