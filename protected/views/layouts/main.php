<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <script type="text/javascript" src="http://<?=$_SERVER['SERVER_ADDR']?>:8000/socket.io/socket.io.js"></script>`
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<style>
		* {
			font-size:13px;
		}
	</style>
</head>

<body>
<?php
   $branch_id= Yii::app()->getModule('user')->user()->profile->branch;
   $hidden= $branch_id==0?'hidden':'';
   $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'', // null or 'inverse'
    'brand'=>'',
    'brandUrl'=>'#',
    'collapse'=>false, // requires bootstrap-responsive.css
    'fluid'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('icon'=>'icon-dashboard icon-2x','label'=>'Dashboard', 'url'=>array('/app/dashboard'),'visible'=>!Yii::app()->user->isGuest),
                array('icon'=>'icon-edit icon-2x','label'=>'Order Entry', 'url'=>array('/app/order_taker'),'visible'=>$branch_id==0),
                array('icon'=>'icon-credit-card icon-2x','label'=>'Orders', 'url'=>array('/orders/index'),'visible'=>$branch_id!=0),
                array('icon'=>'icon-food icon-2x','label'=>'Menu', 'url'=>array('/app/menu'),'visible'=>$branch_id!=0),
                array('icon'=>'icon-asterisk icon-2x','label'=>'Product Availability', 'url'=>array('/app/product_availability'),'visible'=>$branch_id!=0),
            ),
        ),
       // '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
	//					'<div class="pull-right sub-brand"></div>',
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                
                array('icon'=>'icon-off icon-2x','label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                array('icon'=>'icon-user icon-2x','label'=>'('.Yii::app()->user->name.')', 'url'=>'#', 'items'=>array(
                    array('icon'=>'cog','label'=>'SETTINGS'),
                    '---',
                    array('','label'=>'Store Setup', 'url'=>array('/app/store'),'visible'=>$branch_id!=0), 
                    array('icon'=>'off','label'=>'Logout', 'url'=>array('/site/logout')), 
                ),'visible'=>!Yii::app()->user->isGuest ),
            ),
        ),
        '<div class="btn-group pull-right '.$hidden.'">
	  <button class="btn btn-primary modal-content" type="button" data-toggle=modal data-target=#contentModal data-title="Add Rider"  data-content="'.Yii::app()->createUrl('riders/create').'">
            <span class="icon-rocket">Add Rider</span>
           </button> 
         </div>',
    ),
)); ?>
<div class="fluid" id="page">
  <div class="container-fluid content">
    <?php echo $content?>
    <div id='progressBar' style='display:none;position:fixed;' class='modal-backdrop'>
    <?php 
    $this->widget(
    'bootstrap.widgets.TbProgress',
    array(
      'type' => 'danger', // 'info', 'success' or 'danger'
      'percent' => 100, // the progress
      'striped' => true,
      'content'=>'<b>processing.. please wait</b>',
      'htmlOptions' => array('style'=>'position:fixed;top: 50%;left:50%;width:580px;margin-left:-240px'),
      'animated' => true,
      )
    );
    ?>
    </div>
  </div>
</div><!-- page -->
<?php $this->beginWidget(
'bootstrap.widgets.TbModal',
array('id' => 'contentModal')
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
 
<?php $this->endWidget(); ?>
</body>
</html>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/scripts.js', CClientScript::POS_END);?>
