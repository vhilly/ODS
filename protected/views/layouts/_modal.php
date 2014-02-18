<?php $this->beginWidget(
  'bootstrap.widgets.TbModal',
  array('id' => 'myModal')
); ?>
     
  <div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Modal header</h4>
    </div>
     
    <div class="modal-body">
    <p>One fine body...</p>
    </div>
     
    <div class="modal-footer">
    </div>
  </div>
     
<?php $this->endWidget(); ?>
