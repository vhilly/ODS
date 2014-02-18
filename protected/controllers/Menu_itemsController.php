<?php

class Menu_itemsController extends Controller
{
/**
* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
* using two-column layout. See 'protected/views/layouts/column2.php'.
*/
public $layout='//layouts/main';

/**
* @return array action filters
*/
public function filters()
{
return array(
  'rights'
);
}


/**
* Displays a particular model.
* @param integer $id the ID of the model to be displayed
*/
public function actionView($id)
{
$this->render('view',array(
'model'=>$this->loadModel($id),
));
}

public function actionAvailability($id,$aid){
  MenuItems::model()->updateAll(array( 'is_available' => $aid, 'date_updated' => new CDbExpression('NOW()')), "id= {$id}" );
}
/**
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/
public function actionCreate()
{
$model=new MenuItems;
$menu=Menu::model()->findAllByAttributes(array('deleted'=>0,'is_available'=>1));
if(isset($_POST['MenuItems']))
{
$model->attributes=$_POST['MenuItems'];
if($model->save())
$this->redirect(array('update','id'=>$model->id));
}

      $this->render('create',compact('model','menu'));
}

/**
* Updates a particular model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param integer $id the ID of the model to be updated
*/
public function actionUpdate($id)
{
$model=$this->loadModel($id,array('itemSizes','itemAddOns'));
$menu=Menu::model()->findAllByAttributes(array('deleted'=>0,'is_available'=>1));
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['MenuItems']))
{
$model->attributes=$_POST['MenuItems'];
if($model->save())
$this->redirect(array('update','id'=>$model->id));
}

      $this->render('update',compact('model','menu'));
}

/**
* Deletes a particular model.
* If deletion is successful, the browser will be redirected to the 'admin' page.
* @param integer $id the ID of the model to be deleted
*/
public function actionDelete($id)
{
if(Yii::app()->request->isPostRequest)
{
// we only allow deletion via POST request
$this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
if(!isset($_GET['ajax']))
$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
}
else
throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
}

/**
* Lists all models.
*/
public function actionIndex()
{
$dataProvider=new CActiveDataProvider('MenuItems');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new MenuItems('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['MenuItems']))
$model->attributes=$_GET['MenuItems'];

$this->render('admin',array(
'model'=>$model,
));
}
  
  public function actionGetAll($menu_id,$bid){
    $menuItems=MenuItems::model()->findAllByAttributes(array('deleted'=>0,'is_available'=>1,'menu_id'=>$menu_id),
      array('condition'=>"id NOT IN (SELECT item_id FROM unavailable_items WHERE branch_id=$bid)"));
    $row='';
    foreach($menuItems as $m){
      $row .= '<li><button class="btn span3 itemSelect btn-large" data-prod_id="'.$m->id.'" data-prod_name="'.$m->description.'">
              <strong>'.$m->description.'</strong>
            </button></li>';
    }
    echo "<ul class=box-span>$row</ul>";
    Yii::app()->end();
  }


/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id,$rel=null){ 
if($rel)
  $model=MenuItems::model()->with($rel)->findByPk($id);
else
  $model=MenuItems::model()->findByPk($id);
if($model===null)
throw new CHttpException(404,'The requested page does not exist.');
return $model;
}

/**
* Performs the AJAX validation.
* @param CModel the model to be validated
*/
protected function performAjaxValidation($model)
{
if(isset($_POST['ajax']) && $_POST['ajax']==='menu-items-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
