<?php 
  class AppController extends Controller{

    public function filters()
    {
        return array(
         'rights'
        );
    }
    
    public function actionDashboard(){
      $where='';
      $where2='';
      $branch_id= Yii::app()->getModule('user')->user()->profile->branch;
      if($branch_id!=0){
        $where=' AND branch_id='.$branch_id;
        $where2=' AND o.branch_id='.$branch_id;
      }
      $pc=Yii::app()->db->createCommand()
        ->select('m.description name, COUNT(oi.menu_item_id) cnt,SUM(oi.price) amt')
        ->from('order_items oi,orders o,menu_items mi,menu m')
        ->where('oi.order_id=o.id AND o.status=4 AND oi.menu_item_id=mi.id AND m.id=mi.menu_id '.$where2)
        ->group('m.id')->queryAll();

      $ds=Yii::app()->db->createCommand()
        ->select('DATE_FORMAT(date_ordered,"%d-%m-%Y") as dy ,SUM(total_amt) amt ')
        ->from('orders')
        ->where('status=4 '.$where)
        ->group('dy')->queryAll();

      $ms=Yii::app()->db->createCommand()
        ->select('DATE_FORMAT(date_ordered,"%m-%Y") as mnth ,SUM(total_amt) amt ')
        ->from('orders')
        ->where('status=4 '.$where)
        ->group('mnth')->queryAll();

      $avgphr=Yii::app()->db->createCommand()
        ->select('hr,AVG(cnt) avg_cnt')
        ->from('(SELECT COUNT(id) cnt,HOUR(date_ordered) hr FROM orders WHERE 1 '.$where.' GROUP by hr,DATE(date_ordered)) s')
        ->group('hr')->queryAll();
      $this->render('dashboard',compact('pc','ds','ms','avgphr'));
    }
    public function actionOrder_taker(){
      $menu=Menu::model()->findAllByAttributes(array('deleted'=>0,'is_available'=>1));
      $branches=Yii::app()->db->createCommand()
        ->select('b.id as id,b.name as name')
        ->from('branches as b,store_hours as sh')
        ->where('sh.day_of_week=WEEKDAY(NOW()) AND TIME(NOW()) BETWEEN sh.open_time AND sh.close_time AND sh.branch_id=b.id AND b.is_active=1')->queryAll();
      $this->render('order_taker',compact('menu','branches'));
    }
    public function actionOrder_details($iid){
      $item=MenuItems::model()->findByPk($iid);
      $addons=ItemAddOns::model()->findAllByAttributes(array('item_id'=>$iid));
      $sizes=array();
      if($item && $item->per_size){
          $sizes=ItemSizes::model()->findAllByAttributes(array('item_id'=>$item->id));
      }
      $this->renderPartial('order_details',compact('item','sizes','addons'));
    }
    public function actionPlace_order(){
      $cid=str_replace('.','',CHttpRequest::getUserHostAddress()).Yii::app()->user->id;
      $orders=OrderTemp::model()->findAllByAttributes(array('client_id'=>$cid));
      if(isset($_POST['customer']) && $orders){
      $tax='12';
      $charges='10';
      $order=new Orders;
      $order->order_no='12332';

      if(!empty($_POST['order']['delivery_date'])){
        $order->delivery_date=$_POST['order']['delivery_date'];
        $order->delivery_time=$_POST['order']['delivery_time'];
        $order->is_advance=1;
        $order->status=1;
      }
      $order->agent_name=Yii::app()->getModule('user')->user()->profile->firstname.' '.Yii::app()->getModule('user')->user()->profile->lastname;
      $order->branch_id=$_POST['order']['bid'];
      $order->branch_name=$_POST['order']['bname'];
      $order->remarks=$_POST['order']['remarks'];
      $order->special_instruction=$_POST['order']['si'];
      $order->bill_change=$_POST['order']['bchange'];
      $order->agent=Yii::app()->user->id;
      $customer='';
      if($_POST['customer']['id'])
        $customer=Customers::model()->findByPk($_POST['customer']['id']);
      if(!$customer)
        $customer=new Customers;
      $customer->name=$_POST['customer']['name'];
      $customer->address=$_POST['customer']['address'];
      $customer->phone_1=$_POST['customer']['phone1'];
      $customer->geocode=$_POST['customer']['geocode'];
        if($order->validate() && $customer->validate()){
          $customer->save();
          $order->customer_id=$customer->id;
          $order->save();
          $subTotal=0;
          foreach($orders as $o){
            $orderItems=new OrderItems;
            $orderItems->order_id=$order->id;
            $orderItems->qty=$o->qty;
            $orderItems->price=$o->total_price;
            $orderItems->opts=$o->opts;
            $orderItems->menu_item_id=$o->item_id;
            $subTotal+=$orderItems->price;
            $orderItems->save();
          }
          $totalCharges=$subTotal * ($charges/100.0);
          $preTax= $totalCharges+$subTotal;
          $VAT=$preTax * ($tax/100.0);
          $grandTotal=$preTax + $VAT;

          $order->sub_total=$subTotal;
          $order->total_charges=$totalCharges;
          $order->tax=$VAT;
          $order->total_amt=$grandTotal;
          $order->save();
          OrderTemp::model()->deleteAllByAttributes(array('client_id'=>$cid));
          echo 'Success';
        }else{
          echo 'Failed!';
        }
      }
    }
    public function actionOrder_discount(){
      Yii::import('bootstrap.widgets.TbEditableSaver');
      $es = new TbEditableSaver('OrderTemp');
      $es->update();
    }
    public function actionOrder_delete($id){
      if($id){
        OrderTemp::model()->findByPk($id)->delete();
      }else{
        $cid=str_replace('.','',CHttpRequest::getUserHostAddress()).Yii::app()->user->id;
        OrderTemp::model()->deleteAllByAttributes(array('client_id'=>$cid));
      }
    }
    public function actionOrder_list(){
      $tax='12';
      $charges='10';
      $cid=str_replace('.','',CHttpRequest::getUserHostAddress()).Yii::app()->user->id;
      $orders=OrderTemp::model()->findAllByAttributes(array('client_id'=>$cid));
      $this->renderPartial('order_list',compact('orders','tax','charges'));
    }
    public function actionOrder_query(){
      if(isset($_POST['item'])){
         $cid=str_replace('.','',CHttpRequest::getUserHostAddress()).Yii::app()->user->id;
         $opts=isset($_POST['opts'])?json_encode($_POST['opts']):'';
         $item_id=$_POST['item']['iid'];
         
         $model=OrderTemp::model()->findByAttributes(array('client_id'=>$cid,'item_id'=>$item_id,'opts'=>$opts));
         if(!$model)
           $model = new OrderTemp;
         $model->client_id=$cid;
         $model->item_id=$item_id;
         $model->qty+=$_POST['item']['qty'];
         $model->orig_price+=$_POST['item']['totalPrice'];
         $model->total_price=$model->orig_price-$model->discount;
         $model->opts=$opts;
         $model->save(false);
      }
      
    }
    public function actionMenu(){
      $menu=Menu::model()->findAllByAttributes(array('deleted'=>0,'is_available'=>1));
      $menuItems=MenuItems::model()->findAllByAttributes(array('deleted'=>0));
      $menuItemList=array();
      if(count($menuItems)){
        foreach($menuItems as $mi){
           $menuItemList[$mi->menu_id][] = $mi;
        }
      }
      $this->render('menu',compact('menu','menuItemList'));
    }
    public function actionProduct_availability(){
      $branch= Yii::app()->getModule('user')->user()->profile->branch;
      if(isset($_GET['id'])){
        if($_GET['remove']){
          $ui=new UnavailableItems;
          $ui->branch_id=$branch;
          $ui->item_id=$_GET['id'];
          $ui->save();
        }else{
          UnavailableItems::model()->findByPk($_GET['id'])->delete();
        }
        $this->redirect(array('app/product_availability'));
      }else{
        $menu=Menu::model()->findAllByAttributes(array('deleted'=>0,'is_available'=>1));
        $menuItems=MenuItems::model()->findAllByAttributes(array('deleted'=>0));
        $uis=UnavailableItems::model()->findAllByAttributes(array('branch_id'=>$branch));
        $availability = CHtml::listData($uis,'item_id','id');
        $menuItemList=array();
        if(count($menuItems)){
          foreach($menuItems as $mi){
             $menuItemList[$mi->menu_id][] = $mi;
          }
        }
      }

      $this->render('product_availability',compact('menu','menuItemList','availability'));
    }
    public function actionShowimage(){
      $image = Menu::model()->findByPk($_GET['id']);
      header('Content-type: image/png');
      echo $image->img;
      exit();
    }
    public function actionMap(){
      $this->renderPartial('map');
    }
    public function actionMarkers($lat,$lng,$radius){
      $sql = "SELECT b.id as branch_id,b.address as address, b.name as name, b.lat as lat, b.lng as lng, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( lat ) ) ) ) AS distance FROM branches as b,store_hours as sh WHERE sh.day_of_week=WEEKDAY(NOW()) AND TIME(NOW()) BETWEEN sh.open_time AND sh.close_time AND sh.branch_id=b.id AND b.is_active=1 HAVING distance < :radius ORDER BY distance LIMIT 0 , 20";
      $command=Yii::app()->db->createCommand($sql);
      $command->bindParam(":lat",$lat,PDO::PARAM_STR);
      $command->bindParam(":lng",$lng,PDO::PARAM_STR);
      $command->bindParam(":radius",$radius,PDO::PARAM_STR);
      $result = $command->queryAll();
      $this->renderPartial('markers',compact('result'));
    }

    public function actionStore(){
      $branch_id= Yii::app()->getModule('user')->user()->profile->branch;
      $store=Branches::model()->findByPk($branch_id);
      $store_hours=StoreHours::model()->findAllByAttributes(array('branch_id'=>$branch_id));
      $shrs=array();
      foreach($store_hours as $v){
        $shrs[$v->day_of_week]=$v;
      }
      if(isset($_POST['Branches'])){
        $store->attributes=$_POST['Branches'];
        $store->save();
      if(isset($_POST['store_hours'])){
        foreach($_POST['store_hours'] as $k=>$v){
          if(array_key_exists($k,$shrs)){
            $shrs[$k]->open_time=$v[0];
            $shrs[$k]->close_time=$v[1];
            $shrs[$k]->save();
          }else{
            $sh=new StoreHours;
            $sh->open_time=$v[0];
            $sh->close_time=$v[1];
            $sh->day_of_week=$k;
            $sh->branch_id=$branch_id;
            $sh->save();
          }
        }
      }
        $this->redirect(array('app/store'));
      }
      $this->render('store',compact('store','shrs'));
    }
  }

?>
