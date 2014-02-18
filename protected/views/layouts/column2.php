<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<style>
		* {
			font-size:12px;
		}
	</style>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/scripts.js');?>
</head>

<body>
<?php
   $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>'',
    'brandUrl'=>'#',
    'collapse'=>false, // requires bootstrap-responsive.css
    'fluid'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
		'...',
                array('icon'=>'icon-edit icon-2x','label'=>'Order Entry', 'url'=>array('/app/order_taker')),
		'...',
                array('icon'=>'icon-credit-card icon-2x','label'=>'Orders', 'url'=>array('/orders/index')),
		'...',
                array('icon'=>'icon-food icon-2x','label'=>'Menu', 'url'=>array('/app/menu')),
		'...',
                array('icon'=>'icon-asterisk icon-2x','label'=>'Product Availability', 'url'=>array('/app/product_availability')),
		'...',
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
                    array('','label'=>'Profile', 'url'=>array('/user/profile')), 
                    array('icon'=>'off','label'=>'Logout', 'url'=>array('/site/logout')), 
                ),'visible'=>!Yii::app()->user->isGuest ),
            ),
        ),
        '<div class="btn-group pull-right">
	  <button class="btn btn-primary modal-content" type="button" data-toggle=modal data-target=#myModal data-title="Add Rider"  data-content="'.Yii::app()->createUrl('riders/create').'">
            <span class="icon-rocket">Add Rider</span>
           </button> 
	  <button class="btn btn-primary modal-content" type="button" data-toggle=modal data-target=#myModal data-title="Special Instructions"  data-content="'.Yii::app()->createUrl('branches/special_instruction').'">
            <span class="icon-rocket">Special Instructions</span>
           </button> 
         </div>',
    ),
)); ?>
<div class="fluid" id="page">
  <div class="container-fluid content">
    <?php echo $content?>
  </div>
</div><!-- page -->
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
 
<?php $this->endWidget(); ?>
</body>
</html>
