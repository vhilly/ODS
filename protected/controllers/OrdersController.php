<?php

class OrdersController extends Controller
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

  public function actionView($id){
    $this->renderPartial('view',array('orders'=>$this->loadModel($id,array('orderItems.itemCheckList'))));
  }
  public function actionUpdate($id,$sid,$rid=null,$rname=null){
    if($rid)
      Orders::model()->updateAll(array( 'status' => $sid, 'date_updated' => new CDbExpression('NOW()'),'rider'=>$rid,'rider_name'=>$rname), "id= {$id}" );
    else
      Orders::model()->updateAll(array( 'status' => $sid, 'date_updated' => new CDbExpression('NOW()')), "id= {$id}" );
  }

  public function actionDelete($id){
    if(Yii::app()->request->isPostRequest){
      $this->loadModel($id)->delete();

      if(!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
      }else
        throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
  }

  public function actionIndex(){
    $branch= Yii::app()->getModule('user')->user()->profile->branch;
    $orders=Orders::model()->findAllByAttributes(array('branch_id'=>$branch),array('condition'=>'status NOT IN (-2,4)'));
    $orderList=array();
    if($orders){
      foreach($orders as $o){
        if($o->is_advance && $o->status==0)
         $orderList['adv'][]=$o;
        else
          $orderList[$o->status][]=$o;
      }
    }
    $accepted=isset($orderList[1])?$orderList[1]:array();
    $advance=isset($orderList['adv'])?$orderList['adv']:array();
    $driverOut=isset($orderList[2])?$orderList[2]:array();
    $cancel=isset($orderList[-1])?$orderList[-1]:array();
    $this->render('index',compact('advance','driverOut','cancel','accepted'));
  }
  public function actionIncoming(){
    $incoming=Orders::model()->findAllByAttributes(array('branch_id'=>Yii::app()->getModule('user')->user()->profile->branch,'status'=>0,'is_advance'=>0));
    $this->renderPartial('incoming',compact('incoming'));
  }
  public function actionHistory($cid){
    //$cust=Customers::model()->with('orders.orderItems')->findByAttributes(array('phone_1'=>$cid)));
    $cust=Customers::model()->findByAttributes(array('phone_1'=>$cid));
    if($cust){
      $freq=Orders::model()->frequentFoodOrder($cust->id);
      $orders=Orders::model()->with('orderItems')->findAllByAttributes(array('customer_id'=>$cust->id,'status'=>4),array('limit'=>5,'order'=>'id DESC'));
    }
    $this->renderPartial('history',compact('cust','orders','freq'));
  }
  public function loadModel($id,$rel=null){
    if($rel)
      $model=Orders::model()->with($rel)->findByPk($id);
    else
      $model=Orders::model()->findByPk($id);
    if($model===null)
      throw new CHttpException(404,'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model){
    if(isset($_POST['ajax']) && $_POST['ajax']==='orders-form'){
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}
