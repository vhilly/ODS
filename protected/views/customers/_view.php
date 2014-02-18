<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_1')); ?>:</b>
	<?php echo CHtml::encode($data->phone_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_2')); ?>:</b>
	<?php echo CHtml::encode($data->phone_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geocode')); ?>:</b>
	<?php echo CHtml::encode($data->geocode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br />


</div>