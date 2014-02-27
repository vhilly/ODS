<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property string $order_no
 * @property integer $branch_id
 * @property string $branch_name
 * @property integer $customer_id
 * @property string $total_amt
 * @property string $remarks
 * @property string $bill_change
 * @property integer $rider
 * @property integer $status
 * @property string $date_ordered
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property OrderItems[] $orderItems
 * @property Riders $rider0
 * @property Customers $customer
 * @property Branches $branch
 */
class Orders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_no, branch_id', 'required'),
			array('branch_id, customer_id,is_advance, rider, status', 'numerical', 'integerOnly'=>true),
			array('order_no, card_no,branch_name', 'length', 'max'=>100),
			array('total_amt, bill_change,tax,total_charges,sub_total,total_discount', 'length', 'max'=>15),
			array('remarks,special_instruction', 'length', 'max'=>255),
                        array('delivery_date, delivery_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_no, branch_id, branch_name, customer_id, total_amt, remarks, bill_change, rider, status, date_ordered, date_updated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'orderItems' => array(self::HAS_MANY, 'OrderItems', 'order_id'),
			'itemCheckList' => array(self::HAS_MANY, 'ItemChecklist', 'menu_item_id','through'=>'orderItems'),
			'rider0' => array(self::BELONGS_TO, 'Riders', 'rider'),
			'customer' => array(self::BELONGS_TO, 'Customers', 'customer_id'),
			'branch' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
                        'cardNo' => array(self::BELONGS_TO,'CardHolder', 'card_no'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_no' => 'Order No',
			'branch_id' => 'Branch',
			'branch_name' => 'Branch Name',
			'customer_id' => 'Customer',
			'total_amt' => 'Total Amt',
                        'tax' => 'Tax',
			'sub_total' => 'Sub Total',
			'total_discount' => 'Total Discount',
			'discount_code' => 'Discount Code',
			'remarks' => 'Remarks',
			'bill_change' => 'Bill Change',
			'rider' => 'Rider',
                        'is_advance' => 'Advance Order',
			'status' => 'Status',
                        'delivery_date' => 'Delivery Date',
			'delivery_time' => 'Delivery Time',
			'date_ordered' => 'Date Ordered',
			'date_updated' => 'Date Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('order_no',$this->order_no,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('branch_name',$this->branch_name,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('total_amt',$this->total_amt,true);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('bill_change',$this->bill_change,true);
		$criteria->compare('rider',$this->rider);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_ordered',$this->date_ordered,true);
		$criteria->compare('date_updated',$this->date_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function beforeSave() {
      if ($this->isNewRecord)
        $this->date_ordered = new CDbExpression('NOW()');
      $this->date_updated = new CDbExpression('NOW()');
      return parent::beforeSave();
    }
    public function frequentFoodOrder($cid=null,$limit=5){
      $from='';
      $where='';
      if($cid){
        $from=',orders as o';
        $where=" AND oi.order_id=o.id AND o.customer_id=$cid ";
      }
      return Yii::app()->db->createCommand()
        ->select('i.description')
        ->from("order_items as oi,menu_items as  i $from")
        ->where("i.id=oi.menu_item_id $where AND i.menu_id != 1")
        ->group('oi.menu_item_id')
        ->order('COUNT(oi.id) DESC')
        ->limit($limit)->queryAll();
       
    }
}
