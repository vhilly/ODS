<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_on_id')); ?>:</b>
	<?php echo CHtml::encode($data->add_on_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_available')); ?>:</b>
	<?php echo CHtml::encode($data->is_available); ?>
	<br />


</div>