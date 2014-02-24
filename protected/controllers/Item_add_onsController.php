<?php

class Item_add_onsController extends Controller
{
public $layout='//layouts/main';

public function filters()
{
return array(
'rights', // perform access control for CRUD operations
);
}


public function actionView($id)
{
$this->render('view',array(
'model'=>$this->loadModel($id),
));
}

public function actionCreate($iid)
{
$model=new ItemAddOns;
$model->item_id=$iid;
$addons=AddOns::model()->findAll();

if(isset($_POST['ItemAddOns']))
{
$model->attributes=$_POST['ItemAddOns'];
if($model->save())
$this->redirect(array('menu_items/update','id'=>$iid));
}

$this->render('create',compact('model','addons'));
}

/**
* Updates a particular model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param integer $id the ID of the model to be updated
*/
public function actionUpdate($id)
{
$model=$this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['ItemAddOns']))
{
$model->attributes=$_POST['ItemAddOns'];
if($model->save())
$this->redirect(array('view','id'=>$model->id));
}

$this->render('update',array(
'model'=>$model,
));
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
 ItemAddOns::model()->updateAll(array( 'deleted'=>1), "id= {$id}" );
}
else
throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
}

/**
* Lists all models.
*/
public function actionIndex()
{
$dataProvider=new CActiveDataProvider('ItemAddOns');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new ItemAddOns('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['ItemAddOns']))
$model->attributes=$_GET['ItemAddOns'];

$this->render('admin',array(
'model'=>$model,
));
}

/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
$model=ItemAddOns::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='item-add-ons-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
