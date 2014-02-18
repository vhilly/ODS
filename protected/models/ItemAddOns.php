<?php

/**
 * This is the model class for table "item_add_ons".
 *
 * The followings are the available columns in table 'item_add_ons':
 * @property integer $id
 * @property integer $item_id
 * @property integer $add_on_id
 * @property integer $is_available
 *
 * The followings are the available model relations:
 * @property AddOns $addOn
 * @property MenuItems $item
 */
class ItemAddOns extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item_add_ons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, add_on_id', 'required'),
			array('item_id, add_on_id,deleted, is_available', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_id, add_on_id, is_available', 'safe', 'on'=>'search'),
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
			'addOn' => array(self::BELONGS_TO, 'AddOns', 'add_on_id'),
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
			'item_id' => 'Item',
			'add_on_id' => 'Add On',
			'is_available' => 'Is Available',
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
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('add_on_id',$this->add_on_id);
		$criteria->compare('is_available',$this->is_available);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemAddOns the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
