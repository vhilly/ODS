    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span4 offset4">
          <div class="signin">
            <h2 class="center-align-text"></h2>
            
			<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'id'=>'verticalForm',
				'htmlOptions'=>array('class'=>'signin-wrapper'),
			)); ?>
              <div class="content">
	
     
    <?php echo $form->textFieldRow($model, 'username', array('class'=>'input input-block-level','placeholder'=>'Username')); ?>
    <?php echo $form->passwordFieldRow($model, 'password', array('class'=>'input input-block-level','placeholder'=>'Password')); ?>
    <?php //echo $form->checkboxRow($model, 'rememberMe'); ?>
    
     
    
                <!--<input class="input input-block-level" placeholder="Username" type="text" required>
                <input class="input input-block-level" placeholder="Password" type="password" required>-->
              </div>
              <div class="actions">
                <!--<input class="btn btn-info pull-right" value="Login" type="submit">-->
				<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary', 'label'=>'Login','htmlOptions'=>array('class'=>'btn btn-info pull-right'))); ?>
                <span class="checkbox-wrapper">
                  <a href="">Forgot Password</a><br><?php echo CHtml::link('Register',array('/user/registration'),array('class'=>'pull-left')); ?>
                </span>
                <div class="clearfix"></div>
              </div>
			<?php $this->endWidget(); ?>
          </div>
        </div>
      </div>
    </div>
    <?php /*$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
    )); */?>
     
    <?php //echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
    <?php //echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
    <?php //echo $form->checkboxRow($model, 'rememberMe'); ?>
    <?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary', 'label'=>'Login')); ?>
     
    <?php //$this->endWidget(); ?>


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>
