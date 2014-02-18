<?php

/**
 * This is the model class for table "order_temp".
 *
 * The followings are the available columns in table 'order_temp':
 * @property integer $id
 * @property string $client_id
 * @property integer $item_id
 * @property integer $qty
 * @property string $total_price
 * @property string $opts
 *
 * The followings are the available model relations:
 * @property MenuItems $item
 */
class OrderTemp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_temp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_id, item_id, qty, total_price, opts', 'required'),
			array('item_id, qty', 'numerical', 'integerOnly'=>true),
			array('client_id', 'length', 'max'=>255),
			array('total_price,orig_price,discount', 'length', 'max'=>20),
			array('discount_code', 'length', 'max'=>10),
			array('opts', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, client_id, item_id, qty, total_price, opts', 'safe', 'on'=>'search'),
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
			'item' => array(self::BELONGS_TO, 'MenuItems', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'client_id' => 'Client',
			'item_id' => 'Item',
			'qty' => 'Qty',
			'total_price' => 'Total Price',
			'opts' => 'Opts',
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
		$criteria->compare('client_id',$this->client_id,true);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('opts',$this->opts,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderTemp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
}
