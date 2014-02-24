<div class="row-fluid">
  <div class="span12">
    <div class="row-fluid">
      <div class="span4">
        <table class='table table-order table-bordered'>
          <tbody>
             <tr class='overall-header'><td colspan=2>Summary for: <?=date('d-m-Y')?></td></tr>
          </tbody>
        </table>
        <div style='position:fixed;width:450px;height:80%;overflow:auto' id=orderDetails></div>
      </div>
      <div class="span8">
        <table class='table table-order table-bordered'>
          <thead>
            <tr class='overall-header'>
              <td colspan=6>INCOMING ORDERS</td>
            </tr>
            <tr class='item-header'>
              <td>Order#</td>
              <td>Action</td>
              <td>Order Info.</td>
              <td>Customer</td>
              <td>Status</td>
              <td>On Queue</td>
              <td>Total Amount</td>
            </tr>
          </thead>
          <tbody id='incoming' data-target=<?=$this->createUrl('incoming')?>>
          </tbody>
        </table>
        <div id='accepted' data-target=<?=$this->createUrl('accepted')?>>
        </div>
      </div>
    </div>
  </div>
</div>
