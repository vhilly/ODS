<?php

/**
 * This is the model class for table "menu_items".
 *
 * The followings are the available columns in table 'menu_items':
 * @property integer $id
 * @property integer $menu_id
 * @property string $description
 * @property string $price
 * @property string $img
 * @property integer $is_available
 * @property string $date_created
 * @property string $date_updated
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property Menu $menu
 * @property OrderItems[] $orderItems
 */
class MenuItems extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_id, description, price,per_size', 'required'),
			array('menu_id, is_available, deleted,per_size', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>100),
			array('price', 'length', 'max'=>15),
			array('img', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, menu_id, description, price, img, is_available, date_created, date_updated, deleted', 'safe', 'on'=>'search'),
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
			'menu' => array(self::BELONGS_TO, 'Menu', 'menu_id'),
			'orderItems' => array(self::HAS_MANY, 'OrderItems', 'menu_item_id'),
			'itemSizes' => array(self::HAS_MANY, 'ItemSizes', 'item_id'),
			'itemAddOns' => array(self::HAS_MANY, 'ItemAddOns', 'item_id'),
			'itemCheckList' => array(self::HAS_MANY, 'ItemChecklist', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menu_id' => 'Menu',
			'description' => 'Description',
			'price' => 'Price',
			'img' => 'Img',
			'is_available' => 'Is Available',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'deleted' => 'Deleted',
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
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('is_available',$this->is_available);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MenuItems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function beforeSave() {
      if ($this->isNewRecord)
        $this->date_created = new CDbExpression('NOW()');
      $this->date_updated = new CDbExpression('NOW()');
 
    return parent::beforeSave();
    }
}
