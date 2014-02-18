<?php
  class ReportsController extends Controller{
    public function filters(){
      return array(
  'rights'
);
    }
    public function actionSalesByBranch(){
      $orders=Yii::app()->db->createCommand()
        ->select('b.name,SUM(o.total_amt) as total_amt')
        ->from('orders o,branches b')
        ->where('o.branch_id=b.id')
        ->group('o.branch_id')->queryAll();
      print_r($orders);
    }

    public function actionDailySalesReport(){

    }
    public function actionMonthlySalesReport(){
      $sr=Yii::app()->db->createCommand()
        ->select('DATE_FORMAT(o.date_ordered,"%m-%Y") as mnth,COUNT(o.id) cnt,SUM(o.total_amt) as total_amt')
        ->from('orders o,branches b')
        ->where('o.branch_id=b.id AND o.status=4')
        ->group('mnth')->queryAll();
      print_r($sr);
    }
    public function actionByCategory(){
      $sr=Yii::app()->db->createCommand()
        ->select('SELECT m.description, COUNT(oi.menu_item_id) cnt,SUM(oi.price)')
        ->from('FROM order_items oi,orders o,menu m')
        ->where('WHERE oi.order_id=o.id AND o.status=4 AND m.id=oi.menu_item_id')
        ->group('GROUP BY oi.menu_item_id')->queryAll();
      print_r($sr);
    }

  }


?>
