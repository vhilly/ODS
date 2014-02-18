<?php

/**
 * This is the model class for table "branches".
 *
 * The followings are the available columns in table 'branches':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $contact_name
 * @property string $contact_no
 * @property double $lat
 * @property double $lng
 * @property string $special_instructions
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property Orders[] $orders
 * @property UnavailableItems[] $unavailableItems
 */
class Branches extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'branches';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, lat, lng', 'required'),
			array('is_active', 'numerical', 'integerOnly'=>true),
			array('lat, lng', 'numerical'),
			array('name, contact_name, contact_no', 'length', 'max'=>100),
			array('address', 'length', 'max'=>255),
			array('special_instructions', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, address, contact_name, contact_no, lat, lng, special_instructions, is_active', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Orders', 'branch_id'),
			'unavailableItems' => array(self::HAS_MANY, 'UnavailableItems', 'branch_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'address' => 'Address',
			'contact_name' => 'Contact Name',
			'contact_no' => 'Contact No',
			'lat' => 'Lat',
			'lng' => 'Lng',
			'special_instructions' => 'Special Instructions',
			'is_active' => 'Is Active',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('contact_no',$this->contact_no,true);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('lng',$this->lng);
		$criteria->compare('special_instructions',$this->special_instructions,true);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Branches the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
