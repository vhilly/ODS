        <table class="table table-order table-bordered">
          <thead>
            <tr class=overall-header>
               <th colspan=6><center>Order Details</center></th>
            </tr>
            <tr class='item-header'>
               <th>Description</th>
               <td>Discount Code</td>
               <th>Qty</th>
               <th>w/o dc</th>
               <th>w/ dc</th>
               <th>Total</th>
            </tr>
          </thead>
          <tbody id='currentOrders'>
            <?php $st=0;$totalDiscount=0;?>
            <?php foreach($orders as $o):?>
              <?php $st+=$o->total_price;?>
              <?php $totalDiscount+=$o->discount;?>
              <tr>
                <td><a class='btn deleteOrder' data-order_id=<?=$o->id?>><i class=icon-remove></i></a> <?=$o->item->description?></td>
                <td>
                  <a href="#" rel="OrderTemp_discount_code" data-target="#<?=$o->id?>"  data-pk="<?=$o->id?>"></a>
                </td>
                <td><?=$o->qty?></td>
                <td id="<?=$o->id?>_op"><?=$o->orig_price?></td>
                <td id="<?=$o->id?>_tp"><?=$o->total_price?></td>
                <td><?=number_format($o->total_price,2)?></td>
              </tr>
            <?php endforeach;?>
            <?php
             $totalCharges=$st * ($charges/100.0);
             $preTax= $totalCharges+$st;
             $VAT=$preTax * ($tax/100.0);
             $grandTotal=$preTax + $VAT;
            ?>
          </tbody>
          <tfoot>
            <tr>
               <td colspan=5>Sub Total</td>
               <td><?=number_format($st,2)?></td>
            </tr>
            <tr>
               <td colspan=5>Charges (<?=$charges?>%)</td>
               <td><?=number_format($totalCharges,2)?></td>
            </tr>
            <tr>
               <td colspan=5>Discount</td>
               <td><?=number_format($totalDiscount,2)?></td>
            </tr>
            <tr>
               <td colspan=5>VAT (<?=$tax?>%)</td>
               <td><?=number_format($VAT,2)?></td>
            </tr>
            <tr>
               <td colspan=5>Grand Total</td>
               <td><?=number_format($grandTotal,2)?></td>
            </tr>
          </tfoot>
        </table>
<script type="text/javascript">
/*<![CDATA[*/
jQuery('[data-toggle=popover]').popover();
jQuery('body').tooltip({"selector":"[data-toggle=tooltip]"});
$('a[rel=OrderTemp_discount_code]').on('save',  function(event, params) {
    $($(this).data('target')+'_tp').html('tets');
    }).editable({'datepicker':{'language':'en'},'type':'select2','url':'/ODS/index.php?r=app/order_discount','name':'discount_code','title':'Enter Discount Code','mode':'popup','placement':'bottom','emptytext':'Empty','inputclass':'input-medium','source':[{'value':'20:P20','text':'P20'},{'value':'10:P10','text':'P10'}],'success': function(response, newValue) {
console.log(response);
    }});

/*]]>*/
</script>

